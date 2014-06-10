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
}