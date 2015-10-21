<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * @Route("/digital-printing", name="DigitalPrinting")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Product:index.html.twig', array(
            'title' => 'Digital Printing',
            'icon' => 'fa-print',
            'product' => 'dp'
        ));
    }
}
