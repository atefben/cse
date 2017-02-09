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


        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('file_to_import')->getData();
            $fileName = $this->get('app.file_upload_handler')->upload($file);
            $csvParser = $this->get('app.csv_parser');
            $collaborateurs = $csvParser->convert($this->getParameter('parsed_files_directory').DIRECTORY_SEPARATOR.$fileName);
            //@todo handle collaborateurs upsert
            

            
            
            foreach ($collaborateurs as $collaborateur)
            {
                foreach ($collaborateur as $collab)
                {
                    $explode = explode(',', str_replace('"', '', $collab));
                    $getCollab =  $repositoryCollab->findByCode($explode[0]);
                    $getUser =  $repositoryUser->findByCodeSX($explode[3]);
                    if(!$getCollab) {
                        $getCollab = new Collaborateur();
                    } else {
                        $getCollab = $getCollab[0];
                    }

                    $getCollab->setCode($explode[0]);
                    $getCollab->setFirstname($explode[1]);
                    $getCollab->setLastname($explode[2]);

                    if($getUser) {
                       
                        $getCollab->setUser($getUser[0]);
                    }

                    $getCollab->setPhone($explode[4]);
                    $getCollab->setEmail($explode[5]);

                    $em->persist($getCollab);
                    $em->flush();
                }   
               
            }

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

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('file_to_import')->getData();
            $fileName = $this->get('app.file_upload_handler')->upload($file);
            $csvParser = $this->get('app.csv_parser');
            $collaborateurs = $csvParser->convert($this->getParameter('parsed_files_directory').DIRECTORY_SEPARATOR.$fileName);
            //@todo handle collaborateurs upsert
            foreach ($collaborateurs as $collaborateur)
            {
                //@upsert collaborateurs
            }
            dump($collaborateurs);
//            return $this->redirectToRoute('import_collaborateur');
        }

        return $this->render('import/importCustomer.html.twig', array(
            'file_form' => $form->createView()
        ));
    }
}