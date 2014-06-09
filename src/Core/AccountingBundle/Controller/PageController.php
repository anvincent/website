<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Core\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreAccountingBundle:Default:index.html.twig');
    }
}