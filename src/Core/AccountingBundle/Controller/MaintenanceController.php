<?php
// src/Core/AccountingBundle/Controller/MaintenanceController.php

namespace Core\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

// add entities
use Core\AccountingBundle\Entity\Chartmaster;
use Core\AccountingBundle\Entity\Accountsection;
use Core\AccountingBundle\Entity\Accountgroups;
use Core\AccountingBundle\Entity\Periods;
use Core\AccountingBundle\Entity\Tags;
use Core\AccountingBundle\Entity\Importtransdefn;

// add forms
use Core\AccountingBundle\Form\ChartmasterType;
use Core\AccountingBundle\Form\AccountsectionType;
use Core\AccountingBundle\Form\AccountgroupsType;
use Core\AccountingBundle\Form\TagsType;
use Core\AccountingBundle\Form\ImporttransdefnType;

class MaintenanceController extends Controller
{
	/* Main */
	public function indexAction()
	{
		return $this->render('CoreAccountingBundle:Maintenance:index.html.twig');
	}	
	
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
	
	/* Account Sections - accountsection
	* 		show
	* 		add
	* 		edit
	* 		get
	* 		delete
	*/
	public function showaccountsectionAction($returnMessage=null)
	{
		$transactionData = $this->getAccountsection();
		return $this->render('CoreAccountingBundle:Maintenance:accountsectionshow.html.twig', array(
				'title'			=> 'Account Section',
				'returnMessage' => $returnMessage,
				'sections'		=> $transactionData
		));
	}

	public function addaccountsectionAction(Request $request)
	{
		$accountsection = new Accountsection();
		$form = $this->createForm(new AccountsectionType(), $accountsection);
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$em = $this	->getDoctrine()
						->getManager();
			$em->persist($accountsection);
			$em->flush();
			
			$session = $this->getRequest()->getSession();
			$session->getFlashBag()->add('returnMessage','Account section added');
			
			return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_accountsection_show'),301);
		}
		
