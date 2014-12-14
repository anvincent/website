<?php

namespace Core\AccountingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChartmasterType extends AbstractType
{
	protected $foo;
	
	public function __construct($foo=null)
	{
		$this->foo = $foo;
	}
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accountcode','integer')
            ->add('accountname','text')
     //       ->add('group_','entity',array(
     //       		'class' => 'CoreAccountingBundle:Accountgroups',
     //       		'property' => 'groupname',
     //       		'data' => $this->foo,
     //       		'empty_value' => 'Choose an option'))
        	->add('group_','entity',array(
        			'property' => $this->buildgroupnames()))
            ->add('Confirm','submit');
    }
    
    protected function buildgroupnames()
    {
    	$choices = array();
    	$em = $this->getDoctrine()->getManager();
    		
    	$accountgroups = $em->getRepository('CoreAccountingBundle:Accountgroups')
    		->findAll();
    	
    	$choices[$this-foo] = $this-foo;
    	foreach($accountgroups as $group) {
    		$choices[$group->getGroupname()] = $group->getGroupname();
    	}
    	return $choices;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\AccountingBundle\Entity\Chartmaster'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'core_accountingbundle_chartmaster';
    }
}
