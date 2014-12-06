<?php
// src/Core/AccountingBundle/Entity/Periods.php

namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Core\AccountingBundle\Entity\Repository\PeriodsRepository")
 * @ORM\Table(name="periods")
 * @ORM\HasLifecycleCallbacks
 */
class Periods
{
	// Properties
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="smallint", length=6)
	 */
	protected $periono;
	
	/**
	 * @ORM\Column(name="lastdate_in_period", type="date")
	 */
	protected $lastdateinperiod;
	
	// Associations
	
	/**
	 * @ORM\OneToMany(targetEntity="Chartdetails", mappedBy="periodref")
	 */
	protected $chartdetails;
	
	/**
	 * @ORM\OneToMany(targetEntity="Gltrans", mappedBy="periodref")
	 */
	protected $gltrans;
	
	
	
	// Methods
	
	public function __construct()
	{
		$this->chartdetails = new ArrayCollection();
		$this->gltrans = new ArrayCollection();
	}

    /**
     * Set periono
     *
     * @param integer $periono
     * @return Periods
     */
    public function setPeriono($periono)
    {
        $this->periono = $periono;

        return $this;
    }

    /**
     * Get periono
     *
     * @return integer 
     */
    public function getPeriono()
    {
        return $this->periono;
    }

    /**
     * Set lastdateinperiod
     *
     * @param \DateTime $lastdateinperiod
     * @return Periods
     */
    public function setLastdateinperiod($lastdateinperiod)
    {
        $this->lastdateinperiod = $lastdateinperiod;

        return $this;
    }

    /**
     * Get lastdateinperiod
     *
     * @return \DateTime 
     */
    public function getLastdateinperiod()
    {
        return $this->lastdateinperiod;
    }
}
