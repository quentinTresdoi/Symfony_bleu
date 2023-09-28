<?php

// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\User;
use App\Entity\Challenges;
use App\Entity\UsersChallenges;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;

class ChallengeDetailsController extends AbstractController
{

    #[Route('/challenge/{id}', name: 'challenge_details')]
    public function getChallenge($id){
        
        $challenge =  $this->getDoctrine()->getRepository(Challenges::class)->find($id);
           
        return $this->render('challenge/challenge.html.twig', [
            'challenge' => $challenge
        ]);
    }

}