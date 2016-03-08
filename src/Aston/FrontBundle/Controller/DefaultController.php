<?php

namespace Aston\FrontBundle\Controller;

use Aston\FrontBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

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

    public function contactAction(Request $request)
    {
        // Déclaration de mon formulaire
        $form = $this->createFormBuilder(new Contact())
                ->add('name')
                ->add('email', EmailType::class)
                ->add('phone', null, [
                    'required' => false,
                    'attr' => [
                            'id' => 'form_hello',
                            'placeholder' => 'Phone',
                            'class' => 'form-control',
                        ],
                    ]
                )
                ->add('message', TextareaType::class)
                ->add('send', SubmitType::class)
                ->getForm();

        // Validation du formulaire
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($form->getData());
                $em->flush();

                $this->addFlash('success', 'Votre message a bien été envoyé');
                return $this->redirect($this->generateUrl('aston_front_homepage'));
            } else {
                $this->addFlash('danger', 'Saisie du formulaire incorrect');
            }
        }

        return $this->render('AstonFrontBundle:Default:contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function sessionWriteAction()
    {
        $session = $this->get('session');
        $session->set('name', 'SF3');

        return new Response('Writing...');
    }

    public function sessionReadAction()
    {
        /* @var $session Session */

        $session = $this->get('session');
        $name = $session->get('name');

        return new Response("Reading... $name");
    }
}
