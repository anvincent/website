<?php
// src/Core/AccountingBundle/Entity/Tags.php

namespace Core\AccountingBundle\Entity;

/**
 * @ORM\Entity(repositoryClass="Core\AccountingBundle\Entity\Repository\Tags")
 * @ORM\Table(name="tags")
 * @ORM\HasLifecycleCallbacks
 */
class Tags
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="smallint", length=4)
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $tagref;
	
	/**
	 * @ORM\Column(type="string", length=50)
	 */
	protected $tagdescription;
	
	
	
	
}