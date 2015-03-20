<?php
// src/Core/AccountingBundle/Controller/PageController.php

namespace Core\AccountingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

// add entities
use Core\AccountingBundle\Entity\Gltrans;
use Core\AccountingBundle\Entity\Journal;

// add forms
use Core\AccountingBundle\Form\GltransType;
use Core\AccountingBundle\Form\JournalsType;


class TransactionsController extends Controller
{
	/* Main */
	public function indexAction()
	{
		return $this->render('CoreAccountingBundle:Transactions:index.html.twig');
	}	
	
	/* Manual Journal Entries - gltrans 
	 * 		add
	 * 		get
	 * 		delete
	 */
	public function addManualTransactionAction($typeno)
	{
		$em = $this	->getDoctrine()
					->getManager();
		if ($typeno == 0) {
			// new transaction typeno, get typeno
			$nexttypeno 		= $em	->getRepository('CoreAccountingBundle:Gltrans')
										->findnexttypeno();
			return $this->redirect($this->generateUrl('CoreAccountingBundle_transactions_gltrans_add',
					array('typeno' => $nexttypeno)),301);
		} else {
			$nextcounterindex = $em	->getRepository('CoreAccountingBundle:Gltrans')
									->findnextcounterindex();
			$newentry = new Journal();
			$newentry->setTypeno($typeno);
			$newentry->setTrandate(date('Y-m-d'));
			$newentry->setPeriodno($this->getThePeriod());
			$form = $this->createForm(new JournalsType(), $newentry);
			$request = $this->getRequest();
			if ($request->getMethod() == 'POST') {
				$form->bind($request);
				$formData = $form->getData();
				
				$typeno = $newentry->getTypeno();
				$date = $formData->getTrandate();
				$trandate = new \DateTime($date);
				$periodno = $formData->getPeriodno();
				$tag = $formData->getTag()->getTagref();
				
				if ($form->isValid()) {
					foreach ($formData->getJournalentries() as $entryItem) {
						$journalentry = new Gltrans();
						
						$journalentry->setCounterindex($nextcounterindex);
						$journalentry->setType(0);
						$journalentry->setTypeno($typeno);
						$journalentry->setChequeno(0);
						$journalentry->setTrandate($trandate);
						$journalentry->setPeriodno($periodno);
						$account = $entryItem->getAccount();
						$journalentry->setAccount($account);
						$narrative = $entryItem->getNarrative();
						$journalentry->setNarrative($narrative);
						$amount = $entryItem->getAmount();
						$journalentry->setAmount($amount);
						$journalentry->setPosted(0);
						$journalentry->setJobref('_');
						$journalentry->setTag($tag);
		        		$em->persist($journalentry);
		        								
		        		$nextcounterindex++;
					}
					$em->flush();
					$returnMessage = "Journal entry $typeno successfully updated.";
				} else {
					$returnMessage = "An error occurred during the processing of entry $typeno.";
				}
	        	$session = $this->getRequest()->getSession();
	        	$session->getFlashBag()->add('returnMessage',$returnMessage);
	        	return $this->redirect($this->generateUrl('CoreAccountingBundle_transactions_gltrans_add'),301);
			} else {
				return $this->render('CoreAccountingBundle:Transactions:gltransadd.html.twig', array(
						'form'        		=> $form->createView(),
						'counterindex' 		=> $nextcounterindex
				));
			}
		}
	}
	
