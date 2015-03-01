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
	 * Get journalentries
	 *
	 * @return array
	 */
	public function getJournalentries()
	{
		return $this->journalentries;
	}
}