<?php
// src/Core/AccountingBundle/Entity/Accountgroups.php

namespace Core\AccountingBundle\Entity;

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
	
	
}