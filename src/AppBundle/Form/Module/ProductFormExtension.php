<?php

namespace AppBundle\Form\Module;

use Clastic\NodeBundle\Form\Extension\AbstractNodeTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * ProductTypeExtension
 */
class ProductFormExtension extends AbstractNodeTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->findTab($builder, 'general')
            ->add('displayTitle', 'text', ['label' => 'Titel die getoond wordt'])
            ->add('icon','text', ['label' => 'Icoon'])
            ->add('shortDescription','wysiwyg',['label' => 'Korte beschrijving', 'required' => false])
            ->add('title1','text', ['label' => 'Titel blok links', 'required' => false])
            ->add('intro1','wysiwyg', ['label' => 'Tekst blok links', 'required' => false])
            ->add('title2','text', ['label' => 'Titel blok rechts', 'required' => false])
            ->add('intro2','wysiwyg', ['label' => 'Tekst blok rechts', 'required' => false])
            ->add('class', 'choice', array(
                'label' => 'Kleur classe',
                'choices'  =>
                    array(
                        'Blauw' => 'blauw',
                        'Groen' => 'groen',
                        'Geel' => 'geel',
                        'Oranje' => 'oranje',
                        'Rood' => 'rood',
                        'Roos' => 'roos',
                    ),
                'required' => true,
            ))
            ->add('image','text', ['label' => 'Locatie banner foto', 'required' => false])
        ;
    }
}
