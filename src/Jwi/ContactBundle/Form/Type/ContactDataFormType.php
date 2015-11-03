<?php
/**
 * This file is part of the Clastic package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jwi\ContactBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * ContactDataType
 *
 * @author Jonas Windmolders <jonas_windmolders@hotmail.com>
 */
class ContactDataFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
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
            ->add('name', 'text', array(
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
            ->add('type', 'text', array(
                'label' => 'Type',
                'required' => false,
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
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'clastic_contact_data';
    }
}
