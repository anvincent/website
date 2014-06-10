<?php
// src/Core/AccountingBundle/Entity/Accountgroups.php

namespace Core\AccountingBundle\Entity;

/**
 * @ORM\Entity(repositoryClass="Core\AccountingBundle\Entity\Repository\ChartdetailsRepository")
 * @ORM\Table(name="chartdetails")
 * @ORM\HasLifecycleCallbacks
 */
class Chartdetails
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", length=11)
	 */
	protected $accountcode;
	
	/**
	 * @ORM\Id
	 * @ORM\Column(type="smallint", length=6)
	 */
	protected $period;
	
	/**
	 * @ORM\Column(type="float")
	 */
	protected $budget;

	/**
	 * @ORM\Column(type="float")
	 */
	protected $actual;
	
	/**
	 * @ORM\Column(type="float")
	 */
	protected $bfwd;
	
	/**
	 * @ORM\Column(type="float")
	 */
	protected $bfwdbudget;

	
	
}