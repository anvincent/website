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
            		'query_builder' => function(EntityRepository $repository) {
            			$today = new \DateTime('today',new \DateTimeZone('America/Chicago'));
            			return $repository->findperiodnowithlastdateinperiod($today);
        				}
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
}
