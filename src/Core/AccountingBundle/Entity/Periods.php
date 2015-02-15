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
	protected $periodno;
	
	/**
	 * @ORM\Column(name="lastdate_in_period", type="date")
	 */
	protected $lastdateinperiod;
	
	// Associations
	
	/**
	 * @ORM\OneToMany(targetEntity="Chartdetails", mappedBy="period")
	 */
	protected $chartdetails;
	
	/**
	 * @ORM\OneToMany(targetEntity="Gltrans", mappedBy="periodno")
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
    public function setPeriodno($periono)
    {
        $this->periodno = $periodno;

        return $this;
    }

    /**
     * Get periono
     *
     * @return integer 
     */
    public function getPeriodno()
    {
        return $this->periodno;
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

    /**
     * Add chartdetails
     *
     * @param \Core\AccountingBundle\Entity\Chartdetails $chartdetails
     * @return Periods
     */
    public function addChartdetail(\Core\AccountingBundle\Entity\Chartdetails $chartdetails)
    {
        $this->chartdetails[] = $chartdetails;

        return $this;
    }

    /**
     * Remove chartdetails
     *
     * @param \Core\AccountingBundle\Entity\Chartdetails $chartdetails
     */
    public function removeChartdetail(\Core\AccountingBundle\Entity\Chartdetails $chartdetails)
    {
        $this->chartdetails->removeElement($chartdetails);
    }

    /**
     * Get chartdetails
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChartdetails()
    {
        return $this->chartdetails;
    }

    /**
     * Add gltrans
     *
     * @param \Core\AccountingBundle\Entity\Gltrans $gltrans
     * @return Periods
     */
    public function addGltran(\Core\AccountingBundle\Entity\Gltrans $gltrans)
    {
        $this->gltrans[] = $gltrans;

        return $this;
    }

    /**
     * Remove gltrans
     *
     * @param \Core\AccountingBundle\Entity\Gltrans $gltrans
     */
    public function removeGltran(\Core\AccountingBundle\Entity\Gltrans $gltrans)
    {
        $this->gltrans->removeElement($gltrans);
    }

    /**
     * Get gltrans
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGltrans()
    {
        return $this->gltrans;
    }
}
