<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MailGroup;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Mailgroup controller.
 *
 * @Route("mailgroup")
 */
class MailGroupController extends Controller
{
    /**
     * Lists all mailGroup entities.
     *
     * @Route("/", name="mailgroup_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $mailGroups = $em->getRepository('AppBundle:MailGroup')->findAll();

        return $this->render('mailgroup/index.html.twig', array(
            'mailGroups' => $mailGroups,
        ));
    }

    /**
     * Creates a new mailGroup entity.
     *
     * @Route("/new", name="mailgroup_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $mailGroup = new Mailgroup();
        $form = $this->createForm('AppBundle\Form\MailGroupType', $mailGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($form->getData()->getUsers() as $user)
            {

                $user->addMailGroup($mailGroup);
                $em->persist($user);
            }

            $em->persist($mailGroup);
            $em->flush();
            return $this->redirectToRoute('mailgroup_show', array('id' => $mailGroup->getId()));
        }

        return $this->render('mailgroup/new.html.twig', array(
            'mailGroup' => $mailGroup,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a mailGroup entity.
     *
     * @Route("/{id}", name="mailgroup_show")
     * @Method("GET")
     */
    public function showAction(MailGroup $mailGroup)
    {
        $deleteForm = $this->createDeleteForm($mailGroup);

        return $this->render('mailgroup/show.html.twig', array(
            'mailGroup' => $mailGroup,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing mailGroup entity.
     *
     * @Route("/{id}/edit", name="mailgroup_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MailGroup $mailGroup)
    {
        $deleteForm = $this->createDeleteForm($mailGroup);
        $editForm = $this->createForm('AppBundle\Form\MailGroupType', $mailGroup);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            foreach ($editForm->getData()->getUsers() as $user)
            {

                $user->addMailGroup($mailGroup);
                $em->persist($user);
            }
            $em->persist($mailGroup);
            $em->flush();
//            return $this->redirectToRoute('mailgroup_edit', array('id' => $mailGroup->getId()));
        }

        return $this->render('mailgroup/edit.html.twig', array(
            'mailGroup' => $mailGroup,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a mailGroup entity.
     *
     * @Route("/{id}", name="mailgroup_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MailGroup $mailGroup)
    {
        $form = $this->createDeleteForm($mailGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mailGroup);
            $em->flush($mailGroup);
        }

        return $this->redirectToRoute('mailgroup_index');
    }

    /**
     * Creates a form to delete a mailGroup entity.
     *
     * @param MailGroup $mailGroup The mailGroup entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MailGroup $mailGroup)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mailgroup_delete', array('id' => $mailGroup->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
