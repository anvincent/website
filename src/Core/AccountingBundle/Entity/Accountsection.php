<?php
// src/Core/AccountingBundle/Entity/Accountgroups.php

namespace Core\AccountingBundle\Entity;

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

	
	
}