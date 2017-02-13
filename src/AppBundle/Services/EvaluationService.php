<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 10/02/17
 * Time: 11:38
 */

namespace AppBundle\Services;


use AppBundle\Entity\MailGroup;
use AppBundle\Entity\Survey;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Role\Role;
use UserBundle\Entity\User;

class EvaluationService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * This function allows to get evaluations depending on user's role and perimeters
     *
     * @param $userId
     * @return array
     * @throws \Exception
     */
    public function getEvaluationByUser($userId,$conditions = [])
    {
        $evaluations = [];
        $user = $this->em->getRepository(User::class)->find($userId);

        $userIds = [];
        $userIds[] = $user->getId();
;
        if(in_array('ROLE_ADMIN',$user->getRoles()) ||in_array('ROLE_SUPER_ADMIN',$user->getRoles()))
        {
            $userIds[] = $user->getId();
        }

        elseif(in_array('ROLE_RESPONSABLE_AGENCE',$user->getRoles()))
        {
            $userIds[] = $user->getId();
            $affectedUsersToRa = $this->em->getRepository(UserBundle::class)->findBy(['managedBy'=>$userId]);

        }

        elseif(in_array('ROLE_COMMERCIAL',$user->getRoles()))
        {
            //
        }
        else
        {
            throw new \Exception('Vous n\'etes pas autorisé à voir les évaluations');
        }

        $evaluations = $this->em->getRepository(Survey::class)->getSurveysByUserIds($userIds,$conditions);

        return $evaluations;
    }
}