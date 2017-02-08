<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SurveyCriteria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Surveycriterium controller.
 *
 * @Route("surveycriteria")
 */
class SurveyCriteriaController extends Controller
{
    /**
     * Lists all surveyCriterium entities.
     *
     * @Route("/", name="surveycriteria_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $surveyCriterias = $em->getRepository('AppBundle:SurveyCriteria')->findAll();

        return $this->render('surveycriteria/index.html.twig', array(
            'surveyCriterias' => $surveyCriterias,
        ));
    }

    /**
     * Creates a new surveyCriterium entity.
     *
     * @Route("/new", name="surveycriteria_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $surveyCriteria = new SurveyCriteria();
        $form = $this->createForm('AppBundle\Form\SurveyCriteriaType', $surveyCriteria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($surveyCriteria);
            $em->flush($surveyCriteria);

            return $this->redirectToRoute('surveycriteria_show', array('id' => $surveyCriteria->getId()));
        }

        return $this->render('surveycriteria/new.html.twig', array(
            'surveyCriterium' => $surveyCriteria,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a surveyCriterium entity.
     *
     * @Route("/{id}", name="surveycriteria_show")
     * @Method("GET")
     */
    public function showAction(SurveyCriteria $surveyCriterium)
    {
        $deleteForm = $this->createDeleteForm($surveyCriterium);

        return $this->render('surveycriteria/show.html.twig', array(
            'surveyCriterium' => $surveyCriterium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing surveyCriterium entity.
     *
     * @Route("/{id}/edit", name="surveycriteria_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SurveyCriteria $surveyCriterium)
    {
        $deleteForm = $this->createDeleteForm($surveyCriterium);
        $editForm = $this->createForm('AppBundle\Form\SurveyCriteriaType', $surveyCriterium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('surveycriteria_edit', array('id' => $surveyCriterium->getId()));
        }

        return $this->render('surveycriteria/edit.html.twig', array(
            'surveyCriterium' => $surveyCriterium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a surveyCriterium entity.
     *
     * @Route("/{id}", name="surveycriteria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SurveyCriteria $surveyCriterium)
    {
        $form = $this->createDeleteForm($surveyCriterium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($surveyCriterium);
            $em->flush($surveyCriterium);
        }

        return $this->redirectToRoute('surveycriteria_index');
    }

    /**
     * Creates a form to delete a surveyCriterium entity.
     *
     * @param SurveyCriteria $surveyCriterium The surveyCriterium entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SurveyCriteria $surveyCriterium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('surveycriteria_delete', array('id' => $surveyCriterium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
