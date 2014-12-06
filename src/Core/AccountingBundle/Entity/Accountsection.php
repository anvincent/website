<?php
// src/Core/AccountingBundle/Entity/Accountsection.php

namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Core\AccountingBundle\Entity\Repository\AccountsectionRepository")
 * @ORM\Table(name="accountsection")
 * @ORM\HasLifecycleCallbacks
 */
class Accountsection
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", length=11)
	 */
	protected $sectionid;
	
	/**
	 * @ORM\Column(type="text")
	 */
	protected $sectionname;

	/**
	 * @ORM\OneToMany(targetEntity="Accountgroups", mappedBy="accountsection")
	 */
	protected $accountgroups;
	
	public function __construct()
	{
		$this->accountgroups = new ArrayCollection();
	}

    /**
     * Set sectionid
     *
     * @param integer $sectionid
     * @return Accountsection
     */
    public function setSectionid($sectionid)
    {
        $this->sectionid = $sectionid;

        return $this;
    }

    /**
     * Get sectionid
     *
     * @return integer 
     */
    public function getSectionid()
    {
        return $this->sectionid;
    }

    /**
     * Set sectionname
     *
     * @param string $sectionname
     * @return Accountsection
     */
    public function setSectionname($sectionname)
    {
        $this->sectionname = $sectionname;

        return $this;
    }

    /**
     * Get sectionname
     *
     * @return string 
     */
    public function getSectionname()
    {
        return $this->sectionname;
    }

    /**
     * Add accountgroups
     *
     * @param \Core\AccountingBundle\Entity\Accountgroups $accountgroups
     * @return Accountsection
     */
    public function addAccountgroup(\Core\AccountingBundle\Entity\Accountgroups $accountgroups)
    {
        $this->accountgroups[] = $accountgroups;

        return $this;
    }

    /**
     * Remove accountgroups
     *
     * @param \Core\AccountingBundle\Entity\Accountgroups $accountgroups
     */
    public function removeAccountgroup(\Core\AccountingBundle\Entity\Accountgroups $accountgroups)
    {
        $this->accountgroups->removeElement($accountgroups);
    }

    /**
     * Get accountgroups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccountgroups()
    {
        return $this->accountgroups;
    }
}
