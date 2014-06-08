<?php
// src/Core/BlogBundle/Controller/PageController.php

namespace Core\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Import new namespaces
use Core\BlogBundle\Entity\Enquiry;
use Core\BlogBundle\Form\EnquiryType;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreBlogBundle:Page:index.html.twig');
    }
    
    public function aboutAction()
    {
    	return $this->render('CoreBlogBundle:Page:about.html.twig');
    }
    
    public function contactAction()
    {
    	$enquiry = new Enquiry();
	    $form = $this->createForm(new EnquiryType(), $enquiry);
	
	    $request = $this->getRequest();
	    if ($request->getMethod() == 'POST') {
	        $form->bindRequest($request);
	
	        if ($form->isValid()) {
	        	$message = \Swift_Message::newInstance()
	        	->setSubject('Contact enquiry from kaisernet')
	        	->setFrom('gkenterprises@live.com')
	        	->setTo($this->container->getParameter('core_blog.emails.contact_email'))
	        	->setBody($this->renderView('CoreBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
	        	$this->get('mailer')->send($message);
	        	
	        	$this->get('session')->getFlashBag()->add('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
	        	
	        	//$this->get('session')->setFlash('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
	        	
	        	// Redirect - This is important to prevent users re-posting
	        	// the form if they refresh the page
	        	return $this->redirect($this->generateUrl('CoreBlogBundle_contact'));
	        }
	    }
	
	    return $this->render('CoreBlogBundle:Page:contact.html.twig', array(
	        'form' => $form->createView()
	    ));
    }
}