<?php

namespace Aston\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AstonFrontBundle:Default:index.html.twig');
    }

    public function helloAction($name)
    {
        return $this->render('AstonFrontBundle:Default:hello.html.twig', array(
            'prenom' => $name,
        ));

        // return new Response("<h1>Hello $name</h1>");
    }

    public function aboutAction()
    {
        return $this->render('AstonFrontBundle:Default:about.html.twig');
    }

    public function blogAction()
    {
        return $this->render('AstonFrontBundle:Default:blog.html.twig');
    }

    public function contactAction()
    {
        return $this->render('AstonFrontBundle:Default:contact.html.twig');
    }
}
