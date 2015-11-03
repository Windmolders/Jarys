<?php

/**
 * This file is part of the Clastic package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Clastic\ContactFormBundle\Controller;

use Clastic\BackofficeBundle\Controller\AbstractModuleController;
use Clastic\ContactFormBundle\Entity\ContactFormType;
use Clastic\ContactFormBundle\Form\Type\ContactFormTypeFormType;
use Clastic\NodeBundle\Node\NodeReferenceInterface;
use Symfony\Component\Form\Form;


/**
 * ContactFormTypeController.
 *
 * @author Dries De Peuter <dries@nousefreak.be>
 */
class ContactFormTypeController extends AbstractModuleController
{
    /**
     * @return string
     */
    protected function getType()
    {
        return 'contact_form_type';
    }

    /**
     * @return string
     */
    protected function getListTemplate()
    {
        return 'ClasticContactFormBundle:Backoffice:list_type.html.twig';
    }

    /**
     * @param object $data
     *
     * @return Form
     */
    protected function buildForm($data)
    {
        return $this->createForm(new ContactFormTypeFormType($this->get('router')), $data);
    }

    /**
     * @param object $data
     *
     * @return string
     */
    protected function resolveDataTitle($data)
    {
        return $data->getTitle();
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'ClasticContactFormBundle:ContactFormType';
    }

    /**
     * @param int $id
     *
     * @return NodeReferenceInterface
     */
    protected function resolveData($id)
    {
        if (!is_null($id)) {
            return $this->getDoctrine()->getRepository($this->getEntityName())
                ->find($id);
        }

        return new ContactFormType();
    }

    /**
     * @param object $data
     *
     * @return string
     */
    protected function getFormSuccessUrl($data)
    {
        return $this->generateUrl('clastic_backoffice_contact_form_type_form', array(
            'id' => $data->getId(),
        ));
    }

    /**
     * @return string
     */
    protected function getListUrl()
    {
        return $this->generateUrl('clastic_backoffice_contact_form_type_list', array(

        ));
    }
}
