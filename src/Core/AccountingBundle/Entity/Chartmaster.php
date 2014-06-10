<?php
// src/Core/AccountingBundle/Entity/Chartmaster.php

namespace Core\AccountingBundle\Entity;

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
	
	
}