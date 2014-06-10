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
	
	/**
	 * @ORM\Column(name="group_", type="string", length=30)
	 */
	protected $group;
	
	

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
    public function setGroup($group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return string 
     */
    public function getGroup()
    {
        return $this->group;
    }
}
