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
	
	
	
}