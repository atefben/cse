<?php
namespace AppBundle\Services;

use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyCollaborateur;
use AppBundle\Services\MailNotifierService;
use Doctrine\ORM\EntityManager;


class SurveyNotification {

    private $mailNotifierService;
    private $entityManager;

    public function __construct(MailNotifierService $mailNotifierService)
    {
        $this->mailNotifierService = $mailNotifierService;
        //$this->entityManager = $entityManager;
    }

    public  function notifyEvalCustomer(Survey $survey = NULL ) {

        /*$mail_collab = $survey->getCollaborateur()->getEmailPro();
        $this->mailNotifierService->appendReceiver($mail_collab);
        $mail_commerciale = $survey->getUser()->getEmail();
        $this->mailNotifierService->appendReceiver($mail_commerciale);
        $responsable_commerciale = $entity_manager->getRepository('UserBundle:User')->findByUserReponsable($survey->getUser()->getId());
        if (isset($responsable_commerciale) && !empty($responsable_commerciale)) {
            $this->mailNotifierService->appendReceiver($responsable_commerciale->getEmail());
        }
        $list_mails = $entity_manager->getRepository('AppBundle:MailList')->findAll();
        foreach ($list_mails as $mail){
            $this->mailNotifierService->appendReceiver($mail->getEmail());
        }
        $this->mailNotifierService->setSubject('Retour évaluation collaborateur');
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
        $this->mailNotifierService->setBody(sprintf('l\'évaluation du collaborateur %s a été faite avec une note de %f',$survey->getCollaborateur()->getCode, $note) );
        $this->mailNotifierService->send();*/

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
        $this->mailNotifierService->setBody(sprintf('l\'évaluation du collaborateur %s a été faite avec une note de %f',$surveyCollab->getCollaborateur()->getCode(), $note) );
        $this->mailNotifierService->send();
    }
}