<?php

namespace Core\AccountingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccountgroupsType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('groupname','text')
            ->add('sectioninaccounts','entity',array(
            		'class' => 'CoreAccountingBundle:Accountsection',
            		'property' => 'sectionid'
            ))
            ->add('pandl','text')
            ->add('sequenceintb','text')
            ->add('parentgroupname','entity',array(
            		'class' => 'CoreAccountingBundle:Accountgroups',
            		'property' => 'groupname',
            	//	'empty_value' => ''
        			'required' => false
            ))
            ->add('Confirm','submit');
    }
      
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\AccountingBundle\Entity\Accountgroups'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'core_accountingbundle_accountsection';
    }
}
