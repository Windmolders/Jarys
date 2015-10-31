<?php

namespace AppBundle\Form\Module;

use Clastic\NodeBundle\Form\Extension\AbstractNodeTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * DownloadsTypeExtension
 */
class DownloadsFormExtension extends AbstractNodeTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->findTab($builder, 'general')
            ->add('displayTitle', 'text', ['label' => 'Titel die getoond wordt'])
            ->add('url','text', ['label' => 'Externe url'])
            ->add('content','wysiwyg',['label' => 'Text content', 'required' => false])

        ;
    }
}
