<?php 
// src/AppBundle/Entity/Document.php
namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Document
{
	// Properties

    public $id;

    public $name;

    public $path;
    
    private $file;

	// Methods
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
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
    	$this->file = new \SplFileObject($file);
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
     * Get line count.
     *
     * @return UploadedFile
     */
    public function getFileLineCount()
    {
    	$file = $this->file;
    	
    	
    }
    
    
    
    /**
     * Process file based on transaction
     *
     * @return boolean
     */
    public function getDataLine($line,$importdefnid)
    {
    	$file = $this->file;
    	
    	
    }
    
    public function upload()
    {
    	// the file property can be empty if the field is not required
    	if (null === $this->getFile()) {
    		return;
    	}
    
    	// use the original file name here but you should
    	// sanitize it at least to avoid any security issues
    
    	// move takes the target directory and then the
    	// target filename to move to
    	$this->getFile()->move(
    			$this->getUploadRootDir(),
    			$this->getFile()->getClientOriginalName()
    	);
    
    	// set the path property to the filename where you've saved the file
    	$this->path = $this->getFile()->getClientOriginalName();
    
    	// clean up the file property as you won't need it anymore
    	$this->file = null;
    }
}