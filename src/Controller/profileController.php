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
        // info user
            $user= $this->getUser();
            $challenges = [];
            
            $roles=$user->getRoles();
            if($roles = ["ROLE_ADMIN"]){
                $roles = 'Admin';
            }else{
                $roles = 'user';
            }

        if ($user) {
            $allUserChallenge = $user->getUsersChallenges()->getSnapshot();

            $allUserChallengeStatus = array_filter($allUserChallenge,[$this, 'filterArray']);
            $allUserChallengeId = array_map([$this, 'mapArray'],$allUserChallengeStatus);
            
            $challenges = $this->getDoctrine()->getRepository(Challenges::class)->getChallengesbyId($allUserChallengeId);
        }
            // tkt
        return $this->render('profil/profil.html.twig', [
            'user' => $user
        ]);
    }
       
}
