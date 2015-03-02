<?php

namespace Core\AccountingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class JournalsType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
	      	->add('typeno','integer')
            ->add('trandate', 'text', array('data' => date('Y-m-d')))
            ->add('periodno','entity',array(
            		'class' => 'CoreAccountingBundle:Periods',
            		'property' => 'periodno',
            		'data' => $this->getgetTodaysPeriod()
            		))
            ->add('tag','entity',array(
            		'class' => 'CoreAccountingBundle:Tags',
            		'property' => 'tagdescription',
            		'data' => ''
            		))
        	->add('journalentries','collection',array(
        		'type' => new GltransType(),
        		'allow_add' => true
        		))
            ->add('Confirm','submit');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\AccountingBundle\Entity\Journal'
        ));
    }

    
    /**
     * @return string
     */
    public function getName()
    {
        return 'core_accountingbundle_journals';
    }
    
    protected function getgetTodaysPeriod()
    {
    	$em = Symfony\Bundle\FrameworkBundle\Controller\Controller\getDoctrine()->getManager();
		$today = new \DateTime('today',new \DateTimeZone('America/Chicago'));
		$periods = $em	->getRepository('CoreAccountingBundle:Periods')
						->findperiodnowithlastdateinperiod($today);
		if (!$periods) {
			throw $this->createNotFoundException('Unable to find Fiscal Period.');
		}
		return $periods;
    }
}
