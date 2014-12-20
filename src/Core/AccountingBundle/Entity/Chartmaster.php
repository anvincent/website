<?php
// src/Core/AccountingBundle/Entity/Chartmaster.php

namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Core\AccountingBundle\Entity\Repository\ChartmasterRepository")
 * @ORM\Table(name="chartmaster")
 * @ORM\HasLifecycleCallbacks
 */
class Chartmaster
{
	// Properties
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", length=11)
	 */
	protected $accountcode;
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="string", length=50)
	 */
	protected $accountname;
	
	//@ORM\Column(name="group_", type="string", length=30)
	/**
	 * 
	 * @ORM\ManyToOne(targetEntity="Accountgroups", inversedBy="chartmasters")
	 * @ORM\JoinColumn(name="group_", referencedColumnName="groupname")
	 */
	protected $group_;
	
	// Associations
	
	/**
	 * @ORM\OneToMany(targetEntity="Chartdetails", mappedBy="accountcode")
	 */
	protected $chartdetails;
	
	/**
	 * @ORM\OneToMany(targetEntity="Gltrans", mappedBy="account")
	 */
	protected $gltrans;
	
	// Methods
	
	public function __construct()
	{
		$this->chartdetails = new ArrayCollection();
		$this->gltrans = new ArrayCollection();
	}
	

    /**
     * Set accountcode
     *
     * @param integer $accountcode
     * @return Chartmaster
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
     * Set accountname
     *
     * @param string $accountname
     * @return Chartmaster
     */
    public function setAccountname($accountname)
    {
        $this->accountname = $accountname;

        return $this;
    }

    /**
     * Get accountname
     *
     * @return string 
     */
    public function getAccountname()
    {
        return $this->accountname;
    }

    /**
     * Set group
     *
     * @param string $group
     * @return Chartmaster
     */
    public function setGroup_($group)
    {
        $this->group_ = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return string 
     */
    public function getGroup_()
    {
        return $this->group_;
    }

    /**
     * Add chartdetails
     *
     * @param \Core\AccountingBundle\Entity\Chartdetails $chartdetails
     * @return Chartmaster
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
     * @return Chartmaster
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

    /**
     * Set group_
     *
     * @param \Core\AccountingBundle\Entity\Accountgroups $group
     * @return Chartmaster
     */
    public function setGroup(\Core\AccountingBundle\Entity\Accountgroups $group = null)
    {
        $this->group_ = $group;

        return $this;
    }

    /**
     * Get group_
     *
     * @return \Core\AccountingBundle\Entity\Accountgroups 
     */
    public function getGroup()
    {
        return $this->group_;
    }
}
