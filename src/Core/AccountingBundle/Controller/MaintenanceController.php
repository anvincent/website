<?php
// src/Core/AccountingBundle/Controller/MaintenanceController.php

namespace Core\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Core\AccountingBundle\Entity\Chartmaster;
use Core\AccountingBundle\Entity\Accountgroups;
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
	
	
	
	protected function getAccountgroups($id=null)
	{
		$em = $this->getDoctrine()->getManager();
		if(isset($id)) {
			$accountgroups = $em	->getRepository('CoreAccountingBundle:Accountgroups')
									->findOneBygroupname($id);
		} else {
			$accountgroups = $em	->getRepository('CoreAccountingBundle:Accountgroups')
									->findAll();
		}
		if (!$accountgroups) {
			throw $this->createNotFoundException('Unable to find Account.');
		}
		return $accountgroups;
	}
	
	/* Chart of Accounts - chartmaster 
	 * 		show
	 * 		edit
	 * 		get
	 * 		post
	 * 		delete
	 */
	public function showchartmasterAction($returnMessage=null)
	{
		$transactionData = $this->getChartmaster();
		return $this->render('CoreAccountingBundle:Maintenance:chartmastershow.html.twig', array(
				'title' => 'Chart of Accounts',
				'returnMessage' => $returnMessage,
				'accounts' => $transactionData
		));
	}

	public function oldeditchartmasterAction($account_id)
	{
		$chartmaster = $this->getChartmaster($account_id);
		//	$groupstage = $chartmaster->getGroup_();
		//	$grouplist = array();
		//	$grouplist[$groupstage] = $groupstage;
		//	$accountgroups = $this->getAccountgroups();
		//	foreach($accountgroups as $group) {
		//		$grouplist[$group->getGroupname()] = $group->getGroupname();
		//	}
		//	$form = $this->createForm(new ChartmasterType($grouplist), $chartmaster);
	
		$form = $this->createForm(new ChartmasterType(), $chartmaster);
	
		return $this->render('CoreAccountingBundle:Maintenance:chartmasteredit.html.twig', array(
				'chartmaster' => $chartmaster,
				'form'        => $form->createView()
		));
	}
	
	public function editchartmasterAction($account_id)
	{
		$em = $this->getDoctrine()
				   ->getManager();
		$chartmaster = $this->getChartmaster($account_id);
		if (!$chartmaster) {
			$chartmaster = new Chartmaster();
			echo "<p>new</p>";
		}
        $form = $this->createForm(new ChartmasterType(), $chartmaster);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
        	$form->bind($request);
        	$accountcode = $form["accountcode"]->getData();
        	$accountname = $form["accountname"]->getData();
        	$group = $form["group_"]->getData();
        	if ($form->isValid()) {
        		$chartmaster->setAccountcode($accountcode);
        		$chartmaster->setAccountname($accountname);
        		$chartmaster->setGroup_($group);
        		$em->persist($chartmaster);
        		$em->flush();
        		$returnMessage = "Account $accountcode successfully updated.";
        	} else {
        		$returnMessage = "An error occurred during the processing of $accountcode.";
        	}
        	$this->showchartmasterAction($returnMessage);
        } else {
	        return $this->render('CoreAccountingBundle:Maintenance:chartmasteredit.html.twig', array(
	        		'chartmaster' => $chartmaster,
	        		'accountcode_id'  => $account_id,
	        		'form'        => $form->createView()
	        ));
        }
	}
	
	protected function getChartmaster($id=null) 
	{
		$em = $this->getDoctrine()->getManager();
		if(isset($id)) {
			$chartmaster = $em	->getRepository('CoreAccountingBundle:Chartmaster')
								->findOneByaccountcode($id);
		} else {
			$chartmaster = $em	->getRepository('CoreAccountingBundle:Chartmaster')
								->findAll();
		}
		if (!$chartmaster) {
			throw $this->createNotFoundException('Unable to find Account.');
		}
		return $chartmaster;
	}
	
	public function postchartmasterAction(Request $request)
	{
		$chartmaster = new Chartmaster();
		$form = $this->createForm(new ChartmasterType(), $chartmaster);
        $form->bind($request);
		if ($form->isValid()) {
			// test
			
			
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