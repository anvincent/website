<?php
// src/Core/AccountingBundle/Controller/PageController.php

namespace Core\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreAccountingBundle:Page:index.html.twig');
    }
    
    public function transactionsAction()
    {
        return $this->render('CoreAccountingBundle:Page:transactions.html.twig');
    }
    
    public function maintenanceAction()
    {
        return $this->render('CoreAccountingBundle:Page:maintenance.html.twig');
    }
    
    
    
    
    /*
    
    
    public function chartmasterAction($account_id=null)
    {
    	$em = $this->getDoctrine()
    			   ->getManager();
    	$transactionData = $em->getRepository('CoreAccountingBundle:Chartmaster')
    						  ->findAll();
    	return $this->render('CoreAccountingBundle:Page:test.html.twig', array(
    			'accounts' => $transactionData
    	));
    }
    
    */
    
    public function editAction($page,$id=null) {
    	
    }
    
    
    
    
    
}