<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyCriteria;
use AppBundle\Repository\SurveyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\SurveyType;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

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
    public function newAction(Request $request, Customer $customer)
    {
        $surveyManager = $this->get('cse.survey.manager');

        $form  = $surveyManager->addNewSurvey($customer);

        $form->handleRequest($request);

        $criterias = $this->getDoctrine()->getRepository('AppBundle:Criteria')->findBy(['criteriaType'=> 2]);

        if ($form->isSubmitted() && $form->isValid()) {

            $surveyManager->saveDatas($form);

            return $this->redirectToRoute('customer_show', array('id' => $request->get('id')));
        }

        return $this->render('survey/new.html.twig', array(
            'form' => $form->createView(),
            'criterias' =>$criterias,
            'id'  => $request->get('id')
        ));
    }



    /**
     * Creates a new survey entity.
     *
     * @Route("/new/{id}/{idCollab}", name="survey_next")
     * @Method({"GET", "POST"})
     */
    public function nextAction(Request $request)
    {

        $idUser = $this->getUser()->getId();
        $idClient = $request->get('id');
        $idCollab = $request->get('idCollab');

        $em = $this->getDoctrine()->getManager();
        $criterias = $this->getDoctrine()->getRepository('AppBundle:Criteria')->findBy(['criteriaType'=> 2]);
        $survey = $em->getRepository('AppBundle:Survey')->findBy(array('customer'=> $idClient, 'collaborateur'=>$idCollab));
        $index = count($survey) - 1;
        $survey = $em->getRepository('AppBundle:Survey')->find($survey[$index]->getId());
        $form = $this->createForm('AppBundle\Form\SurveyType', $survey, ['idUser' => $idUser, 'criteriaType' => 2]);
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


            foreach ($ObjetSurveyCriteria as $key => $value) {
                $SurveyCriteria = new SurveyCriteria();
                $SurveyCriteria->setScore($value->getScore());
                $SurveyCriteria->setCoefficient($value->getCoefficient());
                $SurveyCriteria->setSurvey($NewSurvey);
                $SurveyCriteria->setCriteria($value->getCriteria());
                //$em->persist($SurveyCriteria);
                $NewSurvey->addSurvey($SurveyCriteria);
            }

            $em->persist($NewSurvey);
            $em->flush($NewSurvey);

            return $this->redirectToRoute('customer_show', array('id' => $request->get('id')));
        }

        return $this->render('survey/next.html.twig', array(
            'survey' => $survey,
            'form' => $form->createView(),
            'criterias' =>$criterias
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
       /* $deleteForm = $this->createDeleteForm($survey);
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
        ));*/
    }

    /**
     * Deletes a survey entity.
     *
     * @Route("/{id}", name="survey_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Survey $survey)
    {
        /*$form = $this->createDeleteForm($survey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($survey);
            $em->flush($survey);
        }

        return $this->redirectToRoute('survey_index');*/
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
        /*return $this->createFormBuilder()
            ->setAction($this->generateUrl('survey_delete', array('id' => $survey->getId())))
            ->setMethod('DELETE')
            ->getForm();*/
    }


    /**
     * genereate pdf for page html.
     *
     * @Route("/{id}/pdf", name="survey_pdf")
     * @Method({"GET"})
     */
    public function downloadPdfAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');
        $survey = $em->getRepository('AppBundle:Survey')->find($id);
        if ($request->get('html')) {
            return $this->render('survey/pdf.html.twig', array('survey' => $survey));
        } else {
            $html = $this->renderView('survey/pdf.html.twig', array('survey' => $survey));

            $filename = urlencode($survey->getCustomer()->getName() . '-' . $survey->getCollaborateur()->getFirstname() . '-' . $survey->getCollaborateur()->getLastname() . '-' . $survey->getDateSurvey()->format('YmdHis'));
            $path = $this->getParameter('parsed_files_pdf').DIRECTORY_SEPARATOR.$filename = urlencode($survey->getCustomer()->getName() . '-' . $survey->getCollaborateur()->getFirstname() . '-' . $survey->getCollaborateur()->getLastname() . '-' . $survey->getDateSurvey()->format('YmdHis').'.pdf');

            if(!file_exists($path))
            {
                $this->get('knp_snappy.pdf')->generateFromHtml($html, $path);

                $response =  new Response(
                    $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
                    200,
                    [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
                    ]
                );
            } else {
                $response = new BinaryFileResponse($path);
                $response->setContentDisposition(
                    ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                    $filename
                );


            }
            return $response;
        }
    }



    /**
     * Verification si le client a déjà évalué le collab !
     *
     * @Route("/new/{id}/getEval/{idCollab}", name="survey_get_eval")
     * @Method({"GET"})
     */
    public function getEvalAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {

            $idClient = $request->get('id');
            $idCollab = $request->get('idCollab');

            $em = $this->getDoctrine()->getManager();
            $surveys = $em->getRepository('AppBundle:Survey')->findBy(array('customer'=> $idClient, 'collaborateur'=>$idCollab));

            $eval = false;
            if($surveys) {
                $eval = true;
            }

            $response = new Response();
            $response->setContent(json_encode(array(
                'eval' => $eval,
            )));
            $response->headers->set('Content-Type', 'application/json');

            return$response;

        } else {
            throw $this->createNotFoundException('The page does not exist');
        }
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
        $evals = $evaluationService->getEvaluationByUser($userId, [SurveyRepository::CONDITION_RENEWABLE_EVALUATION, SurveyRepository::CONDITION_NO_EVALUATION]);
        dump($evals);
        return $this->render('survey/index.html.twig', array(
            'surveys' => $surveys,
        ));
    }



}
