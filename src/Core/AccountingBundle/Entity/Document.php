<?php 
// src/AppBundle/Entity/Document.php
namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Document
{
	// Properties

    public $name;

    public $linecount;
    
    protected $processedfile;
    
    private $file;

	// Methods

    public function __construct()
    {
    	$this->processedfile = new ArrayCollection();
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
    	$uploadedfile = new \SplFileObject($file);
    	$this->name = $uploadedfile->getFilename();
    	$this->file = $uploadedfile;
    	$this->setLinecount();
    }
    
    /**
     * Set line count.
     *
     * @param UploadedFile $file
     */
    protected function setLinecount()
    {
    	$file = $this->file;
    	$file->seek($file->getSize());
    	$this->linecount = $file->key();
    	$file->rewind();
    }
    
    /**
     * Get line count.
     *
     * @return UploadedFile
     */
    public function getLinecount()
    {
    	return $this->linecount;
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
	 * Set processedfile
	 *
	 * @param array $processedfile
	 * @return array
	 */
	public function setProcessedfile($processedfile)
	{
		$this->processedfile = $processedfile;

		return $this;
	}
	
	/**
	 * Add processedfile
	 *
	 * @param array $processedfile
	 * @return array
	 */
	public function addProcessedfile(array $processedfile)
	{
		if(!$this->getProcessedfile()->contains($processedfile)) {
			$this->getProcessedfile()->add($processedfile);
		}
		
		return $this;
	}

	/**
	 * Get journalentries
	 *
	 * @return array
	 */
	public function getProcessedfile()
	{
		return $this->journalentries;
	}
    
    
    
    
    
    
    /**
     * Process file based on transaction
     *
     * @return boolean
     */
    public function getDataLine($line,$importdefnid)
    {
    	
    }
    
    /**
     * process uploaded file based on search criteria
     *
     * @param obj $importoption
     * @return boolean
     */
    public function upload($importoption)
    {
    	$fileObj = $this->file;
    	$dataheader = json_decode($importoption->getDataheaderdefn());
    	
    	$beginIndicator = 0;
		$searchCount = count($dataheader->{'search'});
    	
		while(!$fileObj->eof()) {
			$line = $fileObj->fgetcsv();
			if($line[0]!=NULL) {
				if($beginIndicator==$searchCount) {
					// read file as normal
					
				} else {
					foreach($line AS $element) {
						if($beginIndicator==$searchCount) break;
						if(strpos($element,$dataheader->{'search'}[$beginIndicator]->{$beginIndicator})!==false) {
							$beginIndicator++;
						}
					}
				}
			}
		} // end of while
		
		
    	
    }
}