<?php
// src/Core/AccountingBundle/Controller/MaintenanceController.php

namespace Core\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
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
	 * 		add
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

	public function addchartmasterAction(Request $request)
	{
		$chartmaster = new Chartmaster();
		$form = $this->createForm(new ChartmasterType(), $chartmaster);
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$em = $this	->getDoctrine()
						->getManager();
			$em->persist($chartmaster);
			$em->flush();
			
			$session = $this->getRequest()->getSession();
			$session->getFlashBag()->add('returnMessage','Account added');
			
			return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_chartmaster_show'),301);
		}
		
		return $this->render('CoreAccountingBundle:Maintenance:chartmasteradd.html.twig', array(
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
        	
        	$session = $this->getRequest()->getSession();
        	$session->getFlashBag()->add('returnMessage',$returnMessage);
        	return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_chartmaster_show'),301);
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
	
	//
	//
	// check if the following is used
	//
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
	//
	//
		
	public function deletechartmasterAction($account_id)
	{
		//TEST
		$errorArray = array();
				$errorArray[1] = "account_id is: $account_id";													//test
		
		$em = $this->getDoctrine()
		->getManager();
		$chartmaster = $this->getChartmaster($account_id);
				$q = $chartmaster->getAccountcode();															//test
				$errorArray[2] = "account_id is: $q";															//test
		if (!$chartmaster) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}
		$form = $this->createForm(new ChartmasterType(), $chartmaster);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
				$errorArray[3] = 'inside POST if';																//test
			$form->bind($request);
			$accountcode = $form["accountcode"]->getData();
				$errorArray[4] = "account_id from form is: $accountcode";										//test
			$confirm = $form["Confirm"]->getData();
			if ($form->isValid()) {
//				$em->remove($chartmaster);
//				$em->flush();
				$returnMessage = "Account $accountcode successfully removed.";
			} else {
				$returnMessage = "An error occurred during the removing of account $accountcode.";
			}
			$errorArray[5] = $returnMessage;																	//test
//			$request->getSession()->getFlashBag()->add('returnMessage',$returnMessage);
//			return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_chartmaster_show'),301);
			return new Response($errorArray);
		} else {
			return $this->render('CoreAccountingBundle:Maintenance:chartmasterdelete.html.twig', array(
					'chartmaster' => $chartmaster,
					'accountcode_id'  => $account_id,
					'form'        => $form->createView()
			));
		}
	}
	
	/* Budget - chartdetails */
	
	
	
	
    
}