<?php

// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;

class profileController extends AbstractController
{
    /**
     * @Route("/profil", name="app_profil")
     */
    public function showinformation(){
            $user = $this->getDoctrine()->getRepository(User::class)->findAll();
            $em = $this->getDoctrine()->getManager();
            $em->flush();

        return $this->render('profil/profil.html.twig', [
            'user' => $user
        ]);
    }
       
}
