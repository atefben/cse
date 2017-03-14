<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Criterion controller.
 *
 * @Route("criteria")
 */
class CriteriaController extends Controller
{
    /**
     * Lists all criterion entities.
     *
     * @Route("/", name="criteria_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $criteriaManager = $this->get('cse.criteria.manager');

        $criterias = $criteriaManager->getCriterias();

        return $this->render('criteria/index.html.twig', array(
            'criterias' => $criterias,
        ));
    }

    /**
     * Creates a new criterion entity.
     *
     * @Route("/new", name="criteria_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $criterion = new Criteria();
        $criteriaManager = $this->get('cse.criteria.manager');

        $form = $criteriaManager->createForm('AppBundle\Form\CriteriaType', $criterion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $criteriaManager->saveDatas($form);

            return $this->redirectToRoute('criteria_show', array('id' => $criterion->getId()));
        }

        return $this->render('criteria/new.html.twig', array(
            'criterion' => $criterion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a criterion entity.
     *
     * @Route("/{id}", name="criteria_show")
     * @Method("GET")
     */
    public function showAction(Criteria $criterion)
    {
        $deleteForm = $this->createDeleteForm($criterion);

        return $this->render('criteria/show.html.twig', array(
            'criterion' => $criterion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing criterion entity.
     *
     * @Route("/{id}/edit", name="criteria_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Criteria $criterion)
    {
        $deleteForm = $this->createDeleteForm($criterion);
        $criteriaManager = $this->get('cse.criteria.manager');

        $editForm = $criteriaManager->createForm('AppBundle\Form\CriteriaType', $criterion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $criteriaManager->saveDatas($editForm);

            return $this->redirectToRoute('criteria_edit', array('id' => $criterion->getId()));
        }

        return $this->render('criteria/edit.html.twig', array(
            'criterion' => $criterion,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a criterion entity.
     *
     * @Route("/{id}", name="criteria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Criteria $criterion)
    {
        $criteriaManager = $this->get('cse.criteria.manager');
        $form = $this->createDeleteForm($criterion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $criteriaManager->delete($criterion);
        }

        return $this->redirectToRoute('criteria_index');
    }

    /**
     * Creates a form to delete a criterion entity.
     *
     * @param Criteria $criterion The criterion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Criteria $criterion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('criteria_delete', array('id' => $criterion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
