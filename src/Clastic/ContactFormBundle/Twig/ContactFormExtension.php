<?php
namespace Clastic\ContactFormBundle\Twig;

use Clastic\ContactFormBundle\Entity\ContactFormDataRepository;
use Jwi\ContactBundle\Entity\ContactDataRepository;
use Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables;

/**
 * @author Jonas Windmolders <jonas_windmolders@hotmail.com>
 */
class ContactFormExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    private $environment;

    /**
     * @var ContactDataRepository
     */
    private $repo;

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('clastic_contact_form', array($this, 'renderContactForm'), array('is_safe' => array('html'))),
        );
    }

    /**
     * @return string
     */
    public function renderContactForm()
    {
        $template = 'ContactFormBundle:Twig:contact.html.twig';

        return $this->environment->render($template, array(

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'clastic_contact_form';
    }
}
