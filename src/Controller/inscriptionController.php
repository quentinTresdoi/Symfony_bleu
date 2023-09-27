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
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            // ->add('Validepassword', PasswordType::class)

            ->add('save', SubmitType::class, array('label' => 'S\'inscrire'))
            ->getForm();
            print('$user');
            
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPoints(0);
            $user->setRole(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render('Inscription/pageinscription.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
