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
}