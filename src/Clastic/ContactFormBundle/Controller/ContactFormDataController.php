<?php

namespace Clastic\ContactFormBundle\Controller;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clastic\ContactFormBundle\Entity\ContactFormData;
use Clastic\ContactFormBundle\Form\ContactFormDataType;

/**
 * ContactFormData controller.
 *
 */
class ContactFormDataController extends Controller
{
    /**
     * @return string
     */
    public function getType() {
        return 'contact_form';
    }

    /**
     * @return string
     */
    public function getEntityType() {
        return 'contact_form_data';
    }

    /**
     * @return string
     */
    public function getEntityName() {
        return 'ClasticContactFormBundle:ContactFormData';
    }

    /**
     * @return string
     */
    public function getDisplayTitle() {
        return 'Contact form';
    }

    /**
     * Returns de links for the backoffice template.
     *
     * @return array
     */
    public function addBackofficeLinks() {
        return array (
            'edit' => 'contact-form-data_edit',
            'list' => 'contact-form-data',
            'show' => 'contact-form-data_show',
            'delete' => 'contact-form-data_delete',
            'new' => 'contact-form-data_new'
        );
    }

    /**
     * Returns array with extra template data
     *
     * @return array
     */
    public function getTemplateData() {
        return array(
            'type' => $this->getType(),
            'entityType' => $this->getEntityType(),
            'module' => $this->get('clastic.module_manager')->getModule($this->getType()),
            'submodules' => array(),
            'links' => $this->addBackofficeLinks(),
            'displayTitle' => $this->getDisplayTitle(),
        );
    }

    /**
     * @param QueryBuilder $queryBuilder
     *
     * @return QueryBuilder
     */
    protected function alterListQuery(QueryBuilder $queryBuilder)
    {
        return $queryBuilder;
    }

    /**
     * Lists all ContactFormData entities.
     *
     */
    public function indexAction(Request $request)
    {
        $queryBuilder = $this->getDoctrine()
            ->getManager()
            ->createQueryBuilder()
            ->select('e')
            ->from($this->getEntityName(), 'e')
            ->orderBy('e.id', 'DESC');

        $adapter = new DoctrineORMAdapter($this->alterListQuery($queryBuilder));
        $data = new Pagerfanta($adapter);
        $data->setCurrentPage($request->query->get('page', 1));

        return $this->render('ClasticContactFormBundle:Backoffice:index.html.twig',
            array_merge(
                array(
                    'data' => $data,
                ),
                $this->getTemplateData()
            ));
    }
    /**
     * Creates a new ContactFormData entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ContactFormData();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contact-form-data_show', array('id' => $entity->getId())));
        }

        return $this->render('ClasticContactFormBundle:Backoffice:edit.html.twig',
            array_merge(
                array(
                    'entity' => $entity,
                ),
                $this->getTemplateData()
            ));
    }

    /**
     * Creates a form to create a ContactFormData entity.
     *
     * @param ContactFormData $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ContactFormData $entity)
    {
        $form = $this->createForm(new ContactFormDataType(), $entity, array(
            'action' => $this->generateUrl('contact-form-data_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ContactFormData entity.
     *
     */
    public function newAction()
    {
        $entity = new ContactFormData();
        $form   = $this->createCreateForm($entity);

        return $this->render('ClasticContactFormBundle:Backoffice:Data/new.html.twig',
            array_merge(
                array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ),
                $this->getTemplateData()
            ));
    }

    /**
     * Finds and displays a ContactFormData entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClasticContactFormBundle:ContactFormData')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactFormData entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClasticContactFormBundle:Backoffice:Data/show.html.twig',
            array_merge(
                array(
                    'entity' => $entity,
                    'record' => $entity,
                    'delete_form' => $deleteForm->createView(),
                ),
                $this->getTemplateData()
            ));
    }

    /**
     * Displays a form to edit an existing ContactFormData entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClasticContactFormBundle:ContactFormData')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactFormData entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClasticContactFormBundle:Backoffice:edit.html.twig',
            array_merge(
                array(
                    'entity' => $entity,
                    'edit_form'   => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ),
                $this->getTemplateData()
            ));
    }

    /**
    * Creates a form to edit a ContactFormData entity.
    *
    * @param ContactFormData $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ContactFormData $entity)
    {
        $form = $this->createForm(new ContactFormDataType(), $entity, array(
            'action' => $this->generateUrl('contact-form-data_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ContactFormData entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var ContactFormData $entity */
        $entity = $em->getRepository('ClasticContactFormBundle:ContactFormData')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactFormData entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            var_dump($entity);die;
            $entity->setSocial(null);
            $em->flush();

            return $this->redirect($this->generateUrl('contact-form-data_edit', array('id' => $id)));
        }

        return $this->render('ClasticContactFormBundle:Backoffice:edit.html.twig',
            array_merge(
                array(
                    'entity'      => $entity,
                    'edit_form'   => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ),
                $this->getTemplateData()
            ));

    }
    /**
     * Deletes a ContactFormData entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ClasticContactFormBundle:ContactFormData')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ContactFormData entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contact-form-data'));
    }

    /**
     * Creates a form to delete a ContactFormData entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contact-form-data_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
