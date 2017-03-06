<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Customer controller.
 *
 * @Route("customer")
 */
class CustomerController extends Controller
{
    /**
     * Lists all customer entities.
     *
     * @Route("/", name="customer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $customerManager = $this->get('cse.customer.manager');

        $tabTwig = $customerManager->getCustomers();


        return $this->render('customer/index.html.twig', $tabTwig);
    }

    /**
     * Finds and displays a customer entity.
     *
     * @Route("/{id}", name="customer_show")
     * @Method("GET")
     */
    public function showAction(Customer $customer)
    {

        $customerManager = $this->get('cse.customer.manager');

        $surveyList = $customerManager->getCustomerSurvey($customer);

        return $this->render('customer/show.html.twig', array(
            'customer' => $customer,
            'lists' => $surveyList,
        ));
    }

    /**
     * Displays a form to edit an existing customer entity.
     *
     * @Route("/{id}/edit", name="customer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Customer $customer)
    {

        $customerManager = $this->get('cse.customer.manager');

        $editForm   = $customerManager->createForm('AppBundle\Form\CustomerType', $customer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $customerManager->saveDatas();

            return $this->redirectToRoute('customer_edit', array('id' => $customer->getId()));
        }

        return $this->render('customer/edit.html.twig', array(
            'customer' => $customer,
            'edit_form' => $editForm->createView(),
        ));
    }
}
