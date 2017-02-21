<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 06/02/17
 * Time: 16:21
 */

namespace AppBundle\Services;

use Swift_Mailer;
use Monolog\Logger;

class MailNotifierService
{
    private $mailer;
    private $logger;
    private $receivers;
    private $body;
    private $subject;
    private $mailGroupService;

    public function __construct(Swift_Mailer $mailer,Logger $logger)
    {
        //$this->mailGroupService = $mailGroupService;
        $this->receivers = [];
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /**
     * @return bool
     */
    public function send()
    {
        $mailReceivers = $this->receivers;
        $message = \Swift_Message::newInstance()
            ->setSubject($this->subject)
            ->setFrom('cse@altimate.pro')
            ->setReplyTo('cse@altimate.pro','Altimate CSE')
            ->setBody($this->body,'text/html');

        $message->setTo('noreply@ltimate.pro')
            ->setBcc($mailReceivers);
        $sendedMessage = $this->mailer->send($message);
        return $sendedMessage>0;
    }

    public function appendMailGroup($mailGroupId)
    {
        $mailGroup = $this->mailGroupService->getMailGroupReceivers($mailGroupId);
        if(!is_array($mailGroup))
        {
            throw new \InvalidArgumentException('The returned parameter must be an array containing email addresses');
        }

        array_merge($this->receivers,$mailGroup);
        return $this;
    }

    public function appendReceiver($receiverMail)
    {
        array_push($this->receivers,$receiverMail);
        return $this;
    }


    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }



    /**
     * @return array
     */
    public function getReceivers()
    {
        return $this->receivers;
    }

    /**
     * @param array $receivers
     */
    public function setReceivers($receivers)
    {
        $this->receivers = $receivers;
        return $this;
    }



}