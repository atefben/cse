<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 10/02/17
 * Time: 11:03
 */

namespace AppBundle\Services;

/**
 * Class MailGroupService
 * @package AppBundle\Services
 */
class MailGroupService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $mailGroupId
     */
    public function getMailGroupReceivers($mailGroupId)
    {
        $receivers = [];
        $mailGroup  = $this->em->getRepository('AppBundle:MailGroup')->find($mailGroupId);
        foreach ($mailGroup->getUsers as $user)
        {
            if($user->getFirstName() === null && $user->getLastName() === null)
            {
                $receiver = $user->getEmail();
            }
            else
            {
                $receiver = $user->getFirstName().' '. $user->getLastName().' <'.$user->getEmail().'>';
            }
            array_push($receivers,$receiver);
        }
        return $receivers;
    }

    public function getUsersMails($userIds = [])
    {
        $receivers = [];
        $users  = $this->em->getRepository('UserBundle:User')->find($userIds);
        foreach ($users as $user)
        {
            if($user->getFirstName() === null && $user->getLastName() === null)
            {
                $receiver = $user->getEmail();
            }
            else
            {
                $receiver = $user->getFirstName().' '. $user->getLastName().' <'.$user->getEmail().'>';
            }
            array_push($receivers,$receiver);
        }
        return $receivers;
    }

    /**
     * @param $userId
     */
    public function getUserMailGroups($userId)
    {
        $user = $this->em->getRepository('UserBundle:User')->find($userId);
        return $user->getMailGroups();
    }


    /**
     * @param $mailGroup
     * @param $userId
     */
    public function appendUserToMailGroup($mailGroup,$userId)
    {

    }

    /**
     * @param $mailGroup
     * @param $userId
     */
    public function removeUserToMailGroup($mailGroup,$userId)
    {

    }
}