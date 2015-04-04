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
    
    protected $processedlines;
    
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
	 * Set processedlines
	 *
	 * @param array $processedlines
	 * @return array
	 */
	public function setProcessedlines($processedlines)
	{
		$this->processedlines = $processedlines;

		return $this;
	}
	
	/**
	 * Add processedfile
	 *
	 * @param array $processedfile
	 * @return array
	 */
	public function addProcessedfile(array $processedlines)
	{
		if(!$this->getProcessedlines()->contains($processedlines)) {
			$this->getProcessedlines()->add($processedlines);
		}
		
		return $this;
	}

	/**
	 * Get journalentries
	 *
	 * @return array
	 */
	public function getProcessedlines()
	{
		return $this->processedlines;
	}
    
    /**
     * process uploaded file based on search criteria
     *
     * @param obj $importoption
     * @return boolean
     */
    public function process($importoption)
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