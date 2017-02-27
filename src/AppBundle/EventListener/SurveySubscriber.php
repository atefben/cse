<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyCollaborateur;
use AppBundle\Entity\SurveyCollaborateurCriteria;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Services\SurveyNotification;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;

// for Doctrine 2.4: Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class SurveySubscriber implements EventSubscriber
{
    private $surveyNotification;
    public function __construct(SurveyNotification $surveyNotification)
    {
        $this->surveyNotification = $surveyNotification;

    }

    public function getSubscribedEvents()
    {
        return array(
            'postPersist'
        );
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
       // $this->index($args);
    }

    /*public function postPersist(LifecycleEventArgs $args)
    {
        //$this->index($args);
    }*/

    public function postPersist(LifecycleEventArgs $args)
    {

    }

    public function notify($entity)
    {


        if ($entity instanceof Survey)
        {
            $this->surveyNotification->notifyEvalCustomer($entity);
        }
        elseif ($entity instanceof SurveyCollaborateur)
        {
            $this->surveyNotification->notifyEvalCollab($entity);
        }
    }
}