<?php
namespace AppBundle\Services;

use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyCollaborateur;
use AppBundle\Services\MailNotifierService;


class SurveyNotification {

    private $mailNotifierService;

    public function __construct(MailNotifierService $mailNotifierService)
    {
        $this->mailNotifierService = $mailNotifierService;
    }

    public  function notifyEvalCustomer(Survey $survey = NULL) {

    }

    public  function notifyEvalCollab(SurveyCollaborateur $surveyCollab = NULL) {

    }
}