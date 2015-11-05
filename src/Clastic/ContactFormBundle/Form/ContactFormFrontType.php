<?php

namespace Clastic\ContactFormBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;

class ContactFormFrontType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'Naam',
                'required' => true,
            ))
            ->add('companyName', 'text', array(
                'label' => 'Bedrijf',
                'required' => false,
            ))
            ->add('mail', 'email', array(
                'label' => 'E-mail',
                'required' => true,
            ))
            ->add('tel', 'text', array(
                'label' => 'Tel',
                'required' => true,
            ))
            ->add('title', 'text', array(
                'label' => 'Titel',
                'required' => false,
            ))
            ->add('message', 'wysiwyg', array(
                'label' => 'Bericht',
                'required' => true,
            ))
            ->add('recaptcha', 'ewz_recaptcha', array(
                'mapped'      => false,
                'constraints' => array(
                    new RecaptchaTrue()
                )
            ));
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
        return 'clastic_contactformbundle_contactformfront';
    }
}
