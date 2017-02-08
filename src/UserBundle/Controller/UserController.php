<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

class UserController extends Controller
{

    public function IndexAction()
    {

        $repository = $this->getDoctrine()->getRepository('UserBundle:User');
        $lists =  $repository->findAll();
    	return $this->render('UserBundle::index.html.twig', array('lists'=>$lists));
    }


    public function AddAction(Request $request) {

        $User = new User();
        $form = $this->createForm(UserType::class, $User);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($User);
            $em->flush($User);

            return $this->redirectToRoute('user_edit', array('id' => $User->getId()));
        }


        return $this->render('UserBundle::add.html.twig', array('form'=>$form->createView()));
    }

    public function EditAction(Request $request) {
        //$User = new User();
        $id = $request->get('id');

        $repository = $this->getDoctrine()->getRepository('UserBundle:User');
        $User =  $repository->find($id);

        $form = $this->createForm(UserType::class, $User);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($User);
            $em->flush($User);

            return $this->redirectToRoute('user_edit', array('id' => $User->getId()));
        }


        return $this->render('UserBundle::edit.html.twig', array('form'=>$form->createView()));
    }


    public function DeleteAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $em->getEventManager()->addEventSubscriber(new \Gedmo\SoftDeleteable\SoftDeleteableListener());

        $id = $request->get('id');

        $repository = $this->getDoctrine()->getRepository('UserBundle:User');
        $User =  $repository->find($id);

        $em->remove($User);
        $em->flush($User);

        return $this->redirectToRoute('user_list');
    }
}