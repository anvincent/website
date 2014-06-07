<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Core\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreBlogBundle:Page:index.html.twig');
    }
    
    public function aboutAction()
    {
    	return $this->render('CoreBlogBundle:Page:about.html.twig');
    }
    
    public function contactAction()
    {
    	return $this->render('CoreBlogBundle:Page:contact.html.twig');
    }
}