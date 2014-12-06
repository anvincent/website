<?php
// src/Core/AccountingBundle/Entity/Gltest.php

namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Core\AccountingBundle\Entity\Repository\GltestRepository")
 * @ORM\Table(name="gltest")
 * @ORM\HasLifecycleCallbacks
 */
class Gltest
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", length=11)
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $counterindex;
	
	/**
	 * @ORM\Column(type="smallint", length=6)
	 */
	protected $type;
	
	/**
	 * @ORM\Column(type="bigint", length=16)
	 */
	protected $typeno;
	
	/**
	 * @ORM\Column(type="integer", length=11)
	 */
	protected $chequeno;
	
	/**
	 * @ORM\Column(type="date")
	 */
	protected $trandate;
	
	/**
	 * @ORM\Column(type="smallint", length=6)
	 */
	protected $periodno;
	
	/**
	 * @ORM\Column(type="integer", length=11)
	 */
	protected $account;
	
	/**
	 * @ORM\Column(type="string", length=200)
	 */
	protected $narrative;
	
	/**
	 * @ORM\Column(type="float")
	 */
	protected $amount;
	
	/**
	 * @ORM\Column(type="smallint", length=4)
	 */
	protected $posted;
	
	/**
	 * @ORM\Column(type="string", length=20)
	 */
	protected $jobref;
	
	/**
	 * @ORM\Column(type="smallint", length=4)
	 */
	protected $tag;
	
	
	
	

    /**
     * Get counterindex
     *
     * @return integer 
     */
    public function getCounterindex()
    {
        return $this->counterindex;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Gltest
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set typeno
     *
     * @param integer $typeno
     * @return Gltest
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
     * Set chequeno
     *
     * @param integer $chequeno
     * @return Gltest
     */
    public function setChequeno($chequeno)
    {
        $this->chequeno = $chequeno;

        return $this;
    }

    /**
     * Get chequeno
     *
     * @return integer 
     */
    public function getChequeno()
    {
        return $this->chequeno;
    }

    /**
     * Set trandate
     *
     * @param \DateTime $trandate
     * @return Gltest
     */
    public function setTrandate($trandate)
    {
        $this->trandate = $trandate;

        return $this;
    }

    /**
     * Get trandate
     *
     * @return \DateTime 
     */
    public function getTrandate()
    {
        return $this->trandate;
    }

    /**
     * Set periodno
     *
     * @param integer $periodno
     * @return Gltest
     */
    public function setPeriodno($periodno)
    {
        $this->periodno = $periodno;

        return $this;
    }

    /**
     * Get periodno
     *
     * @return integer 
     */
    public function getPeriodno()
    {
        return $this->periodno;
    }

    /**
     * Set account
     *
     * @param integer $account
     * @return Gltest
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return integer 
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set narrative
     *
     * @param string $narrative
     * @return Gltest
     */
    public function setNarrative($narrative)
    {
        $this->narrative = $narrative;

        return $this;
    }

    /**
     * Get narrative
     *
     * @return string 
     */
    public function getNarrative()
    {
        return $this->narrative;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return Gltest
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set posted
     *
     * @param integer $posted
     * @return Gltest
     */
    public function setPosted($posted)
    {
        $this->posted = $posted;

        return $this;
    }

    /**
     * Get posted
     *
     * @return integer 
     */
    public function getPosted()
    {
        return $this->posted;
    }

    /**
     * Set jobref
     *
     * @param string $jobref
     * @return Gltest
     */
    public function setJobref($jobref)
    {
        $this->jobref = $jobref;

        return $this;
    }

    /**
     * Get jobref
     *
     * @return string 
     */
    public function getJobref()
    {
        return $this->jobref;
    }

    /**
     * Set tag
     *
     * @param integer $tag
     * @return Gltest
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return integer 
     */
    public function getTag()
    {
        return $this->tag;
    }
}
