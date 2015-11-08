<?php

namespace AppBundle\Controller;

use Clastic\ContactFormBundle\Entity\ContactFormData;
use Clastic\ContactFormBundle\Form\ContactFormFrontType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clastic\BlockBundle;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function indexAction(Request $request)
    {
        $sitesettings = $this->getDoctrine()->getRepository('AppBundle:SiteSetting');

        /** @var SiteSetting $value */
        $setting = $sitesettings->findOneBy(array('name' => 'mapColors'));

        $post = new ContactFormData();
        $form = $this->createForm(new ContactFormFrontType(), $post);
        $form->add('submit', 'submit', array(
            'label' => 'Verzend',
            'attr'  => array('class' => 'btn-jarys')
        ));

        $form->handleRequest($request);

        $message = '';

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setState(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $message = 'Uw bericht is succesvol ontvangen. Wij contacteren u zo snel mogelijk.';
        }

        return $this->render('AppBundle:Contact:index.html.twig', array(
            'record' => array(
                'icon' => 'fa-envelope-o',
                'class' => 'blauw',
                'displayTitle' => 'Contact',
            ),
            'form' => $form->createView(),
            'message' => $message,
            'mapColors' => is_null($setting)? '{}' : $setting->getValue(),
        ));
    }
}
