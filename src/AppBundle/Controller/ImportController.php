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

        return $this->render('import/importCollaborateur.html.twig', array(
            'file_form' => $form->createView()
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

        return $this->render('import/importCollaborateur.html.twig', array(
            'file_form' => $form->createView()
        ));
    }
}