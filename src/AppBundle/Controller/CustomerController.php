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
        $em = $this->getDoctrine()->getManager();

        $idUser = $this->getUser()->getId();

        $TabTwig = array();


        if ($this->getUser()->getRoles()[0] == "ROLE_RESPONSABLE_AGENCE") {
            $MyCustomers = $em->getRepository('AppBundle:Customer')->findBy(['user'=>$idUser]);
            $TabTwig['MyCustomers'] =  $MyCustomers;


            $ListCustomerForBusiness = $MyCustomers = $em->getRepository('AppBundle:Customer')->getCustomerForBusiness($idUser);
            $TabTwig['ListCustomerForBusiness'] =  $ListCustomerForBusiness;

        } else if ($this->getUser()->getRoles()[0] == "ROLE_ADMIN" ||$this->getUser()->getRoles()[0] == "ROLE_SUPER_ADMIN") {

            $MyCustomers = $em->getRepository('AppBundle:Customer')->findAll();
            $TabTwig['MyCustomers'] =  $MyCustomers;

        } else {
            $MyCustomers = $em->getRepository('AppBundle:Customer')->findBy(['user'=>$idUser]);
            $TabTwig['MyCustomers'] =  $MyCustomers;


        }

        return $this->render('customer/index.html.twig', $TabTwig);
    }

    /**
     * Finds and displays a customer entity.
     *
     * @Route("/{id}", name="customer_show")
     * @Method("GET")
     */
    public function showAction(Customer $customer)
    {
        //$deleteForm = $this->createDeleteForm($customer);
        $em = $this->getDoctrine()->getManager();
        $lists = $em->getRepository('AppBundle:Survey')->findBy(['customer' => $customer->getId()]);

        return $this->render('customer/show.html.twig', array(
            'customer' => $customer,
            'lists' => $lists,
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
        $deleteForm = $this->createDeleteForm($customer);
        $editForm = $this->createForm('AppBundle\Form\CustomerType', $customer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('customer_edit', array('id' => $customer->getId()));
        }

        return $this->render('customer/edit.html.twig', array(
            'customer' => $customer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a customer entity.
     *
     * @Route("/{id}", name="customer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Customer $customer)
    {
        $form = $this->createDeleteForm($customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($customer);
            $em->flush($customer);
        }

        return $this->redirectToRoute('customer_index');
    }

    /**
     * Creates a form to delete a customer entity.
     *
     * @param Customer $customer The customer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Customer $customer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('customer_delete', array('id' => $customer->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
