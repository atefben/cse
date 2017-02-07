<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class UserController extends Controller
{

    public function IndexAction()
    {

        $repository = $this->getDoctrine()->getRepository('UserBundle:User');
        $lists =  $repository->findAll();
    	return $this->render('UserBundle::index.html.twig', array('lists'=>$lists));
    }
}