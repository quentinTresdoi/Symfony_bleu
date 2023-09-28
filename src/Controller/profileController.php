<?php

// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\User;
use App\Entity\Challenges;
use App\Entity\UsersChallenges;
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
            
            $roles=$user->getRoles();
            if($roles = ["ROLE_ADMIN"]){
                $roles = 'Admin';
            }else{
                $roles = 'user';
            }
            // challenge validate
            $userchallenge= new UsersChallenges;
            // $chanllengevalid= $challenges->getUsersChallenges();
            // dump($chanllengevalid);
            // die;
            $iduser=$userchallenge->getuser();
            dump($iduser);
            die;
            
        return $this->render('profil/profil.html.twig', [
            'user' => $user,
            'role' => $roles
        ]);
    }
       
}
