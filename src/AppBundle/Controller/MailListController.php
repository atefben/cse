<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MailList;
use AppBundle\Form\MailListType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * MailList controller.
 *
 * @Route("maillist")
 */
class MailListController extends Controller
{
    /**
     * Lists all maillist entities.
     *
     * @Route("/", name="maillist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $em->getEventManager()->addEventSubscriber(new \Gedmo\SoftDeleteable\SoftDeleteableListener());

        $emails = $em->getRepository('AppBundle:MailList')->findAll();

        return $this->render('maillist/index.html.twig', array(
            'emails' => $emails,
        ));
    }

    /**
     * All an email to the mailing list.
     *
     * @Route("/new", name="maillist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $maillist = new MailList();
        $form = $this->createForm(MailListType::class, $maillist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($maillist);
            $em->flush($maillist);

            return $this->redirectToRoute('maillist_index');
        }

        return $this->render('maillist/new.html.twig', array(
            'maillist' => $maillist,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing maillist entity.
     *
     * @Route("/{id}/edit", name="maillist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MailList $maillist)
    {
        $editForm = $this->createForm(MailListType::class, $maillist);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('maillist_index');
        }

        return $this->render('maillist/edit.html.twig', array(
            'maillist' => $maillist,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a maillist entity.
     *
     * @Route("/{id}", name="maillist_delete")
     *
     */
    public function deleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $em->getEventManager()->addEventSubscriber(new \Gedmo\SoftDeleteable\SoftDeleteableListener());

        $id = $request->get('id');

        $repository = $this->getDoctrine()->getRepository('AppBundle:MailList');
        $maillist =  $repository->find($id);

        $em->remove($maillist);
        $em->flush($maillist);

        return $this->redirectToRoute('maillist_index');
    }
}