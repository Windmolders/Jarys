<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clastic\BlockBundle;
use Clastic\BlockBundle\ClasticBlockBundle;
use Clastic\BlockBundle\Block;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $productrepo = $this->getDoctrine()->getRepository('AppBundle:Product');
        $blockRepo = $this->getDoctrine()->getRepository('ClasticBlockBundle:Block');

        $homepageBlock = $blockRepo->findOneByIdentifier('homepage_text');

        return $this->render('AppBundle:Default:index.html.twig', array(
            'products' => $productrepo->findAll(),
            'record' => array(
                'icon' => 'fa-home',
                'class' => '',
                'displayTitle' => 'We colour your ideas',
            ),
            'home' => true,
            'text' => is_null($homepageBlock) ? 'No text given' : $homepageBlock->getBody(),
        ));
    }
}
