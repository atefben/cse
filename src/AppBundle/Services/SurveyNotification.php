<?php
namespace AppBundle\Services;

use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyCollaborateur;
use AppBundle\Services\MailNotifierService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


class SurveyNotification {

    private $mailNotifierService;
    private $container;

    public function __construct(MailNotifierService $mailNotifierService, ContainerInterface $container)
    {
        $this->mailNotifierService = $mailNotifierService;
        $this->container = $container;
    }

    public  function notifyEvalCustomer(Survey $survey = NULL,$entityManager ) {

        $mail_collab = $survey->getCollaborateur()->getEmail();
        $this->mailNotifierService->appendReceiver($mail_collab);
        $mail_commerciale = $survey->getUser()->getEmail();
        $this->mailNotifierService->appendReceiver($mail_commerciale);
        $responsable_commerciale = $entityManager->getRepository('UserBundle:User')->findByUserReponsable($survey->getUser()->getId());
        if (isset($responsable_commerciale) && !empty($responsable_commerciale)) {
            $this->mailNotifierService->appendReceiver($responsable_commerciale->getEmail());
        }
        $list_mails = $entityManager->getRepository('AppBundle:MailList')->findAll();
        foreach ($list_mails as $mail){
            $this->mailNotifierService->appendReceiver($mail->getEmail());
        }
        $this->mailNotifierService->setSubject('Retour évaluation Client');
        $all_criteria_survey = $survey->getSurveys();
        $somme = 0;
        $somme_coefficient = 0;
        $note = 0;
        foreach ($all_criteria_survey as $survey_criteria){
            $somme += $survey_criteria->getScore() * $survey_criteria->getCoefficient();
            $somme_coefficient += $survey_criteria->getCoefficient();
        }
        if ($somme_coefficient != 0)
            $note = $somme/$somme_coefficient;
        else
            $note = 0;

        $contenu = $this->container->get('templating')->render('customer/recap_eval.html.twig', array(
            'code' => $survey->getCustomer()->getCodeSX(),
            'note' => $note
        ));
        $this->mailNotifierService->setBody($contenu);
        $this->mailNotifierService->send();

        if($note <= $this->container->getParameter('customer_seuil_value') )
        {
            $this->mailNotifierService->setSubject('Evaluation inférieur à la seuil');
            $contenu = $this->container->get('templating')->render('customer/seuil_eval.html.twig', array(
                'code' => $survey->getCustomer()->getCodeSX(),
                'note' => $note
            ));
            $this->mailNotifierService->setBody($contenu);
            $this->mailNotifierService->send();
        }
    }

    public  function notifyEvalCollab(SurveyCollaborateur $surveyCollab = NULL,$entityManager) {

        $mail_commerciale = $surveyCollab->getUser()->getEmail();
        $this->mailNotifierService->appendReceiver($mail_commerciale);
        $responsable_commerciale = $entityManager->getRepository('UserBundle:User')->findByUserReponsable($surveyCollab->getUser()->getId());
        if (isset($responsable_commerciale) && !empty($responsable_commerciale)) {
            $this->mailNotifierService->appendReceiver($responsable_commerciale->getEmail());
        }

        $list_mails = $entityManager->getRepository('AppBundle:MailList')->findAll();
        foreach ($list_mails as $mail){
            $this->mailNotifierService->appendReceiver($mail->getEmail());
        }

        $this->mailNotifierService->setSubject('Retour évaluation collaborateur');
        $all_criteria_survey = $surveyCollab->getSurveysCollaborateur();
        $somme = 0;
        $somme_coefficient = 0;
        $note = 0;

        foreach ($all_criteria_survey as $survey_criteria){
            $somme += $survey_criteria->getScore() * $survey_criteria->getCoefficient();
            $somme_coefficient += $survey_criteria->getCoefficient();
        }

        if ($somme_coefficient != 0)
            $note = $somme/$somme_coefficient;
        else
            $note = 0;

        $contenu = $this->container->get('templating')->render('collaborateur/recap_eval.html.twig', array(
            'code' => $surveyCollab->getCollaborateur()->getCode(),
            'note' => $note
        ));
        $this->mailNotifierService->setBody($contenu);
        $this->mailNotifierService->send();

        if($note <= $this->container->getParameter('collab_seuil_value') )
        {
            $this->mailNotifierService->setSubject('Evaluation inférieur à la seuil');
            $contenu = $this->container->get('templating')->render('collaborateur/seuil_eval.html.twig', array(
                'code' => $surveyCollab->getCollaborateur()->getCode(),
                'note' => $note
            ));
            $this->mailNotifierService->setBody($contenu);
            $this->mailNotifierService->send();
        }
    }
}