		return $this->render('CoreAccountingBundle:Maintenance:accountsectionadd.html.twig', array(
				'accountsection'=> $accountsection,
				'form'        	=> $form->createView()
		));
	}
	
	public function editAccountsectionAction($section_id)
	{
		$em = $this->getDoctrine()
				   ->getManager();
		$accountsection = $this->getAccountsection($section_id);
		if (!$accountsection) {
			$accountsection = new Accountsection();
		}
        $form = $this->createForm(new AccountsectionType(), $accountsection);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
        	$form->bind($request);
        	$sectionid = $form["sectionid"]->getData();
        	$sectionname = $form["sectionname"]->getData();
        	if ($form->isValid()) {
        		$accountsection->setSectionid($sectionid);
        		$accountsection->setSectionname($sectionname);
        		$em->persist($accountsection);
        		$em->flush();
        		$returnMessage = "Account section $sectionname successfully updated.";
        	} else {
        		$returnMessage = "An error occurred during the processing of $sectionname.";
        	}
        	$session = $this->getRequest()->getSession();
        	$session->getFlashBag()->add('returnMessage',$returnMessage);
        	return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_accountsection_show'),301);
        } else {
	        return $this->render('CoreAccountingBundle:Maintenance:accountsectionedit.html.twig', array(
	        		'accountsection'	=> $accountsection,
	        		'section_id'		=> $section_id,
	        		'form'				=> $form->createView()
	        ));
        }
	}
	
	protected function getAccountsection($id=null)
	{
	$em = $this->getDoctrine()->getManager();
	if(isset($id)) {
		$accountsection = $em	->getRepository('CoreAccountingBundle:Accountsection')
								->findOneBysectionid($id);
	} else {
		$accountsection = $em	->getRepository('CoreAccountingBundle:Accountsection')
								->findAll();
	}
	if (!$accountsection) {
		throw $this->createNotFoundException('Unable to find Account section.');
	}
	return $accountsection;
	}
	
	public function deleteaccountsectionAction($section_id)
	{
		$em = $this->getDoctrine()
		->getManager();
		$accountsection = $this->getAccountsection($section_id);
		if (!$accountsection) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}
		$form = $this->createForm(new AccountsectionType(), $accountsection);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			$sectionid = $form["sectionid"]->getData();
			$confirm = $form["Confirm"]->getData();
			if ($form->isValid()) {
				$em->remove($accountsection);
				$em->flush();
				$returnMessage = "Account section $sectionid successfully removed.";
			} else {
				$returnMessage = "An error occurred during the removing of account section $sectionid.";
			}
			$request->getSession()->getFlashBag()->add('returnMessage',$returnMessage);
			return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_accountsection_show'),301);
		} else {
			return $this->render('CoreAccountingBundle:Maintenance:accountsectiondelete.html.twig', array(
					'accountsection'	=> $accountsection,
					'section_id'		=> $section_id,
					'form'				=> $form->createView()
			));
		}
	}
	
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
			$session->getFlashBag()->add('returnMessage','Account group added');
			
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
	        		'accountgroups'	=> $accountgroups,
	        		'group_id'		=> $group_id,
	        		'form'			=> $form->createView()
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
	
	/* Fiscal Periods - periods
	* 		show
	* 		add
	* 		edit
	* 		get
	* 		delete
	*/
	public function showperiodsAction($returnMessage=null)
	{
		$transactionData = $this->getPeriods();
		return $this->render('CoreAccountingBundle:Maintenance:periodsshow.html.twig', array(
				'title' => 'Fiscal Periods',
				'returnMessage' => $returnMessage,
				'periods' => $transactionData,
				'periodstart' => $transactionData[0],
				'periodend' => end($transactionData)
		));
	}
	
	public function updateperiodsAction($returnMessage=null)
	{
		// get max period
		$allperiods = $this->getPeriods();
		$lastperiod = $this->getPeriods(end($allperiods));
		
		// find next period no
		$newperiodno = $lastperiod->getPeriodno()+1;
		/// find current period end
		$date = new \DateTime($lastperiod->getLastdateinperiod()->format('Y-m-d'));
		$date->add(new \DateInterval('P10D'));
		$date->setDate($date->format('Y'),$date->format('m'),$date->format('t'));
		$newlastdateinmonth = $date->format('Y-m-t');
		// add new record
		$periods = new Periods();
		$periods->setPeriodno($newperiodno);
		$periods->setLastdateinperiod(new \DateTime($newlastdateinmonth));
		$em = $this	->getDoctrine()
					->getManager();
		$em->persist($periods);
		$em->flush();
		
		$session = $this->getRequest()->getSession();
		$session->getFlashBag()->add('returnMessage','Fiscal Period added');
		
		return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_periods_show'),301);
	}
	
	protected function getPeriods($id=null)
	{
		$em = $this->getDoctrine()->getManager();
		if(isset($id)) {
			$periods = $em	->getRepository('CoreAccountingBundle:Periods')
							->findOneByperiodno($id);
		} else {
			$periods = $em	->getRepository('CoreAccountingBundle:Periods')
							->findAll();
		}
		if (!$periods) {
			throw $this->createNotFoundException('Unable to find Fiscal Period.');
		}
		return $periods;
	}
	
	protected function getTodaysPeriod()
	{
		$em = $this->getDoctrine()->getManager();
		$today = new \DateTime('today',new \DateTimeZone('America/Chicago'));
		$periods = $em	->getRepository('CoreAccountingBundle:Periods')
						->findperiodnowithlastdateinperiod($today);
		if (!$periods) {
			throw $this->createNotFoundException('Unable to find Fiscal Period.');
		}
		return $periods;
	}
	
	protected function getThisYearsJanPeriod()
	{
		$em = $this->getDoctrine()->getManager();
		$today = new \DateTime('today',new \DateTimeZone('America/Chicago'));
		$today->setDate($today->format('Y'),1,1);
		$periods = $em	->getRepository('CoreAccountingBundle:Periods')
		->findperiodnowithlastdateinperiod($today);
		if (!$periods) {
			throw $this->createNotFoundException('Unable to find Fiscal Period.');
		}
		return $periods;
	}
	
	
	
	/* Transaction Tags - tags
	 * 		show
	* 		add
	* 		edit
	* 		get
	* 		delete
	*/
	public function showtagsAction($returnMessage=null)
	{
		$transactionData = $this->getTags();
		return $this->render('CoreAccountingBundle:Maintenance:tagsshow.html.twig', array(
				'title' => 'Transaction Tags',
				'returnMessage' => $returnMessage,
				'tags' => $transactionData
		));
	}

	public function addtagsAction(Request $request)
	{
		$tags = new Tags();
		$form = $this->createForm(new TagsType(), $tags);
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$em = $this	->getDoctrine()
						->getManager();
			$em->persist($tags);
			$em->flush();
			
			$session = $this->getRequest()->getSession();
			$session->getFlashBag()->add('returnMessage','Transaction tag added');
			
			return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_tags_show'),301);
		}
		
		return $this->render('CoreAccountingBundle:Maintenance:tagsadd.html.twig', array(
				'tags' 	=> $tags,
				'form'  => $form->createView()
		));
	}
	
	public function edittagsAction($tagref)
	{
		$em = $this->getDoctrine()
				   ->getManager();
		$tags = $this->getTags($tagref);
		if (!$tags) {
			$tags = new Tags();
		}
        $form = $this->createForm(new TagsType(), $tags);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
        	$form->bind($request);
        	$tagref = $form["tagref"]->getData();
        	$tagdescription = $form["tagdescription"]->getData();
        	if ($form->isValid()) {
        		$tags->setTagdescription($tagdescription);
        		$em->persist($tags);
        		$em->flush();
        		$returnMessage = "Transaction tag $tagdescription successfully updated.";
        	} else {
        		$returnMessage = "An error occurred during the processing of $tagdescription.";
        	}
        	$session = $this->getRequest()->getSession();
        	$session->getFlashBag()->add('returnMessage',$returnMessage);
        	return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_tags_show'),301);
        } else {
	        return $this->render('CoreAccountingBundle:Maintenance:tagsedit.html.twig', array(
	        		'tags' => $tags,
	        		'accountcode_id'  => $tagref,
	        		'form'        => $form->createView()
	        ));
        }
	}
	
	
	protected function getTags($id=null)
	{
		$em = $this->getDoctrine()->getManager();
		if(isset($id)) {
			$periods = $em	->getRepository('CoreAccountingBundle:Tags')
			->findOneBytagref($id);
		} else {
			$periods = $em	->getRepository('CoreAccountingBundle:Tags')
			->findAll();
		}
		if (!$periods) {
			throw $this->createNotFoundException('Unable to find Fiscal Period.');
		}
		return $periods;
	}
	
	/* Import Transaction Definitions (itd) - importtransdefn
	 * 		show
	* 		add
	* 		edit
	* 		get
	* 		delete
	*/
	public function showimporttransdefnAction($returnMessage=null)
	{
		$transactionData = $this->getImporttransdefn();
		return $this->render('CoreAccountingBundle:Maintenance:importtransdefnshow.html.twig', array(
				'title' => 'Transaction Tags',
				'returnMessage' => $returnMessage,
				'importtransdefn' => $transactionData
		));
	}

	public function addimporttransdefnAction(Request $request)
	{
		$importtransdefn = new Importtransdefn();
		$form = $this->createForm(new ImporttransdefnType(), $importtransdefn);
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$em = $this	->getDoctrine()
						->getManager();
			$em->persist($importtransdefn);
			$em->flush();
			
			$session = $this->getRequest()->getSession();
			$session->getFlashBag()->add('returnMessage','Import definition added');
			
			return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_importtransdefn_show'),301);
		}
		
		return $this->render('CoreAccountingBundle:Maintenance:importtransdefnadd.html.twig', array(
				'importtransdefn' 	=> $importtransdefn,
				'form'  			=> $form->createView()
		));
	}
	
	public function editimporttransdefnAction($importdefnid)
	{
		$em = $this->getDoctrine()
				   ->getManager();
		$importtransdefn = $this->getImporttransdefn($importdefnid);
		if (!$importtransdefn) {
			$importtransdefn = new getImporttransdefn();
		}
        $form = $this->createForm(new ImporttransdefnType(), $importtransdefn);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
        	$form->bind($request);
        	$importdefnid = $form["importdefnid"]->getData();
        	$accountname = $form["accountname"]->getData();
        	$dataheaderdefn = $form["dataheader_defn"]->getData();
        	$datalineaccount = $form["dataline_account"]->getData();
        	$datalinenarrative = $form["dataline_narrative"]->getData();
        	$datalineamount = $form["dataline_amount"]->getData();
        	$datalinedate = $form["dataline_date"]->getData();
        	$datalinetag = $form["dataline_tag"]->getData();
        	if ($form->isValid()) {
        		$importtransdefn->setAccountname($accountname);
        		$importtransdefn->setDataheaderdefn($dataheaderdefn);
        		$importtransdefn->setDatalineaccount($datalineaccount);
        		$importtransdefn->setDatalinenarrative($datalinenarrative);
        		$importtransdefn->setDatalineamount($datalineamount);
        		$importtransdefn->setDatalinedate($datalinedate);
        		$importtransdefn->setDatalinetag($datalinetag);
        		$em->persist($importtransdefn);
        		$em->flush();
        		$returnMessage = "Transaction import definition for account $accountname successfully updated.";
        	} else {
        		$returnMessage = "An error occurred during the processing of account $accountname.";
        	}
        	$session = $this->getRequest()->getSession();
        	$session->getFlashBag()->add('returnMessage',$returnMessage);
        	return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_importtransdefn_show'),301);
        } else {
	        return $this->render('CoreAccountingBundle:Maintenance:importtransdefnedit.html.twig', array(
	        		'importtransdefn' 	=> $importtransdefn,
	        		'importdefnid'  	=> $importdefnid,
	        		'form'        		=> $form->createView()
	        ));
        }
	}
	
	protected function getImporttransdefn($id=null)
	{
		$em = $this->getDoctrine()->getManager();
		if(isset($id)) {
			$importtransdefn = $em	->getRepository('CoreAccountingBundle:Importtransdefn')
			->findOneByimportdefnid($id);
		} else {
			$importtransdefn = $em	->getRepository('CoreAccountingBundle:Importtransdefn')
			->findAll();
		}
		if (!$importtransdefn) {
			throw $this->createNotFoundException('Unable to find Transaction Definition.');
		}
		return $importtransdefn;
	}
	
	public function deleteimporttransdefnAction($importdefnid)
	{
		$em = $this->getDoctrine()
		->getManager();
		$importtransdefn = $this->getImporttransdefn($importdefnid);
		if (!$importtransdefn) {
			throw $this->createNotFoundException('Unable to find this entity.');
		}
		$form = $this->createForm(new ImporttransdefnType(), $importtransdefn);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
        	$importdefnid = $form["accountname"]->getData();
        	$accountname = $form["accountname"]->getData();
        	$dataheaderdefn = $form["dataheader_defn"]->getData();
        	$datalineaccount = $form["dataline_account"]->getData();
        	$datalinenarrative = $form["dataline_narrative"]->getData();
        	$datalineamount = $form["dataline_amount"]->getData();
        	$datalinedate = $form["dataline_date"]->getData();
        	$datalinetag = $form["dataline_tag"]->getData();
			if ($form->isValid()) {
				$em->remove($importtransdefn);
				$em->flush();
				$returnMessage = "Definition for $accountname successfully removed.";
			} else {
				$returnMessage = "An error occurred during the removing of $accountname definition.";
			}
			$request->getSession()->getFlashBag()->add('returnMessage',$returnMessage);
			return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_importtransdefn_show'),301);
		} else {
			return $this->render('CoreAccountingBundle:Maintenance:importtransdefndelete.html.twig', array(
	        		'importtransdefn' 	=> $importtransdefn,
	        		'importdefnid'  	=> $importdefnid,
	        		'form'        		=> $form->createView()
			));
		}
	}
	
	/* Budget - chartdetails
	 * 		show
	* 		add
	* 		edit
	* 		get
	* 		delete
	*/
	public function showbudgetAction($returnMessage=null)
	{
		$transactionData = $this->getBudget('allbudgets');
		return $this->render('CoreAccountingBundle:Maintenance:budgetshow.html.twig', array(
				'title' => 'Budget',
				'returnMessage' => $returnMessage,
				'budgets' => $transactionData
		));
	}
	
	public function showdetailedbudgetAction($account_id)
	{
		$transactionData = $this->getBudget('budgetactualpriorcurrentnextbyaccount',$account_id);
		
		
		
		return $this->render('CoreAccountingBundle:Maintenance:budgetshow.html.twig', array(
				'title' => 'Budget',
				'returnMessage' => $returnMessage,
				'prioryear' => array_slice($transactionData,0,12),
				'curryear' => array_slice($transactionData,12,12),
				'nextyear' => array_slice($transactionData,0,12)
		));
	}
	
	
	public function editbudgetAction($account_id)
	{
		$em = $this	->getDoctrine()
					->getManager();
		$transactionData = $this->getBudget('budgetactualpriorcurrentnextbyaccount',$account_id);
		
		var_dump(array_slice($transactionData,12,12));
		echo "</br></br>";
		die(var_dump(array_slice($transactionData,23,12)));
		
		
		
		
		
		$form = $this->createForm(new ImporttransdefnType(), $importtransdefn);
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			$importdefnid = $form["importdefnid"]->getData();
			
			
			if ($form->isValid()) {
				$importtransdefn->setAccountname($accountname);
				
				
				$em->persist($importtransdefn);
				$em->flush();
				$returnMessage = "Transaction import definition for account $accountname successfully updated.";
			} else {
				$returnMessage = "An error occurred during the processing of account $accountname.";
			}
			$session = $this->getRequest()->getSession();
			$session->getFlashBag()->add('returnMessage',$returnMessage);
			return $this->redirect($this->generateUrl('CoreAccountingBundle_maintenance_importtransdefn_show'),301);
		} 
		
		
		
		
		else {
			return $this->render('CoreAccountingBundle:Maintenance:budgetedit.html.twig', array(
					'importtransdefn' 	=> $importtransdefn,
					'importdefnid'  	=> $importdefnid,
					'form'        		=> $form->createView()
			));
		}
	}
	
	
	
	
	
	
	
	
	
	
	protected function getBudget($type,$id=null)
	{
		$em = $this->getDoctrine()->getManager();
		switch ($type) {
			case "allbudgets":
				$budget = $em	->getRepository('CoreAccountingBundle:Chartdetails')
								->findAllBudgets();
				break;
			case "budgetbyid":
				if(isset($id)) {
					$budget = $em	->getRepository('CoreAccountingBundle:Chartdetails')
									->findBudgetbyid($id);
				}
				break;
			case "budgetbyperiod":
				//something
				break;
			case "budgetactualpriorcurrentnextbyaccount":
					$period = $this->getThisYearsJanPeriod();
					$budget = $em	->getRepository('CoreAccountingBundle:Chartdetails')
									->findBudgetactualpriorcurrentnextbyaccount($id,$period[0]['periodno']-12,$period[0]['periodno']+23);
				break;
			default:
				$budget = 0;
				break;
		}
		if (!$budget) {
			throw $this->createNotFoundException('Unable to find Transaction Definition.');
		}
		return $budget;
	}
}