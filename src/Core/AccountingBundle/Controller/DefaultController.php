<?php

namespace Core\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreAccountingBundle:Default:index.html.twig');
    }
}
