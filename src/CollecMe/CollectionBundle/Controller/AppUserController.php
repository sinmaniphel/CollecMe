<?php

namespace CollecMe\CollectionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CollecMe\CollectionBundle\Entity\AppUser;
use CollecMe\CollectionBundle\Form\AppUserType;

/**
 * AppUser controller.
 *
 * @Route("/appuser")
 */
class AppUserController extends Controller
{

    /**
     * Lists all AppUser entities.
     *
     * @Route("/", name="appuser")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CollecMeCollectionBundle:AppUser')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new AppUser entity.
     *
     * @Route("/", name="appuser_create")
     * @Method("POST")
     * @Template("CollecMeCollectionBundle:AppUser:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AppUser();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('appuser_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a AppUser entity.
     *
     * @param AppUser $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(AppUser $entity)
    {
        $form = $this->createForm(new AppUserType(), $entity, array(
            'action' => $this->generateUrl('appuser_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AppUser entity.
     *
     * @Route("/new", name="appuser_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AppUser();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AppUser entity.
     *
     * @Route("/{id}", name="appuser_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CollecMeCollectionBundle:AppUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AppUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AppUser entity.
     *
     * @Route("/{id}/edit", name="appuser_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CollecMeCollectionBundle:AppUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AppUser entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a AppUser entity.
    *
    * @param AppUser $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AppUser $entity)
    {
        $form = $this->createForm(new AppUserType(), $entity, array(
            'action' => $this->generateUrl('appuser_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AppUser entity.
     *
     * @Route("/{id}", name="appuser_update")
     * @Method("PUT")
     * @Template("CollecMeCollectionBundle:AppUser:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CollecMeCollectionBundle:AppUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AppUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('appuser_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AppUser entity.
     *
     * @Route("/{id}", name="appuser_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CollecMeCollectionBundle:AppUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AppUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('appuser'));
    }

    /**
     * Creates a form to delete a AppUser entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appuser_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
