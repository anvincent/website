<?php
// src/Core/AccountingBundle/Entity/Journal.php
//	Placeholder class to build Journal Entry forms

namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

class Journal
{
	// Properties

	protected $typeno;
	
	protected $trandate;
	
	protected $periodno;
	
	protected $tag;

	protected $journalentries;

	// Methods

    public function __construct()
    {
    	$this->journalentries = new ArrayCollection();
    }
    
	/**
	 * Set typeno
	 *
	 * @param integer $typeno
	 * @return Chartdetails
	 */
	public function setTypeno($typeno)
	{
		$this->typeno = $typeno;

		return $this;
	}

	/**
	 * Get typeno
	 *
	 * @return integer
	 */
	public function getTypeno()
	{
		return $this->typeno;
	}
	
	/**
	 * Set trandate
	 *
	 * @param \DateTime $trandate
	 * @return Gltrans
	 */
	public function setTrandate($trandate)
	{
		$this->trandate = $trandate;
	
		return $this;
	}
	
	/**
	 * Get trandate
	 *
	 * @return \DateTime
	 */
	public function getTrandate()
	{
		return $this->trandate;
	}
	
	/**
	 * Set periodno
	 *
	 * @param integer $periodno
	 * @return Gltrans
	 */
	public function setPeriodno($periodno)
	{
		$this->periodno = $periodno;
	
		return $this;
	}
	
	/**
	 * Get periodno
	 *
	 * @return integer
	 */
	public function getPeriodno()
	{
		return $this->periodno;
	}
	
	/**
	 * Set tag
	 *
	 * @param integer $tag
	 * @return Gltrans
	 */
	public function setTag($tag)
	{
		$this->tag = $tag;
	
		return $this;
	}
	
	/**
	 * Get tag
	 *
	 * @return integer
	 */
	public function getTag()
	{
		return $this->tag;
	}
	
	/**
	 * Set journalentries
	 *
	 * @param array $journalentries
	 * @return array
	 */
	public function setJournalentries($journalentries)
	{
		$this->journalentries = $journalentries;

		return $this;
	}
	
	/**
	 * Add journalentry
	 *
	 * @param array $journalentries
	 * @return array
	 */
	public function addJournalentries($journalentries)
	{
		if (!$this->journalentries->contains($journalentries)) {
			$this->journalentries->add($journalentries);
		}
		
		return $this;
	}

	/**
	 * Get journalentries
	 *
	 * @return array
	 */
	public function getJournalentries()
	{
		return $this->journalentries;
	}
}