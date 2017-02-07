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

    public function __construct(Swift_Mailer $mailer,Logger $logger)
    {
        $this->receivers = [];
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    public function send()
    {

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