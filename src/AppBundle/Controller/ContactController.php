<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContactData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clastic\BlockBundle;
use Symfony\Component\HttpFoundation\Request;

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
                'class' => 'blauw',
                'displayTitle' => 'Contact',
            ),
        ));
    }

    /**
     * @Route("/post-contact", name="post-contact")
     */
    public function postMessage()
    {
        $request = Request::createFromGlobals();

        $name = $request->query->get('InputName');
        $email = $request->query->get('InputEmail');
        $message = $request->query->get('InputMessage');

        $contact = new ContactData();
        $contact->setName($name);
        $contact->setEmail($email);
        $contact->setContent($message);
        $contact->

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($contact);
        $em->flush();

        // TODO: fix node & mailing

        return $this->render('AppBundle:Contact:index.html.twig', array(
            'record' => array(
                'icon' => 'fa-envelope-o',
                'class' => 'blauw',
                'displayTitle' => 'Contact',
                'success' => true,
                'message' => 'Uw bericht is verstuurd en wij zullen zo snel mogelijk contact met u openemen.'
            ),
        ));
    }
}
