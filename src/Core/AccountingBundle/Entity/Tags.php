<?php
// src/Core/AccountingBundle/Entity/Tags.php

namespace Core\AccountingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Core\AccountingBundle\Entity\Repository\TagsRepository")
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
	
	/**
	 * Set tagref
	 */
	public function setTagref()
	{
		
	}
	
    /**
     * Get tagref
     *
     * @return integer 
     */
    public function getTagref()
    {
        return $this->tagref;
    }

    /**
     * Set tagdescription
     *
     * @param string $tagdescription
     * @return Tags
     */
    public function setTagdescription($tagdescription)
    {
        $this->tagdescription = $tagdescription;

        return $this;
    }

    /**
     * Get tagdescription
     *
     * @return string 
     */
    public function getTagdescription()
    {
        return $this->tagdescription;
    }
}
