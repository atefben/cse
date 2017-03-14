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
        $mailListManager = $this->get('cse.maillist.manager');

        $emails = $mailListManager->getMailLists();

        return $this->render('maillist/index.html.twig', array(
            'emails' => $emails,
        ));
    }

    /**
     * Add an email to the mailing list.
     *
     * @Route("/new", name="maillist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $mailList = new MailList();
        $mailListManager = $this->get('cse.maillist.manager');

        $form = $mailListManager->createForm('AppBundle\Form\MailListType', $mailList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $mailListManager->saveDatas($form);

            return $this->redirectToRoute('maillist_index');
        }

        return $this->render('maillist/new.html.twig', array(
            'maillist' => $mailList,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing maillist entity.
     *
     * @Route("/{id}/edit", name="maillist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MailList $mailList)
    {
        $mailListManager = $this->get('cse.criteria.manager');

        $editForm = $mailListManager->createForm('AppBundle\Form\MailListType', $mailList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $mailListManager->saveDatas($editForm);

            return $this->redirectToRoute('maillist_index');
        }

        return $this->render('maillist/edit.html.twig', array(
            'maillist' => $mailList,
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
        $mailListManager = $this->get('cse.maillist.manager');
        $id = $request->get('id');
        $mailListManager->deleteDatas($id);

        return $this->redirectToRoute('maillist_index');
    }
}