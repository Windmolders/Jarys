<?php

namespace AppBundle\Form\Module;

use Clastic\NodeBundle\Form\Extension\AbstractNodeTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * ProductInfoTypeExtension
 */
class ProductInfoFormExtension extends AbstractNodeTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->findTab($builder, 'general')
            ->add('displayTitle', 'text', ['label' => 'Menu titel die getoond wordt'])
            ->add('content', 'wysiwyg', ['label' => 'Inhoud'])
            ->add('isActive', 'checkbox', ['label' => 'Tonen als submenu'])
            ->add('product','entity',['label' => 'Gelinkt product', 'class' => 'AppBundle:Product','property' => 'node.title'])
            ;


    }

}
