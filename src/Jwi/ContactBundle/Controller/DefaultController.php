<?php

namespace Jwi\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JwiContactBundle:Default:index.html.twig', array('name' => $name));
    }
}
