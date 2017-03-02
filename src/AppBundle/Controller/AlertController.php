<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Collaborateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Collaborateur controller.
 *
 * @Route("alert")
 */
class AlertController extends Controller
{
    /**
     * Lists all collaborateur for evaluation.
     *
     * @Route("/collaborateur/", name="alert_collaborateur_index")
     * @Method("GET")
     */
    public function indexCollaborateurAction()
    {
        $em = $this->getDoctrine()->getManager();

        $idUser = $this->getUser()->getId();

        $TabTwig = array();


        if ($this->getUser()->getRoles()[0] == "ROLE_RESPONSABLE_AGENCE") {
            $collaborateurs = $em->getRepository('AppBundle:Collaborateur')->getCollaboratorForBusinessForAlertEvalByUser($idUser);
            $TabTwig['collaborateurs'] = $collaborateurs;


            $ListCustomerForBusiness = $MyCustomers = $em->getRepository('AppBundle:Collaborateur')->getCollaboratorForBusinessForAlertEval($idUser);
            $TabTwig['ListCollaborateurForBusiness'] = $ListCustomerForBusiness;

        } else if ($this->getUser()->getRoles()[0] == "ROLE_ADMIN" || $this->getUser()->getRoles()[0] == "ROLE_SUPER_ADMIN") {

            $collaborateurs = $em->getRepository('AppBundle:Collaborateur')->getAllCollaboratorForAlertEval();
            $TabTwig['collaborateurs'] = $collaborateurs;

        } else {
            $collaborateurs = $em->getRepository('AppBundle:Collaborateur')->getCollaboratorForBusinessForAlertEvalByUser($idUser);
            $TabTwig['collaborateurs'] = $collaborateurs;


        }

        return $this->render('alert/index_collaborateur.html.twig', $TabTwig);
    }

    /**
     * Lists all customer for evaluation.
     *
     * @Route("/customer/", name="alert_customer_index")
     * @Method("GET")
     */
    public function indexCustomerAction()
    {
        $em = $this->getDoctrine()->getManager();

        $idUser = $this->getUser()->getId();

        $TabTwig = array();


        if ($this->getUser()->getRoles()[0] == "ROLE_RESPONSABLE_AGENCE") {
            $collaborateurs = $em->getRepository('AppBundle:Customer')->getCustomerForBusinessForAlertEvalByUser($idUser);
            $TabTwig['customers'] = $collaborateurs;


            $ListCustomerForBusiness = $MyCustomers = $em->getRepository('AppBundle:Customer')->getCustomerForBusinessForAlertEval($idUser);
            $TabTwig['ListCustomerForBusiness'] = $ListCustomerForBusiness;

        } else if ($this->getUser()->getRoles()[0] == "ROLE_ADMIN" || $this->getUser()->getRoles()[0] == "ROLE_SUPER_ADMIN") {

            $collaborateurs = $em->getRepository('AppBundle:Customer')->getAllCustomerForAlertEval();
            $TabTwig['customers'] = $collaborateurs;

        } else {
            $collaborateurs = $em->getRepository('AppBundle:Customer')->getCustomerForBusinessForAlertEvalByUser($idUser);
            $TabTwig['customers'] = $collaborateurs;


        }

        return $this->render('alert/index_customer.html.twig', $TabTwig);
    }
}