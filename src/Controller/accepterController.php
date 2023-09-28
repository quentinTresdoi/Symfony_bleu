<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Entity\Challenges;
use App\Entity\UsersChallenges;

class accepterController extends AbstractController
{
    #[Route("/accept/{id}", name:"accepter_challenge")]
    public function acceptTask($id){ 
        $challenge = $this->getDoctrine()->getRepository(Challenges::class)->find($id);     //Récupération du challenge grâce à l'ID dans le slug
        $userchallenge = $this->getDoctrine()->getRepository(UsersChallenges::class)->findBy([      //Récupération du UserChallenge grâce au challenge et au User connecter
            'challenge' => $challenge,
            'user' => $this->getUser()
        ]);
        if ($userchallenge == null){        //Vérification si le userChallenge existe déjà
            $challengeAccepter = new UsersChallenges();     //Création du userChallenge pour le user et challenge recupérer 
            $challengeAccepter->setUser($this->getUser());
            $challengeAccepter->setChallenge($challenge);
            $em = $this->getDoctrine()->getManager();   
            $em->persist($challengeAccepter);       //Implémentation dans la BDD
            $em->flush();
            return $this->redirectToRoute('challenge_details', ['id' => $id]);          
        }
        else{
            return new Response("L'utilisateur a déjà accépter se challenge");
        }
    }
    #[Route("/valider/{id}", name:"valider_challenge")]
    public function validTask($id){
        $challenge = $this->getDoctrine()->getRepository(Challenges::class)->find($id);
        $userchallenge = $this->getDoctrine()->getRepository(UsersChallenges::class)->findOneBy([
            'challenge' => $challenge,
            'user' => $this->getUser()
        ]);
        if ($userchallenge->getStatus() == 0){            //Vérification que c'est en userChallenge en cours 
            $this->getUser()->setPoints($this->getUser()->getPoints()+$challenge->getPoints());     //ajoute les points du challenge au point du user
            $userchallenge->setStatus(1);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('homepage');            
        }
        else{
            return new Response("Erreur");
        }
    }
    
}
