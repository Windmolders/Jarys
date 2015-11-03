<?php

namespace Clastic\ContactFormBundle\Controller;

use Clastic\BackofficeBundle\Controller\AbstractModuleController;
use Clastic\ContactFormBundle\Entity\ContactFormData;
use Clastic\ContactFormBundle\Form\Type\ContactFormDataFormType;
use Symfony\Component\Form\Form;

/**
 * ContactFormDataController.
 *
 * @author Jonas Windmolders
 */
class ContactFormDataController extends AbstractModuleController
{
    /**
     * @return string
     */
    protected function getType()
    {
        return 'contact_form_data';
    }

    /**
     * @return string
     */
    protected function getListTemplate()
    {
        return 'ClasticContactFormBundle:Backoffice:list_data.html.twig';
    }

    /**
     * @param object $data
     *
     * @return Form
     */
    protected function buildForm($data)
    {
        return $this->createForm(new ContactFormDataFormType($this->get('router')), $data);
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
        return 'ClasticContactFormBundle:ContactFormData';
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

        return new ContactFormData();
    }

    /**
     * @param object $data
     *
     * @return string
     */
    protected function getFormSuccessUrl($data)
    {
        return $this->generateUrl('clastic_backoffice_contact_form_data_form', array(
            'id' => $data->getId(),
        ));
    }

    /**
     * @return string
     */
    protected function getListUrl()
    {
        return $this->generateUrl('clastic_backoffice_contact_form_data_list', array(
        ));
    }
}
