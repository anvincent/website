<?php

namespace Core\AccountingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ImporttransdefnType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('importdefnid','integer')
            ->add('accountname','text')
            ->add('dataheader_defn','textarea')
            ->add('dataline_account','integer')
            ->add('dataline_narrative','integer')
            ->add('dataline_amount','integer')
            ->add('dataline_date','integer')
            ->add('dataline_tag','integer')
            ->add('Confirm','submit');
    }
      
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\AccountingBundle\Entity\Importtransdefn'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'core_accountingbundle_importtransdefn';
    }
}
