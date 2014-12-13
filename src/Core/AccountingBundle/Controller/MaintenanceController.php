<?php
// src/Core/AccountingBundle/Controller/MaintenanceController.php

namespace Core\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MaintenanceController extends Controller
{
	/* Main */
	public function indexAction()
	{
		return $this->render('CoreAccountingBundle:Maintenance:index.html.twig');
	}	
	
	/* Import Transaction Definitions - importtransdefn */
	
	/* Account Sections - accountsection */
	
	/* Account Groups - accountgroups */
	
	/* Chart of Accounts - chartmaster */
	public function showchartmasterAction()
	{
		$em = $this->getDoctrine()
		->getManager();
		 
		$transactionData = $em->getRepository('CoreAccountingBundle:Chartmaster')
		->findAll();
		 
		return $this->render('CoreAccountingBundle:Maintenance:chartmastershow.html.twig', array(
				'title' => 'Chart of Accounts',
				'accounts' => $transactionData
		));
	}
	
	public function editchartmasterAction($account_id=null)
	{
		$em = $this->getDoctrine()
		->getManager();
			
		$transactionData = $em->getRepository('CoreAccountingBundle:Chartmaster')
		->findBy(array('accountcode' => $account_id));
		
		
		
		
		
		
		// currently only displays the selected account
		$em = $this->getDoctrine()
		->getManager();
		 
		$transactionData = $em->getRepository('CoreAccountingBundle:Chartmaster')
		->findBy(array('accountcode' => $account_id));
		 
		return $this->render('CoreAccountingBundle:Maintenance:show.html.twig', array(
				'title' => 'Chart of Accounts',
				'accounts' => $transactionData
		));
	}
	
	
	
	
	
	public function newchartmasterAction()
	{
		$chartmaster = new Chartmaster();
		$form = $this->createForm(new ChartmasterType(), $chartmaster);
		return $this->render('CoreAccountingBundle:Maintenance:chartmaster.form.html.twig', array(
				'chartmaster' => $chartmaster,
				'form'        => $form->createView()
		));
	}
	
	public function createchartmasterAction()
	{
		
		
		
		
	}
	
	public function deletechartmasterAction($account_id=null)
	{
		
	}
	
	/* Budget - chartdetails */
	
	
	
	
    
}