<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Collaborateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $tabTwig = $this->get('cse.collab.manager')->getCollaborators();

        return $this->render('collaborateur/index.html.twig', $tabTwig);
    }


    /**
     * Finds and displays a collaborateur entity.
     *
     * @Route("/{id}", name="collaborateur_show")
     * @Method("GET")
     */
    public function showAction(Collaborateur $collaborateur)
    {
        $lists = $this->get('cse.collab.manager')->showCollaboratorDetails($collaborateur);

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
     *
     * @param Request $request
     * @param Collaborateur $collaborateur
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Collaborateur $collaborateur)
    {
        $collaboratorManager = $this->get('cse.collab.manager');

        $editForm   = $collaboratorManager->createForm('AppBundle\Form\CollaboratorType', $collaborateur);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $collaboratorManager->saveDatas();

            return $this->redirectToRoute('collaborateur_edit', array('id' => $collaborateur->getId()));
        }

        return $this->render('collaborateur/edit.html.twig', array(
            'collaborateur' => $collaborateur,
            'edit_form' => $editForm->createView(),
        ));
    }
}
