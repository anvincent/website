<?php
// src/Core/AccountingBundle/Entity/Accountgroups.php

namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Core\AccountingBundle\Entity\Repository\ChartdetailsRepository")
 * @ORM\Table(name="chartdetails")
 * @ORM\HasLifecycleCallbacks
 */
class Chartdetails
{
	// Properties
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", length=11)
	 */
	protected $accountcode;
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="smallint", length=6)
	 */
	protected $period;
	
	/**
	 * @ORM\Column(type="float")
	 */
	protected $budget;

	/**
	 * @ORM\Column(type="float")
	 */
	protected $actual;
	
	/**
	 * @ORM\Column(type="float")
	 */
	protected $bfwd;
	
	/**
	 * @ORM\Column(type="float")
	 */
	protected $bfwdbudget;
	
	// Associations

	/**
	 * @ORM\ManyToOne(targetEntity="Chartmaster", inversedBy="chartdetails")
	 * @ORM\JoinColumn(name="accountcode", referencedColumnName="accountcode")
	 */
	protected $chartmaster;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Periods", inversedBy="chartdetails")
	 * @ORM\JoinColumn(name="period", referencedColumnName="periodno")
	 */
	protected $periodref;
	
	// Methods

    /**
     * Set accountcode
     *
     * @param integer $accountcode
     * @return Chartdetails
     */
    public function setAccountcode($accountcode)
    {
        $this->accountcode = $accountcode;

        return $this;
    }

    /**
     * Get accountcode
     *
     * @return integer 
     */
    public function getAccountcode()
    {
        return $this->accountcode;
    }

    /**
     * Set period
     *
     * @param integer $period
     * @return Chartdetails
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return integer 
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set budget
     *
     * @param float $budget
     * @return Chartdetails
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return float 
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set actual
     *
     * @param float $actual
     * @return Chartdetails
     */
    public function setActual($actual)
    {
        $this->actual = $actual;

        return $this;
    }

    /**
     * Get actual
     *
     * @return float 
     */
    public function getActual()
    {
        return $this->actual;
    }

    /**
     * Set bfwd
     *
     * @param float $bfwd
     * @return Chartdetails
     */
    public function setBfwd($bfwd)
    {
        $this->bfwd = $bfwd;

        return $this;
    }

    /**
     * Get bfwd
     *
     * @return float 
     */
    public function getBfwd()
    {
        return $this->bfwd;
    }

    /**
     * Set bfwdbudget
     *
     * @param float $bfwdbudget
     * @return Chartdetails
     */
    public function setBfwdbudget($bfwdbudget)
    {
        $this->bfwdbudget = $bfwdbudget;

        return $this;
    }

    /**
     * Get bfwdbudget
     *
     * @return float 
     */
    public function getBfwdbudget()
    {
        return $this->bfwdbudget;
    }
}
