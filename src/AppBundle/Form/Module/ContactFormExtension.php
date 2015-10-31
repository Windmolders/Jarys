<?php

namespace AppBundle\Form\Module;

use Clastic\NodeBundle\Form\Extension\AbstractNodeTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * ContactTypeExtension
 */
class ContactFormExtension extends AbstractNodeTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->findTab($builder, 'general')
            ->add('name', 'text', ['label' => 'Naam van de contact'])
            ->add('email','text', ['label' => 'Email van de contact'])
            ->add('content','wysiwyg',['label' => 'Bericht van contact', 'required' => false])

        ;
    }
}
