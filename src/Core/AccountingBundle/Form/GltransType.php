<?php

namespace Core\AccountingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class GltransType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('counterindex')
            ->add('type')
            ->add('typeno')
            ->add('chequeno')
            ->add('trandate')
            ->add('periodno','entity',array(
            		'class' => 'CoreAccountingBundle:Periods',
            		'property' => 'periodno'
            		))
            ->add('accountcode','entity',array(
            		'class' => 'CoreAccountingBundle:Chartmaster',
            		'property' => 'accountcode'
            		))
            ->add('narrative')
            ->add('amount')
            ->add('posted')
            ->add('jobref')
            ->add('tag');
    }
      
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\AccountingBundle\Entity\Gltrans'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'core_accountingbundle_gltrans';
    }
}
