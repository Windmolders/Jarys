<?php

namespace Clastic\ContactFormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ClasticContactFormBundle:Default:index.html.twig', array('name' => $name));
    }
}
