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
	/**
	 * @ORM\Id
	 * @ORM\Column(type="string", length=30)
	 * @ORM\OneToMany(targetEntity="Chartmaster", mappedBy="accountgroups")
	 */
	protected $groupname;
	
	/**
	 * @ORM\Column(type="integer", length=11)
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
	
	
	
	public function __construct()
	{
		$this->groupname = new ArrayCollection();
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
}
