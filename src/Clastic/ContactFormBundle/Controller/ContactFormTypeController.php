<?php

namespace Clastic\ContactFormBundle\Controller;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Clastic\ContactFormBundle\Entity\ContactFormType;
use Clastic\ContactFormBundle\Form\ContactFormTypeType;

/**
 * ContactFormType controller.
 *
 */
class ContactFormTypeController extends Controller
{

    public function getType() {
        return 'contact_form';
    }

    public function getEntityName() {
        return 'ClasticContactFormBundle:ContactFormType';
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
     * Lists all ContactFormType entities.
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

        return $this->render('ClasticContactFormBundle:Backoffice:index.html.twig', array(
            'data' => $data,
            'type' => $this->getType(),
            'module' => $this->get('clastic.module_manager')->getModule($this->getType()),
            'submodules' => array(),
        ));
    }
    /**
     * Creates a new ContactFormType entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ContactFormType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contact-form-type_show', array('id' => $entity->getId())));
        }

        return $this->render('ClasticContactFormBundle:Backoffice:edit.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'type' => $this->getType(),
            'module' => $this->get('clastic.module_manager')->getModule($this->getType()),
            'submodules' => array(),
        ));
    }

    /**
     * Creates a form to create a ContactFormType entity.
     *
     * @param ContactFormType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ContactFormType $entity)
    {
        $form = $this->createForm(new ContactFormTypeType(), $entity, array(
            'action' => $this->generateUrl('contact-form-type_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ContactFormType entity.
     *
     */
    public function newAction()
    {
        $entity = new ContactFormType();
        $form   = $this->createCreateForm($entity);

        return $this->render('ClasticContactFormBundle:Backoffice:edit.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'type' => $this->getType(),
            'module' => $this->get('clastic.module_manager')->getModule($this->getType()),
            'submodules' => array(),
        ));
    }

    /**
     * Finds and displays a ContactFormType entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClasticContactFormBundle:ContactFormType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactFormType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClasticContactFormBundle:Backoffice:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'type' => $this->getType(),
            'module' => $this->get('clastic.module_manager')->getModule($this->getType()),
            'submodules' => array(),
        ));
    }

    /**
     * Displays a form to edit an existing ContactFormType entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClasticContactFormBundle:ContactFormType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactFormType entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClasticContactFormBundle:Backoffice:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'type' => $this->getType(),
            'module' => $this->get('clastic.module_manager')->getModule($this->getType()),
            'submodules' => array(),
        ));
    }

    /**
    * Creates a form to edit a ContactFormType entity.
    *
    * @param ContactFormType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ContactFormType $entity)
    {
        $form = $this->createForm(new ContactFormTypeType(), $entity, array(
            'action' => $this->generateUrl('contact-form-type_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ContactFormType entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClasticContactFormBundle:ContactFormType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ContactFormType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('contact-form-type_edit', array('id' => $id)));
        }

        return $this->render('ClasticContactFormBundle:Backoffice:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'type' => $this->getType(),
            'module' => $this->get('clastic.module_manager')->getModule($this->getType()),
            'submodules' => array(),
        ));
    }
    /**
     * Deletes a ContactFormType entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ClasticContactFormBundle:ContactFormType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ContactFormType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contact-form-type'));
    }

    /**
     * Creates a form to delete a ContactFormType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contact-form-type_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
