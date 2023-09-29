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

    public function challengeIsCompleted($user, $challenge){
        $userCompletedChallenge = $this->getDoctrine()->getRepository(UsersChallenges::class)->findBy(['user'=>$user, 'challenge'=>$challenge]);
        return $userCompletedChallenge;
    }

    public function challengeAlreadyCompleted($user, $challenge){
        $userAlreadyCompletedChallenge = $this->getDoctrine()->getRepository(UsersChallenges::class)->findBy(['user'=>$user, 'challenge'=>$challenge, 'status'=>1]);
        return $userAlreadyCompletedChallenge;
    }

    public function alreadyMakeChallenge(){
        $isUserchallenge = $this->getDoctrine()->getRepository(UsersChallenges::class)->findOneBy([
            'status' => '0',
            'user' => $this->getUser()
        ]);
        return $isUserchallenge;
    }

    #[Route('/challenge/{id}', name: 'challenge_details')]
    public function getChallenge($id){
        
        $challenge =  $this->getDoctrine()->getRepository(Challenges::class)->find($id);

        $userChallenge = $this->challengeIsCompleted($this->getUser(),$challenge);

        $userAlreadyCompleted = $this->challengeAlreadyCompleted($this->getUser(),$challenge);

        $userAlreadyMakeChallenge = $this->alreadyMakeChallenge();
           
        return $this->render('challenge/challenge.html.twig', [
            'challenge' => $challenge,
            'userChallenge' => $userChallenge,
            'userAlreadyCompleted' => $userAlreadyCompleted,
            'userAlreadyMakeChallenge' => $userAlreadyMakeChallenge
        ]);
    }

}