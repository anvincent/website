<?php
// src/Core/BlogBundle/Entity/Blog.php

namespace Core\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog")
 */
class Blog
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
    /**
     * @ORM\Column(type="string")
     */
    protected $title;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $author;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $blog;
    
    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $image;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $tags;
    
    protected $comments = array();
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;
    
    public function addComment(Comment $comment)
    {
    	$this->comments[] = $comment;
    }
    
    public function getComments()
    {
    	return $this->comments;
    }
}