	/* Adjust Journal Entries - gltrans
	* 		
	*/
	public function searchManualTransactionAction()
	{
		$data = array();
		$form = $this	->createFormBuilder($data)
						->add('typeno','integer')
						->add('Confirm','submit')
						->getForm();
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			$typeno = $form['typeno']->getData();
			return $this->redirect($this->generateUrl('CoreAccountingBundle_transactions_gltrans_edit',
					array('typeno' => $typeno)),301);
		} else {
			return $this->render('CoreAccountingBundle:Transactions:gltranssearch.html.twig', array(
							'form' 		=> $form->createView()
			));
		}
	}
	
	public function editManualTransactionAction($typeno)
	{
		$em = $this	->getDoctrine()
					->getManager();
		$journalentry = $this->getJournalentry($typeno,'typeno');
		$typeno = $journalentry[1]->getTypeno();
		$trandate = $journalentry[1]->getTrandate();
		$periodno = $journalentry[1]->getPeriodno();
		$tag = $journalentry[1]->getTag();
		
		$updateentry = new Journal();
		$updateentry->setTypeno($typeno);
		$updateentry->setTrandate($trandate->format('Y-m-d'));
		$updateentry->setPeriodno($periodno);
		$updateentry->setTag($tag);
		$updateentry->setJournalentries($journalentry);
		
		$form = $this->createForm(new JournalsType(), $updateentry);
		
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			$formData = $form->getData();
			
			$typeno 	= $formData->getTypeno();
			$date 		= $formData->getTrandate();
			$trandate 	= new \DateTime($date);
			$periodno 	= $formData->getPeriodno();
			$tag 		= $formData->getTag()->getTagref();
			
			if ($form->isValid()) {
				foreach ($formData->getJournalentries() as $entryItem) {
					$account = $entryItem->getAccount();
					$narrative = $entryItem->getNarrative();
					$amount = $entryItem->getAmount();
					
					if($entryItem->getCounterindex() != NULL) {
						$currentCounterindex = $entryItem->getCounterindex();
						$journalentryupdatearray = $this->getJournalentry($currentCounterindex,'counterindex');
						$journalentryupdate = $journalentryupdatearray[0];
						$journalentryupdate->setCounterindex($currentCounterindex);
					} else {
						$journalentryupdate = new Gltrans();
					}
					
					$journalentryupdate->setType(0);
					$journalentryupdate->setTypeno($typeno);
					$journalentryupdate->setChequeno(0);
					$journalentryupdate->setTrandate($trandate);
					$journalentryupdate->setPeriodno($periodno);
					$journalentryupdate->setAccount($account);
					$journalentryupdate->setNarrative($narrative);
					$journalentryupdate->setAmount($amount);
					$journalentryupdate->setPosted(0);
					$journalentryupdate->setJobref('_');
					$journalentryupdate->setTag($tag);
					
					$em->persist($journalentryupdate);
				}
				$em->flush();
				$returnMessage = "Journal entry $typeno successfully updated.";
			} else {
				$returnMessage = "An error occurred during the processing of entry $typeno.";
        	}
        	$session = $this->getRequest()->getSession();
        	$session->getFlashBag()->add('returnMessage',$returnMessage);
        	return $this->redirect($this->generateUrl('CoreAccountingBundle_transactions_gltrans_search'),301);
		} else {
			return $this->render('CoreAccountingBundle:Transactions:gltransedit.html.twig', array(
							'form' 		=> $form->createView()
			));
		}
	}
	
	public function getJournalentry($id,$type) 
	{
		$em = $this->getDoctrine()->getManager();
		switch($type)
		{
			case 'typeno':
				$result = $em	->getRepository('CoreAccountingBundle:Gltrans')
								->findBytypeno($id);
				break;
			case 'counterindex':
				$result = $em	->getRepository('CoreAccountingBundle:Gltrans')
								->findBycounterindex($id);
				break;
		}
		return $result;
	}
	
	protected function getThePeriod($date=null)
	{
		$em = $this->getDoctrine()->getManager();
		if(isset($date)) {
			$today = new \DateTime($date,new \DateTimeZone('America/Chicago'));
		} else {
			$today = new \DateTime('today',new \DateTimeZone('America/Chicago'));
		}
		$periods = $em	->getRepository('CoreAccountingBundle:Periods')
						->findperiodnowithdate($today);
		if (!$periods) {
			throw $this->createNotFoundException('Unable to find Fiscal Period.');
		}
		return $periods;
	}
	
	protected function getTheLastDate($period)
	{
		$em = $this->getDoctrine()->getManager();
		$lastdate = $em	->getRepository('CoreAccountingBundle:Periods')
						->findlastdatewithperiodno($period);
		if (!$lastdate) {
			throw $this->createNotFoundException('Unable to find Fiscal Period.');
		}
		return $lastdate;
	}
	
	protected function getBatchPeriods($type)
	{
		$em = $this->getDoctrine()->getManager();
		switch ($type)
		{
			case 'start':
				$id = 1;
				break;
				
			case 'end':
				$id = 9;
				break;
		}
		$period = $em	->getRepository('CoreAccountingBundle:Gltrans')
						->findperiodsbytagnotstarted($id);
		if (!$period) {
			throw $this->createNotFoundException('Unable to find Fiscal Period.');
		}
		$start = $period[0]['period']-2;
		$end = $period[0]['period']+3;
		$periods = array();
		for ($start; $start <= $end; $start++) {
			$periods[] = array($start,getTheLastDate($start));
		}
		return $periods;
	}
	
	/* Adjust Journal Entries - gltrans
	 *
	*/
	public function showBatchTransactionAction($stage='start')
	{
		$periodrange = $this->getBatchPeriods($stage);
		\Doctrine\Common\Util\Debug::dump($periodrange);die();
		return $this->render('CoreAccountingBundle:Transactions:batchmenushow.html.twig', array(
				'periodstart' => $periodrange[0],
				'periodend' => end($periodrange)
		));
	}
	
	public function oldshowBatchTransactionAction()
	{
		$session = $this->getRequest()->getSession();
		$session->set('step', '1');
			echo"</br>showBatchTransactionAction - outside post";print_r($session->get('step'));echo"</br>";
		$data = array();
		$form = $this	->createFormBuilder($data)
						->add('dateperiod','text')
						->add('Confirm','submit')
						->getForm();
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
				echo"</br>showbatchtransactionaction - inside post";print_r($session->get('step'));echo"</br>";
			$form->bind($request);
			// get period from date
			$date = $form->getData();
			$periodno = $this->getThePeriod($date['dateperiod']);
			
			// get the budget for certain accounts for the period
			$journalentryupdate = $this->getMonthStartJournal($periodno[0]['periodno']);
			
			return $this->forward('CoreAccountingBundle:Transactions:editBatchTransaction',
					array(	'edit' => $journalentryupdate,
							'step' => $session->get('step')
			));
		} else {
			return $this->render('CoreAccountingBundle:Transactions:batchmenushow.html.twig', array(
				'form'        => $form->createView()
			));
		}
	}
	
	protected function getMonthStartJournal($period)
	{
		$em = $this->getDoctrine()->getManager();
		$accounts 			= $em	->getRepository('CoreAccountingBundle:Chartmaster')
									->findAll();
		$nexttypeno 		= $em	->getRepository('CoreAccountingBundle:Gltrans')
									->findnexttypeno();
		$nextcounterindex 	= $em	->getRepository('CoreAccountingBundle:Gltrans')
									->findnextcounterindex();
		$transactiondate 	= $em	->getRepository('CoreAccountingBundle:Periods')
									->findfirstdatewithperiodno($period);
		
		$newentry = new Journal();
		$newentry->setTypeno($nexttypeno);
		$newentry->setTrandate($transactiondate);
		$newentry->setPeriodno($period);
		$newentry->setTag(1);
		
		foreach ($accounts as $key => $account) {
			$journalentry = new Gltrans();
			if(is_numeric(substr($account->getAccountname(),-6))) {
				$id = substr($account->getAccountname(),-6);
				$accountchartdetails = $em	->getRepository('CoreAccountingBundle:Chartdetails')
											->findBudgetbyaccountandperiod($id,$period);
				
				$budget = $accountchartdetails->getBudget();
				$account = $account->getAccountcode();
				
				$journalentry->setCounterindex($nextcounterindex);
				$journalentry->setType(0);
				$journalentry->setChequeno(0);
				$journalentry->setAccount($account);
				$journalentry->setNarrative("Month Start");
				$journalentry->setAmount($budget);
				$journalentry->setPosted(0);
				$journalentry->setJobref('_');
				
				$newentry->addJournalentries($journalentry);
				$nextcounterindex++;
			}
		}
		
		return $newentry;
	}
	
	public function editBatchTransactionAction($edit)
	{
		$session = $this->getRequest()->getSession();
			echo"</br>editBatchTransactionAction - outside post";print_r($session->get('step'));echo"</br>";
		$em = $this	->getDoctrine()
					->getManager();
		$form = $this->createForm(new JournalsType(), $edit);
		$request = $this->getRequest();
		$step = $session->get('step');
		if ($request->getMethod() == 'POST' && $step == '2') {
				echo"</br>editBatchTransactionAction - outside post";print_r($session->get('step'));echo"</br>";
			$form->bind($request);
			$formData = $form->getData();
			
			$typeno 	= $formData->getTypeno();
			$date 		= $formData->getTrandate();
			$trandate 	= new \DateTime($date);
			$periodno 	= $formData->getPeriodno();
			$tag 		= $formData->getTag()->getTagref();
			
			if ($form->isValid()) {
				foreach ($formData->getJournalentries() as $entryItem) {
					$account = $entryItem->getAccount();
					$narrative = $entryItem->getNarrative();
					$amount = $entryItem->getAmount();
					
					if($entryItem->getCounterindex() != NULL) {
						$currentCounterindex = $entryItem->getCounterindex();
						$journalentryupdatearray = $this->getJournalentry($currentCounterindex,'counterindex');
						$journalentryupdate = $journalentryupdatearray[0];
						$journalentryupdate->setCounterindex($currentCounterindex);
					} else {
						$journalentryupdate = new Gltrans();
					}
					
					$journalentryupdate->setType(0);
					$journalentryupdate->setTypeno($typeno);
					$journalentryupdate->setChequeno(0);
					$journalentryupdate->setTrandate($trandate);
					$journalentryupdate->setPeriodno($periodno);
					$journalentryupdate->setAccount($account);
					$journalentryupdate->setNarrative($narrative);
					$journalentryupdate->setAmount($amount);
					$journalentryupdate->setPosted(0);
					$journalentryupdate->setJobref('_');
					$journalentryupdate->setTag($tag);
					
					$em->persist($journalentryupdate);
				}
				$em->flush();
				$returnMessage = "Journal entry $typeno successfully updated.";
			} else {
				$returnMessage = "An error occurred during the processing of entry $typeno.";
        	}
        	
        	$session->getFlashBag()->add('returnMessage',$returnMessage);
        	return $this->redirect($this->generateUrl('CoreAccountingBundle_transactions_gltrans_search'),301);
		} else {
			$session->set('step', '2');
				echo"</br>editBatchTransactionAction - outside post - after else ";print_r($session->get('step'));echo"</br>";
			return $this->render('CoreAccountingBundle:Transactions:gltransedit.html.twig', array(
							'form' 		=> $form->createView()
			));
		}
	}
}