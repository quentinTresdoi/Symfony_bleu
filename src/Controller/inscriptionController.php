<?php

// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class inscriptionController extends AbstractController
{
    /**
     * @Route("/Inscription/pageinscription", name="app_Inscription_pageinscription")
     */
    public function GenerateFormInscription(Request $request)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('pseudo', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)

            ->add('save', SubmitType::class, array('label' => 'S\'inscrire'))
            ->getForm();

        

        $form->handleRequest($request); // hydratation du form 
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPoints(0);
            $user->setRole(0);
             // test si le formulaire a été soumis et s'il est valide
            $em = $this->getDoctrine()->getManager(); // on récupère la gestion des entités
            $em->persist($user); // on effectue les mise à jours internes
            $em->flush(); // on effectue la mise à jour vers la base de données
            
        }

        return $this->render('Inscription/pageinscription.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
