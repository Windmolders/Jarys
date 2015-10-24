<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clastic\BlockBundle;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Contact:index.html.twig', array(
            'record' => array(
                'icon' => 'fa-envelope-o',
                'class' => '',
                'displayTitle' => 'Contact',
            ),
        ));
    }
}
