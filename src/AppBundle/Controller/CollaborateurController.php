<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Collaborateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Collaborateur controller.
 *
 * @Route("collaborateur")
 */
class CollaborateurController extends Controller
{
    /**
     * Lists all collaborateur entities.
     *
     * @Route("/", name="collaborateur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //$collaborateurs = $em->getRepository('AppBundle:Collaborateur')->findAll();

        $idUser = $this->getUser()->getId();

        $TabTwig = array();


        if ($this->getUser()->getRoles()[0] == "ROLE_RESPONSABLE_AGENCE") {
            $collaborateurs = $em->getRepository('AppBundle:Collaborateur')->findBy(['user'=>$idUser]);
            $TabTwig['collaborateurs'] =  $collaborateurs;


            $ListCustomerForBusiness = $MyCustomers = $em->getRepository('AppBundle:Collaborateur')->getCollaboratorForBusiness($idUser);
            $TabTwig['ListCollaborateurForBusiness'] =  $ListCustomerForBusiness;

        } else if ($this->getUser()->getRoles()[0] == "ROLE_ADMIN" ||$this->getUser()->getRoles()[0] == "ROLE_SUPER_ADMIN") {

            $collaborateurs = $em->getRepository('AppBundle:Collaborateur')->findAll();
            $TabTwig['collaborateurs'] =  $collaborateurs;

        } else {
            $collaborateurs = $em->getRepository('AppBundle:Collaborateur')->findBy(['user'=>$idUser]);
            $TabTwig['collaborateurs'] =  $collaborateurs;


        }

        return $this->render('collaborateur/index.html.twig', $TabTwig);
    }


    /**
     * Finds and displays a collaborateur entity.
     *
     * @Route("/{id}", name="collaborateur_show")
     * @Method("GET")
     */
    public function showAction(Collaborateur $collaborateur)
    {
        //$deleteForm = $this->createDeleteForm($collaborateur);
        $em = $this->getDoctrine()->getManager();
        $lists = $em->getRepository('AppBundle:SurveyCollaborateur')->findBy(['collaborateur'=>$collaborateur->getId()]);


        return $this->render('collaborateur/show.html.twig', array(
            'collaborateur' => $collaborateur,
            'lists' => $lists,
        ));
    }

    /**
     * Displays a form to edit an existing collaborateur entity.
     *
     * @Route("/{id}/edit", name="collaborateur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Collaborateur $collaborateur)
    {
        $deleteForm = $this->createDeleteForm($collaborateur);
        $editForm = $this->createForm('AppBundle\Form\CollaborateurType', $collaborateur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('collaborateur_edit', array('id' => $collaborateur->getId()));
        }

        return $this->render('collaborateur/edit.html.twig', array(
            'collaborateur' => $collaborateur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a collaborateur entity.
     *
     * @Route("/{id}", name="collaborateur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Collaborateur $collaborateur)
    {
        $form = $this->createDeleteForm($collaborateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($collaborateur);
            $em->flush($collaborateur);
        }

        return $this->redirectToRoute('collaborateur_index');
    }

    /**
     * Creates a form to delete a collaborateur entity.
     *
     * @param Collaborateur $collaborateur The collaborateur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Collaborateur $collaborateur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('collaborateur_delete', array('id' => $collaborateur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
