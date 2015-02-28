<?php

namespace Core\AccountingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChartdetailsType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder/*
            ->add('accountcode','entity',array(
            		'class' => 'CoreAccountingBundle:Chartmaster',
            		'property' => 'accountcode'
            		))*/
            ->add('period','entity',array(
            		'class' => 'CoreAccountingBundle:Periods',
            		'property' => 'periodno'
            		))
            		
//			->add('accountcode','integer')
//			->add('period','integer')
			->add('budget')
			->add('actual');
//			->add('bfwd','float')
//			->add('bfwdbudget','float')
//			->add('Confirm','submit');
    }
      
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\AccountingBundle\Entity\Chartdetails'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'core_accountingbundle_chartdetails';
    }
}
