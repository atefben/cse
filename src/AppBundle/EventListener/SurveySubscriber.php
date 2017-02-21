<?php
namespace AppBundle\EventListener;

use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyCollaborateur;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Services\SurveyNotification;
// for Doctrine 2.4: Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class SurveySubscriber implements EventSubscriber
{
    private $survyNotification;
    public function __construct(SurveyNotification $survyNotification)
    {
        $this->survyNotification = $survyNotification;
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

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Survey)
        {
            $this->survyNotification->notifyEvalCustomer($entity);
        }
        elseif ($entity instanceof SurveyCollaborateur)
        {
            $this->survyNotification->notifyEvalCollab($entity);
        }
    }
}