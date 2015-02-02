<?php

namespace Core\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreAccountingBundle:Default:index.html.twig');
    }
    
    public function accountingAction()
    {
        return $this->render('CoreAccountingBundle:Default:accounting.html.twig');
    }
    
    public function investmentsAction()
    {
        return $this->render('CoreAccountingBundle:Default:investments.html.twig');
    }
    
    public function assetsAction()
    {
    	return $this->render('CoreAccountingBundle:Default:assets.html.twig');
    }
}
