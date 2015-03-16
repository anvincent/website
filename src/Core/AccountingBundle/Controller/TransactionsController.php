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
			$newentry->setPeriodno($this->getTodaysPeriod());
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
	
	public function searchManualTransactionAction()
	{
		
	}
	
	public function editManualTransactionAction($typeno)
	{
		$data = array();
		$form = $this	->createFormBuilder($data)
						->add('typeno','integer')
						->add('Confirm','submit')
						->getForm();
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
			// process form
			$typeno = $form['typeno']->getData();
			$journalentry = $this->getJournalentry($typeno);
			\Doctrine\Common\Util\Debug::dump($journalentry);die();
			if ($form->isValid()) {
				
				$returnMessage = "Account group $groupname successfully updated.";
			} else {
        		$returnMessage = "An error occurred during the processing of $groupname.";
        	}
        	$session = $this->getRequest()->getSession();
        	$session->getFlashBag()->add('returnMessage',$returnMessage);
        	return $this->redirect($this->generateUrl('CoreAccountingBundle_transactions_gltrans_search'),301);
		} else {
			return $this->render('CoreAccountingBundle:Transactions:gltranssearch.html.twig', array(
							'form' 		=> $form->createView()
			));
		}
	}
	
	public function getJournalentry($id) 
	{
		$em = $this->getDoctrine()->getManager();
		$typeno = $em	->getRepository('CoreAccountingBundle:Gltrans')
						->findBytypeno($id);
		return $typeno;
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
	 
}