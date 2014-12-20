<?php
// src/Core/AccountingBundle/Entity/Accountgroups.php

namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Core\AccountingBundle\Entity\Repository\AccountgroupsRepository")
 * @ORM\Table(name="accountgroups")
 * @ORM\HasLifecycleCallbacks
 */
class Accountgroups
{
	
	// Properties
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="string", length=30)
	 */
	protected $groupname;
	
	/**
	 * @ORM\Column(type="integer", length=11)
	 * @ORM\ManyToOne(targetEntity="Accountsection", inversedBy="accountgroups")
	 * @ORM\JoinColumn(name="sectioninaccounts", referencedColumnName="sectionid")
	 */
	protected $sectioninaccounts;
	
	/**
	 * @ORM\Column(type="smallint", length=4)
	 */
	protected $pandl;
	
	/**
	 * @ORM\Column(type="smallint", length=6)
	 */
	protected $sequenceintb;
	
	/**
	 * @ORM\Column(type="string", length=30)
	 */
	protected $parentgroupname;
	
	// Associations
	
	/**
	 * @ORM\OneToMany(targetEntity="Chartmaster", mappedBy="group_")
	 */
	protected $chartmasters;
	
	// Methods
	
	public function __construct()
	{
		$this->chartmasters = new ArrayCollection();
	}
	
	public function __toString()
	{
		return $this->groupname;
	}

    /**
     * Set groupname
     *
     * @param string $groupname
     * @return Accountgroups
     */
    public function setGroupname($groupname)
    {
        $this->groupname = $groupname;

        return $this;
    }

    /**
     * Get groupname
     *
     * @return string 
     */
    public function getGroupname()
    {
        return $this->groupname;
    }

    /**
     * Set sectioninaccounts
     *
     * @param integer $sectioninaccounts
     * @return Accountgroups
     */
    public function setSectioninaccounts($sectioninaccounts)
    {
        $this->sectioninaccounts = $sectioninaccounts;

        return $this;
    }

    /**
     * Get sectioninaccounts
     *
     * @return integer 
     */
    public function getSectioninaccounts()
    {
        return $this->sectioninaccounts;
    }

    /**
     * Set pandl
     *
     * @param integer $pandl
     * @return Accountgroups
     */
    public function setPandl($pandl)
    {
        $this->pandl = $pandl;

        return $this;
    }

    /**
     * Get pandl
     *
     * @return integer 
     */
    public function getPandl()
    {
        return $this->pandl;
    }

    /**
     * Set sequenceintb
     *
     * @param integer $sequenceintb
     * @return Accountgroups
     */
    public function setSequenceintb($sequenceintb)
    {
        $this->sequenceintb = $sequenceintb;

        return $this;
    }

    /**
     * Get sequenceintb
     *
     * @return integer 
     */
    public function getSequenceintb()
    {
        return $this->sequenceintb;
    }

    /**
     * Set parentgroupname
     *
     * @param string $parentgroupname
     * @return Accountgroups
     */
    public function setParentgroupname($parentgroupname)
    {
        $this->parentgroupname = $parentgroupname;

        return $this;
    }

    /**
     * Get parentgroupname
     *
     * @return string 
     */
    public function getParentgroupname()
    {
        return $this->parentgroupname;
    }

    /**
     * Add chartmasters
     *
     * @param \Core\AccountingBundle\Entity\Chartmaster $chartmasters
     * @return Accountgroups
     */
    public function addChartmaster(\Core\AccountingBundle\Entity\Chartmaster $chartmasters)
    {
        $this->chartmasters[] = $chartmasters;

        return $this;
    }

    /**
     * Remove chartmasters
     *
     * @param \Core\AccountingBundle\Entity\Chartmaster $chartmasters
     */
    public function removeChartmaster(\Core\AccountingBundle\Entity\Chartmaster $chartmasters)
    {
        $this->chartmasters->removeElement($chartmasters);
    }

    /**
     * Get chartmasters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChartmasters()
    {
        return $this->chartmasters;
    }
}
