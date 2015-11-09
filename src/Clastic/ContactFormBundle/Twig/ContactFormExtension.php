<?php
namespace Clastic\ContactFormBundle\Twig;

use Clastic\ContactFormBundle\Entity\ContactFormData;
use Clastic\ContactFormBundle\Entity\ContactFormDataRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Jonas Windmolders <jonas_windmolders@hotmail.com>
 */
class ContactFormExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    private $environment;

    private $entityManager;

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return \Twig_Environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param \Twig_Environment $environment
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
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
            new \Twig_SimpleFunction('clastic_contact_form_dashboard', array($this, 'renderContactInfo'), array('is_safe' => array('html'))),
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
     * @return string|null
     */
    public function renderContactInfo()
    {
        $template = 'ClasticContactFormBundle:Twig:dashboard.html.twig';

        $items = $this->getEntityManager()->getRepository('ClasticContactFormBundle:ContactFormData')->findAll();

        if(is_null($items) && count($items) > 0) {
           return null;
        }

        /** @var ContactFormData $firstItem */
        $firstItem = new ContactFormData();
        $stateTypes = $firstItem->getStates();

        $states = array();

        foreach($stateTypes as $value) {
            $states[] = array('name' => $value, 'count' => 0);
        }

        foreach($items as $value) {
            /** ContactFormData $value */
            $index = intval($value->getState());
            if (isset($states[$index])) {
                $states[$index]["count"] += 1;
            }
        }

        return $this->environment->render($template, array(
            'states' => $states,
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
