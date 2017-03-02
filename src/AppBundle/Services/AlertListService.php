<?php

namespace AppBundle\Services;

use AppBundle\Entity\Survey;
use AppBundle\Entity\SurveyCollaborateur;
use AppBundle\Services\MailNotifierService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AlertListService
{
    private $mailNotifierService;
    private $container;

    public function __construct(MailNotifierService $mailNotifierService, ContainerInterface $container)
    {
        $this->mailNotifierService = $mailNotifierService;
        $this->container = $container;
    }

    public  function notifyEvalExceededCollaborateur()
    {
        $entity_manager = $this->container->get('doctrine')->getEntityManager();
        $all_collaborateur = $entity_manager->getRepository('AppBundle:Collaborateur')->getAllCollaboratorForEvalExceeded();
        if(is_array($all_collaborateur) && !empty($all_collaborateur))
        {
            $list_mails = $entity_manager->getRepository('AppBundle:MailList')->findAll();
            foreach ($list_mails as $mail) {
                $this->mailNotifierService->appendReceiver($mail->getEmail());
            }

            $this->mailNotifierService->setSubject('Liste des collaborateurs avec évaluation dépassée');
            $contenu = $this->container->get('templating')->render('collaborateur/eval_exceeded.html.twig', array(
                'all_collaborateur' => $all_collaborateur
            ));
            $this->mailNotifierService->setBody($contenu);
            $this->mailNotifierService->send();

            $all_commercial = $entity_manager->getRepository('UserBundle:User')->findByRole('ROLE_COMMERCIAL', 'ROLE_RESPONSABLE_AGENCE');
            if (is_array($all_commercial) && !empty($all_commercial)) {
                foreach ($all_commercial as $commercial) {
                    $all_collaborateur = $entity_manager->getRepository('AppBundle:Collaborateur')->getAllCollaboratorForEvalExceededByUser($commercial->getId());
                    if (is_array($all_collaborateur) && !empty($all_collaborateur)) {
                        $contenu = $this->container->get('templating')->render('collaborateur/eval_exceeded.html.twig', array(
                            'all_collaborateur' => $all_collaborateur
                        ));
                        $recievers = array();
                        $receivers[] = $commercial->getEmail();
                        $this->mailNotifierService->setReceivers($recievers);
                        $this->mailNotifierService->setBody($contenu);
                        $this->mailNotifierService->send();
                    }
                }
            }
        }
    }

    public  function notifyEvalExceededCustomer()
    {
        $entity_manager = $this->container->get('doctrine')->getEntityManager();
        $all_customer = $entity_manager->getRepository('AppBundle:Customer')->getAllCustomerForEvalExceeded();

        if(is_array($all_customer) && !empty($all_customer))
        {
            $list_mails = $entity_manager->getRepository('AppBundle:MailList')->findAll();
            foreach ($list_mails as $mail) {
                $this->mailNotifierService->appendReceiver($mail->getEmail());
            }

            $this->mailNotifierService->setSubject('Liste des clients avec évaluation dépassée');
            $contenu = $this->container->get('templating')->render('customer/eval_exceeded.html.twig', array(
                'all_customer' => $all_customer
            ));
            $this->mailNotifierService->setBody($contenu);
            $this->mailNotifierService->send();

            $all_commercial = $entity_manager->getRepository('UserBundle:User')->findByRole('ROLE_COMMERCIAL', 'ROLE_RESPONSABLE_AGENCE');
            if (is_array($all_commercial) && !empty($all_commercial)) {
                foreach ($all_commercial as $commercial) {
                    $all_customer = $entity_manager->getRepository('AppBundle:Customer')->getAllCustomerForEvalExceededByUser($commercial->getId());
                    if (is_array($all_customer) && !empty($all_customer)) {
                        $contenu = $this->container->get('templating')->render('customer/eval_exceeded.html.twig', array(
                            'all_customer' => $all_customer
                        ));
                        $recievers = array();
                        $receivers[] = $commercial->getEmail();
                        $this->mailNotifierService->setReceivers($recievers);
                        $this->mailNotifierService->setBody($contenu);
                        $this->mailNotifierService->send();
                    }
                }
            }
        }
    }

}