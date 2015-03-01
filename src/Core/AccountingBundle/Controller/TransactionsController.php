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
		if ($typeno == 0) {
			// new transaction typeno, get typeno
			$nexttypeno = $em	->getRepository('CoreAccountingBundle:Gltrans')
								->findnexttypeno();
			return $this->redirect($this->generateUrl('CoreAccountingBundle_transactions_gltrans_edit',
					array('typeno' => $nexttypeno)),301);
		} else {
			$newentry = new Journal();
			
		}
	}
	 
}