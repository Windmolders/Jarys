<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clastic\BlockBundle;

class DownloadController extends Controller
{
    /**
     * @Route("/downloads", name="downloads")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Downloads:index.html.twig', array(
            'record' => array(
                'icon' => 'fa-download',
                'class' => '',
                'displayTitle' => 'Downloads',
                'items' => $this->getDoctrine()
                    ->getRepository('AppBundle:Download')
                    ->findAll()
            ),
        ));
    }
}
