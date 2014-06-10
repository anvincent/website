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
	
	
	
	
}