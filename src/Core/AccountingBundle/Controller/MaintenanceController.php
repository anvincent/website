<?php
// src/Core/AccountingBundle/Controller/MaintenanceController.php

namespace Core\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Core\AccountingBundle\Entity\Chartmaster;
use Core\AccountingBundle\Form\ChartmasterType;

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
	
	/* Chart of Accounts - chartmaster 
	 * 		show
	 * 		edit
	 * 		get
	 * 		post
	 * 		delete
	 */
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
	
	public function editchartmasterAction($account_id)
	{
		$chartmaster = $this->getChartmaster($account_id);
		$defaultgroup = $chartmaster->getGroup_();
		$form = $this->createForm(new ChartmasterType($defaultgroup), $chartmaster);
		$form->get('chartmaster')->setData($chartmaster);
		return $this->render('CoreAccountingBundle:Maintenance:chartmasteredit.html.twig', array(
				'chartmaster' => $chartmaster,
				'form'        => $form->createView()
		));
	}
	
	protected function getChartmaster($account_id) 
	{
		$em = $this->getDoctrine()->getManager();
			
		$chartmaster = $em->getRepository('CoreAccountingBundle:Chartmaster')
			//->findChartmasterByAccountcode($account_id);
			->findOneByaccountcode($account_id);
		
		if (!$chartmaster) {
			throw $this->createNotFoundException('Unable to find Account.');
		}
		
		return $chartmaster;
	}
	
	public function postchartmasterAction(Request $request)
	{
		$chartmaster = new Chartmaster();
        $request = $this->getRequest();
		$form = $this->createForm(new ChartmasterType(), $chartmaster);
        $form->bind($request);
		
		if ($form->isValid()) {
			
			
			
        	$em = $this->getDoctrine()
        			   ->getManager();
        	$em->persist($chartmaster);
        	$em->flush();
		
			return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_chartmaster_show'));
		}
		return $this->render('CoreAccountingBundle:Maintenance:chartmasteredit.html.twig', array(
				'chartmaster' => $chartmaster,
				'form'        => $form->createView()
		));
	}
	
	
	
	
	
	
	
	public function newchartmasterAction($chartmaster=null)
	{
		if(isset($data)) {
			$chartmaster = new Chartmaster();
		}
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