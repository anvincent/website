<?php

namespace Core\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
    	return $this->render('CoreBlogBundle:Main:index.html.twig',array('name' => $name));
    }

}
