<?php

namespace Clastic\ContactFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactFormDataType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                $builder->create('tabs', 'tabs', array('inherit_data' => true))
                    ->add($this->createGeneralTab($builder))
            );
    }

    /**
     * @param FormBuilderInterface $builder
     * @param string               $name
     * @param array                $options
     *
     * @return FormBuilderInterface
     */
    private function createTab(FormBuilderInterface $builder, $name, $options = array())
    {
        $options = array_replace(
            $options,
            array(
                'inherit_data' => true,
            ));

        return $builder->create($name, 'tabs_tab', $options);
    }

    /**
     * @param FormBuilderInterface $builder
     *
     * @return FormBuilderInterface
     */
    private function createGeneralTab(FormBuilderInterface $builder)
    {
        return $this->createTab($builder, 'general', array('label' => 'General'))
            ->add('name', 'text', array(
                'label' => 'Name',
                'required' => true,
            ))
            ->add('companyName', 'text', array(
                'label' => 'Name',
                'required' => false,
            ))
            ->add('mail', 'text', array(
                'label' => 'E-Mail',
                'required' => true,
            ))
            ->add('title', 'text', array(
                'label' => 'Subject',
                'required' => false,
            ))
            ->add('state', 'choice', array(
                'label' => 'State',
                'choices'  =>
                    array(
                        '0' => 'New',
                        '1' => 'Being handled',
                        '3' => 'Finished',
                    ),
                'required' => true,
            ))
            ->add('type','entity',array(
                'label' => 'Contact Form Type',
                'class' => 'Clastic\ContactFormBundle\Entity\ContactFormType',
                'property' => 'name',
                'required' => true,
            ))
            ->add('message', 'wysiwyg', array(
                'required' => true,
            ))
            ->add('social',
                'collection',
                array(
                    'type'=>'text',
                    'prototype'=>true,
                    'allow_add'=>true,
                    'allow_delete'=>true,
                    'required' => false,
                    'label' => 'Social url\'s',
                    'options'=>array(
                    )
                )
            )
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Clastic\ContactFormBundle\Entity\ContactFormData'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'clastic_contactformbundle_contactformdata';
    }
}
