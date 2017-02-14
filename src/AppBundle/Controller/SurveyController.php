<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyCriteria;
use AppBundle\Repository\SurveyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\SurveyType;

/**
 * Survey controller.
 *
 * @Route("survey")
 */
class SurveyController extends Controller
{
    /**
     * Lists all survey entities.
     *
     * @Route("/", name="survey_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $surveys = $em->getRepository('AppBundle:Survey')->findAll();

        return $this->render('survey/index.html.twig', array(
            'surveys' => $surveys,
        ));
    }

    /**
     * Creates a new survey entity.
     *
     * @Route("/new/{id}", name="survey_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $idUser = $this->getUser()->getId();
        $survey = new Survey();
        $form = $this->createForm( SurveyType::class  , $survey, ['idUser' => $idUser, 'criteriaType' => 2]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();


            $ObjetSurveyCriteria = $survey->getSurveys();

            $NewSurvey = new Survey();
            $NewSurvey->setCommentairesClient($survey->getCommentairesClient());
            $NewSurvey->setSignatureClient($survey->getSignatureClient());
            $NewSurvey->setCollaborateur($survey->getCollaborateur());

            $NewSurvey->setUser($this->getUser());

            $repository = $this->getDoctrine()->getRepository('AppBundle:Customer');
            $customer = $repository->find($request->get('id'));
            $NewSurvey->setCustomer($customer);

            $em->persist($NewSurvey);

            foreach ($ObjetSurveyCriteria as $key => $value) {
                $SurveyCriteria = new SurveyCriteria();
                $SurveyCriteria->setScore($value->getScore());
                $SurveyCriteria->setCoefficient($value->getCoefficient());
                $SurveyCriteria->setSurvey($NewSurvey);
                $SurveyCriteria->setCriteria($value->getCriteria());
                $em->persist($SurveyCriteria);
            }

            $em->flush($NewSurvey);

            return $this->redirectToRoute('customer_show', array('id' => $request->get('id')));
        }

        return $this->render('survey/new.html.twig', array(
            'survey' => $survey,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a survey entity.
     *
     * @Route("/{id}", name="survey_show")
     * @Method("GET")
     */
    public function showAction(Survey $survey)
    {
        $deleteForm = $this->createDeleteForm($survey);

        return $this->render('survey/show.html.twig', array(
            'survey' => $survey,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing survey entity.
     *
     * @Route("/{id}/edit", name="survey_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Survey $survey)
    {
        $deleteForm = $this->createDeleteForm($survey);
        $editForm = $this->createForm('AppBundle\Form\SurveyType', $survey);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('survey_edit', array('id' => $survey->getId()));
        }

        return $this->render('survey/edit.html.twig', array(
            'survey' => $survey,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a survey entity.
     *
     * @Route("/{id}", name="survey_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Survey $survey)
    {
        $form = $this->createDeleteForm($survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($survey);
            $em->flush($survey);
        }

        return $this->redirectToRoute('survey_index');
    }

    /**
     * Creates a form to delete a survey entity.
     *
     * @param Survey $survey The survey entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Survey $survey)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('survey_delete', array('id' => $survey->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    /**
     * Displays a form to edit an existing survey entity.
     *
     * @Route("/{id}/pdf", name="survey_pdf")
     * @Method({"GET"})
     */
    public function downloadPdfAction(Request $request) {

    }

    /**
     * Lists all surveys by user.
     *
     * @Route("/list/{userId}", name="survey_user_list")
     * @Method("GET")
     */
    public function listSurveysByUser($userId)
    {

        $em = $this->getDoctrine()->getManager();
        $surveys = $em->getRepository('AppBundle:Survey')->findAll();
        $evaluationService = $this->get('app.evaluation_service');
        $evals = $evaluationService->getEvaluationByUser($userId,[SurveyRepository::CONDITION_RENEWABLE_EVALUATION,SurveyRepository::CONDITION_NO_EVALUATION]);
        dump($evals);
        return $this->render('survey/index.html.twig', array(
            'surveys' => $surveys,
        ));
    }
}
