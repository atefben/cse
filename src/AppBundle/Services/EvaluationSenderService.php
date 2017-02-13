<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 13/02/17
 * Time: 14:38
 */

namespace AppBundle\Services;


use Doctrine\ORM\EntityManager;
use AppBundle\Model\NotificationModel;

class EvaluationSenderService
{

    protected $evaluationService;
    protected $mailGroupService;
    protected $mailNotifierService;
    protected $em;
    protected $notifications;
    private $notification;

    public function __construct(EvaluationService $evaluationService, MailGroupService $mailGroupService, MailNotifierService $mailNotifierService,EntityManager $em, $notifications)
    {
        $this->evaluationService = $evaluationService;
        $this->mailGroupService = $mailGroupService;
        $this->mailNotifierService = $mailNotifierService;
        $this->em = $em;
        $this->notifications = $notifications;
    }

    public function initNotification($notifierId)
    {
        if(!isset($this->notifications[$notifierId]))
        {
            throw new \InvalidArgumentException('La notification demandée n\'existe pas');
        }

        $notificationArray = $this->notifications[$notifierId];

        $notification = new NotificationModel();
        $notification->setId($notifierId);
        $notification->setLabel($notificationArray['label']);
        $notification->setSubject($notificationArray['subject']);
        $notification->setBodyTemplate($notificationArray['template']);
        $notification->setConditions($notificationArray['conditions']);
        $notification->setRoles($notificationArray['roles']);
        $this->notification = $notification;

    }

    public function sendEvaluations($userIds = [])
    {

        $this->mailNotifierService->setSubject($this->notification->getSubject());

        foreach ($userIds as $userId)
        {
            $evaluations = $this->evaluationService->getEvaluationByUser($userId,$this->notification->getConditions());
            //@todo render an table of evaluations

    //            ->setSubject($this->notification->getSubject())
            $this->mailNotifierService->send();

        }
    }


    private function handleTemplate($data = [])
    {
        $template = $this->notification->getBodyTemplate();
        $renderedText = $template;
        if(!empty($data))
        {
            foreach($data as $keyword => $value)
            {
                $renderedText = preg_replace('/{'.$keyword.'}/',$value,$renderedText);
            }
        }
        return $renderedText;
    }


}