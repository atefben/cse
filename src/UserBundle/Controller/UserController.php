<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class UserController extends Controller
{

    public function IndexAction()
    {
       // die('ici');
    	return $this->render('EvalBundle:Default:index.html.twig');
    }
}