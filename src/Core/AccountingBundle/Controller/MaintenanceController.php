<?php
// src/Core/AccountingBundle/Controller/MaintenanceController.php

namespace Core\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

// add entities
use Core\AccountingBundle\Entity\Chartmaster;
use Core\AccountingBundle\Entity\Accountgroups;

// add forms
use Core\AccountingBundle\Form\ChartmasterType;
use Core\AccountingBundle\Form\AccountgroupsType;

class MaintenanceController extends Controller
{
	/* Main */
	public function indexAction()
	{
		return $this->render('CoreAccountingBundle:Maintenance:index.html.twig');
	}	
	
	/* Import Transaction Definitions - importtransdefn */
	
	
	/* Chart of Accounts - chartmaster 
	 * 		show
	 * 		add
	 * 		edit
	 * 		get
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
		$em = $this->getDoctrine()
		->getManager();
		$chartmaster = $this->getChartmaster($account_id);
		if (!$chartmaster) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}
		$form = $this->createForm(new ChartmasterType(), $chartmaster);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			$accountcode = $form["accountcode"]->getData();
			$confirm = $form["Confirm"]->getData();
			if ($form->isValid()) {
				$em->remove($chartmaster);
				$em->flush();
				$returnMessage = "Account $accountcode successfully removed.";
			} else {
				$returnMessage = "An error occurred during the removing of account $accountcode.";
			}
			$request->getSession()->getFlashBag()->add('returnMessage',$returnMessage);
			return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_chartmaster_show'),301);
		} else {
			return $this->render('CoreAccountingBundle:Maintenance:chartmasterdelete.html.twig', array(
					'chartmaster' => $chartmaster,
					'accountcode_id'  => $account_id,
					'form'        => $form->createView()
			));
		}
	}
	
	/* Account Sections - accountsection */
	
	/* Account Groups - accountgroups
	 * 		show
	* 		add
	* 		edit
	* 		get
	* 		delete
	*/
	public function showaccountgroupsAction($returnMessage=null)
	{
		$transactionData = $this->getAccountgroups();
		return $this->render('CoreAccountingBundle:Maintenance:accountgroupsshow.html.twig', array(
				'title' => 'Account Groups',
				'returnMessage' => $returnMessage,
				'groups' => $transactionData
		));
	}

	public function addaccountgroupsAction(Request $request)
	{
		$accountgroups = new Accountgroups();
		$form = $this->createForm(new AccountgroupsType(), $accountgroups);
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$em = $this	->getDoctrine()
						->getManager();
			$em->persist($accountgroups);
			$em->flush();
			
			$session = $this->getRequest()->getSession();
			$session->getFlashBag()->add('returnMessage','Account added');
			
			return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_accountgroups_show'),301);
		}
		
		return $this->render('CoreAccountingBundle:Maintenance:accountgroupsadd.html.twig', array(
				'accountgroups' => $accountgroups,
				'form'        => $form->createView()
		));
	}
	
	public function editAccountgroupsAction($group_id)
	{
		$em = $this->getDoctrine()
				   ->getManager();
		$accountgroups = $this->getAccountgroups($group_id);
		if (!$accountgroups) {
			$accountgroups = new Accountgroups();
		}
        $form = $this->createForm(new AccountgroupsType(), $accountgroups);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
        	$form->bind($request);
        	$groupname = $form["groupname"]->getData();
        	$sectioninaccounts = $form["sectioninaccounts"]->getData();
        	$pandl = $form["pandl"]->getData();
        	$sequenceintb = $form["sequenceintb"]->getData();
        	$parentgroupname = $form["parentgroupname"]->getData();
        	if ($form->isValid()) {
        		$accountgroups->setGroupname($groupname);
        		$accountgroups->setSectioninaccounts($sectioninaccounts);
        		$accountgroups->setPandl($pandl);
        		$accountgroups->setSequenceintb($sequenceintb);
        		$accountgroups->setParentgroupname($parentgroupname);
        		$em->persist($accountgroups);
        		$em->flush();
        		$returnMessage = "Account group $groupname successfully updated.";
        	} else {
        		$returnMessage = "An error occurred during the processing of $groupname.";
        	}
        	$session = $this->getRequest()->getSession();
        	$session->getFlashBag()->add('returnMessage',$returnMessage);
        	return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_accountgroups_show'),301);
        } else {
	        return $this->render('CoreAccountingBundle:Maintenance:accountgroupsedit.html.twig', array(
	        		'chartmaster' => $accountgroups,
	        		'accountcode_id'  => $group_id,
	        		'form'        => $form->createView()
	        ));
        }
	}
	
	
	
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
	
	
	/* Budget - chartdetails */
	
	
	
	
    
}