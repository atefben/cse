<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserApp;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Userapp controller.
 *
 * @Route("userapp")
 */
class UserAppController extends Controller
{
    /**
     * Lists all userApp entities.
     *
     * @Route("/", name="userapp_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userApps = $em->getRepository('AppBundle:UserApp')->findAll();

        return $this->render('userapp/index.html.twig', array(
            'userApps' => $userApps,
        ));
    }

    /**
     * Creates a new userApp entity.
     *
     * @Route("/new", name="userapp_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userApp = new Userapp();
        $form = $this->createForm('AppBundle\Form\UserAppType', $userApp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userApp);
            $em->flush($userApp);

            return $this->redirectToRoute('userapp_show', array('id' => $userApp->getId()));
        }

        return $this->render('userapp/new.html.twig', array(
            'userApp' => $userApp,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userApp entity.
     *
     * @Route("/{id}", name="userapp_show")
     * @Method("GET")
     */
    public function showAction(UserApp $userApp)
    {
        $deleteForm = $this->createDeleteForm($userApp);

        return $this->render('userapp/show.html.twig', array(
            'userApp' => $userApp,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userApp entity.
     *
     * @Route("/{id}/edit", name="userapp_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserApp $userApp)
    {
        $deleteForm = $this->createDeleteForm($userApp);
        $editForm = $this->createForm('AppBundle\Form\UserAppType', $userApp);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userapp_edit', array('id' => $userApp->getId()));
        }

        return $this->render('userapp/edit.html.twig', array(
            'userApp' => $userApp,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userApp entity.
     *
     * @Route("/{id}", name="userapp_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserApp $userApp)
    {
        $form = $this->createDeleteForm($userApp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userApp);
            $em->flush($userApp);
        }

        return $this->redirectToRoute('userapp_index');
    }

    /**
     * Creates a form to delete a userApp entity.
     *
     * @param UserApp $userApp The userApp entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserApp $userApp)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userapp_delete', array('id' => $userApp->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
