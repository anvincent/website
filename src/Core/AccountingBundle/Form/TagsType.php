<?php

namespace Core\AccountingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class TagsType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tagref','int')
            ->add('tagdescription','text')
            ->add('Confirm','submit');
    }
      
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\AccountingBundle\Entity\Tags'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'core_accountingbundle_tags';
    }
}
