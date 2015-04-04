<?php 
// src/AppBundle/Entity/Document.php
namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="document")
 * @ORM\HasLifecycleCallbacks
 */
class Document
{
	// Properties
	
	// ID of import type the file is matched to. this will also be file extension
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", length=2)
	 */
    public $id;
	
    // filename (not path)
	/**
	 * @ORM\Column(type="string", length=200)
	 */
    public $name;
	
    // path (not including filename)
	/**
	 * @ORM\Column(type="string", length=200)
	 */
    public $path;
    
    private $temp;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

	// Methods
    
	/**
	 * Set id
	 *
	 * @param integer $id
	 */
	public function setId($id)
    {
    	$this->id = $id;
    	
    	return $this;
    }
    
	/**
	 * Set name
	 *
	 * @param integer $name
	 */
	public function setName($name)
    {
    	$this->name = $name;
    	
    	return $this;
    }
    
	public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->id.'.'.$this->path;
    }
    
    public function getWebPath()
    {
    	return null === $this->path
    	? null
    	: $this->getUploadDir().'/'.$this->path;
    }
    
    protected function getUploadRootDir()
    {
    	// the absolute directory path where uploaded
    	// documents should be saved
    	return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    protected function getUploadDir()
    {
    	// get rid of the __DIR__ so it doesn't screw up
    	// when displaying uploaded doc/image in the view.
    	return 'uploads/documents';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
	    $this->file = $file;
    	// check if we have an old image path
        if (is_file($this->getAbsolutePath())) {
            // store the old name to delete after the update
            $this->temp = $this->getAbsolutePath();
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
    	if (null !== $this->getFile()) {
//      	$this->path = $this->getFile()->guessExtension();
    		$this->path = $this->getAbsolutePath();
    		
    		\Doctrine\Common\Util\Debug::dump($this->path);die();
    	}
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
   public function upload()
    {
    	// the file property can be empty if the field is not required
    	if (null === $this->getFile()) {
    		return;
    	}

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->temp);
            // clear the temp image path
            $this->temp = null;
        }
    	
    	// if there is an error when moving the file, an exception will
    	// be automatically thrown by move(). This will properly prevent
    	// the entity from being persisted to the database on error
    	$this->getFile()->move(
            $this->getUploadRootDir(),
    		$this->getFile()->getClientOriginalName()
            .'.'.$this->id
        );
    	
    	$this->setFile(null);
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->temp = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (isset($this->temp)) {
            unlink($this->temp);
        }
    }
}