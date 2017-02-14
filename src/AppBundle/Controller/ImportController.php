<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 07/02/17
 * Time: 13:44
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Collaborateur;

use AppBundle\Entity\Customer;

/**
 * Class ImportController
 * @package AppBundle\Controller
 * @Route("/import",name="import_routes")
 */
class ImportController extends Controller
{
    /**
     * Allows to import collaborateurs from Everwin.
     *
     * @Route("/collaborateur", name="import_collaborateur")
     * @Method({"GET","POST"})
     */
    public function importCollaborateurAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\ImportEverwinFileType');
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $repositoryUser = $this->getDoctrine()->getRepository('UserBundle:User');
        $repositoryCollab = $this->getDoctrine()->getRepository('AppBundle:Collaborateur');


        if ($form->isSubmitted() && $form->isValid()) 
        {

            $file = $form->get('file_to_import')->getData();
            $fileName = $this->get('app.file_upload_handler')->upload($file);
            $csvParser = $this->get('app.csv_parser');
            $collaborateurs = $csvParser->convert($this->getParameter('parsed_files_directory').DIRECTORY_SEPARATOR.$fileName);
            //@todo handle collaborateurs upsert
            foreach ($collaborateurs as $collaborateur)
            {
                try {
                    //$explode = explode(';', str_replace('"', '', $collab));
                    $getCollab =  $repositoryCollab->findByCode($collaborateur['Code']);
                    $getUser =  $repositoryUser->findByCodeSX($collaborateur['Responsable']);
                    if(!$getCollab) {
                        $getCollab = new Collaborateur();
                    } else {
                        $getCollab = $getCollab[0];
                    }

                    $getCollab->setCode($collaborateur['Code']);
                    $getCollab->setFirstname($collaborateur['Nom']);
                    $getCollab->setLastname($collaborateur['Prénom']);

                    if($getUser) {
                       
                        $getCollab->setUser($getUser[0]);
                    }

                    $getCollab->setPhone($collaborateur['Mobile']);
                    $getCollab->setEmail($collaborateur['E-mail']);

                    $em->persist($getCollab);
                    $em->flush();
                } catch(\Exception $e) {


                    $this->addFlash(
                        'error',
                        'Problème dans le fichier : '.$e->getMessage()
                    );
                    return $this->redirectToRoute('import_collaborateur');
                    //var_dump($e->getMessage()); die;
                } 


               
            }

            $this->addFlash(
            'notice',
            'L\'Import s\'est bien passé !'
        );

            unlink($this->getParameter('parsed_files_directory').DIRECTORY_SEPARATOR.$fileName);
            return $this->redirectToRoute('import_collaborateur');
 
        }
       
        $lists = $repositoryCollab->findAll();
        return $this->render('import/importCollaborateur.html.twig', array(
            'file_form' => $form->createView(),
            'lists'=> $lists
        ));

    }

    /**
     * Allows to import customers from Everwin.
     *
     * @Route("/customer", name="import_customer")
     * @Method({"GET","POST"})
     */
    public function importCustomerAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\ImportEverwinFileType');
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $repositoryUser = $this->getDoctrine()->getRepository('UserBundle:User');
        $repositoryCustomer = $this->getDoctrine()->getRepository('AppBundle:Customer');


        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('file_to_import')->getData();
            $fileName = $this->get('app.file_upload_handler')->upload($file);
            $csvParser = $this->get('app.csv_parser');
            $customers = $csvParser->convert($this->getParameter('parsed_files_directory').DIRECTORY_SEPARATOR.$fileName);
            //@todo handle collaborateurs upsert
            foreach ($customers as $customer)
            {
                try {
                    $getCustomer =  $repositoryCustomer->findByCodeSX($customer['Code']);
                    $getUser =  $repositoryUser->findByCodeSX($customer['Chargé de compte']);
                    if(!$getCustomer) {
                        $getCustomer = new Customer();
                    } else {
                        $getCustomer = $getCustomer[0];
                    }

                    $getCustomer->setCodeSX($customer['Code']);
                    $getCustomer->setName($customer['Raison sociale']);
                    $getCustomer->setAddress($customer['Adresse']);

                    if($getUser) {
                       
                        $getCustomer->setUser($getUser[0]);
                    }

                    $getCustomer->setZipCode($customer['Code postal']);
                    $getCustomer->setCity($customer['Ville']);

                    $em->persist($getCustomer);
                    $em->flush();
                    } catch(\Exception $e) {


                    $this->addFlash(
                        'error',
                        'Problème dans le fichier : '.$e->getMessage()
                    );
                    return $this->redirectToRoute('import_collaborateur');
                    //var_dump($e->getMessage()); die;
                } 
            }

$this->addFlash(
            'notice',
            'L\'Import s\'est bien passé !'
        );
            unlink($this->getParameter('parsed_files_directory').DIRECTORY_SEPARATOR.$fileName);
    
            return $this->redirectToRoute('import_customer');
 
        }

        $lists = $repositoryCustomer->findAll();
        return $this->render('import/importCustomer.html.twig', array(
            'file_form' => $form->createView(),
            'lists' =>$lists
        ));
    }
}