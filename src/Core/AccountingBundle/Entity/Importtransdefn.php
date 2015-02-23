<?php
// src/Core/AccountingBundle/Entity/Importtransdefn.php

namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Core\AccountingBundle\Entity\Repository\ImporttransdefnRepository")
 * @ORM\Table(name="importtransdefn")
 * @ORM\HasLifecycleCallbacks
 */
class Importtransdefn
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", length=11)
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $importdefnid;
	
	/**
	 * @ORM\Column(type="string", length=45)
	 */
	protected $accountname;
	
	/**
	 * @ORM\Column(name="dataheader_defn", type="string", length=255)
	 */
	protected $dataheaderdefn;
	
	/**
	 * @ORM\Column(name="dataline_account", type="integer", length=11)
	 */
	protected $datalineaccount;
	
	/**
	 * @ORM\Column(name="dataline_narrative", type="smallint", length=4)
	 */
	protected $datalinenarrative;
	
	/**
	 * @ORM\Column(name="dataline_amount", type="smallint", length=4)
	 */
	protected $datalineamount;
	
	/**
	 * @ORM\Column(name="dataline_date", type="smallint", length=4)
	 */
	protected $datalinedate;
	
	/**
	 * @ORM\Column(name="dataline_tag", type="smallint", length=4)
	 */
	protected $datalinetag;
	
	/**
	 * Set importdefnid
	 *
	 * @param integer $importdefnid
	 * @return Importtransdefn
	 */
	public function setImportdefnid($importdefnid)
	{
		$this->importdefnid = $importdefnid;
	
		return $this;
	}

    /**
     * Get importdefnid
     *
     * @return integer 
     */
    public function getImportdefnid()
    {
        return $this->importdefnid;
    }

    /**
     * Set accountname
     *
     * @param string $accountname
     * @return Importtransdefn
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
     * Set dataheaderdefn
     *
     * @param string $dataheaderdefn
     * @return Importtransdefn
     */
    public function setDataheaderdefn($dataheaderdefn)
    {
        $this->dataheaderdefn = $dataheaderdefn;

        return $this;
    }

    /**
     * Get dataheaderdefn
     *
     * @return string 
     */
    public function getDataheaderdefn()
    {
        return $this->dataheaderdefn;
    }

    /**
     * Set datalineaccount
     *
     * @param integer $datalineaccount
     * @return Importtransdefn
     */
    public function setDatalineaccount($datalineaccount)
    {
        $this->datalineaccount = $datalineaccount;

        return $this;
    }

    /**
     * Get datalineaccount
     *
     * @return integer 
     */
    public function getDatalineaccount()
    {
        return $this->datalineaccount;
    }

    /**
     * Set datalinenarrative
     *
     * @param integer $datalinenarrative
     * @return Importtransdefn
     */
    public function setDatalinenarrative($datalinenarrative)
    {
        $this->datalinenarrative = $datalinenarrative;

        return $this;
    }

    /**
     * Get datalinenarrative
     *
     * @return integer 
     */
    public function getDatalinenarrative()
    {
        return $this->datalinenarrative;
    }

    /**
     * Set datalineamount
     *
     * @param integer $datalineamount
     * @return Importtransdefn
     */
    public function setDatalineamount($datalineamount)
    {
        $this->datalineamount = $datalineamount;

        return $this;
    }

    /**
     * Get datalineamount
     *
     * @return integer 
     */
    public function getDatalineamount()
    {
        return $this->datalineamount;
    }

    /**
     * Set datalinedate
     *
     * @param integer $datalinedate
     * @return Importtransdefn
     */
    public function setDatalinedate($datalinedate)
    {
        $this->datalinedate = $datalinedate;

        return $this;
    }

    /**
     * Get datalinedate
     *
     * @return integer 
     */
    public function getDatalinedate()
    {
        return $this->datalinedate;
    }

    /**
     * Set datalinetag
     *
     * @param integer $datalinetag
     * @return Importtransdefn
     */
    public function setDatalinetag($datalinetag)
    {
        $this->datalinetag = $datalinetag;

        return $this;
    }

    /**
     * Get datalinetag
     *
     * @return integer 
     */
    public function getDatalinetag()
    {
        return $this->datalinetag;
    }
}
