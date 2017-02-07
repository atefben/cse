<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class UserController extends Controller
{

    public function IndexAction()
    {
    	return $this->render('base.html.twig');
    }
}