<?php

namespace App\Controller;

use App\Entity\Challenges;
use App\Entity\UsersChallenges;
use App\Form\Type\ChallengeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{
    //
    public function mapArray($element){
        return $element->getChallenge()->getId();
    }

    #[Route('/', name:"homepage")]
    public function generateChallenge(){
        $user = $this->getUser();
        $challenges = [];
        
        if ($user) {
            $allUserChallenge = $user->getUsersChallenges()->getSnapshot();

            if ($allUserChallenge) {
                $allUserChallengeId = array_map([$this, 'mapArray'],$allUserChallenge);
                $challenges = $this->getDoctrine()->getRepository(Challenges::class)->getSomesChallenges($allUserChallengeId);
            }else{
                $challenges = $this->getDoctrine()->getRepository(Challenges::class)->findAll();
            }
            
        }else{
            $challenges = $this->getDoctrine()->getRepository(Challenges::class)->findAll();
        }
        

        return $this->render('home/home.html.twig', [
            "challenges" => $challenges
        ]);
    }
}