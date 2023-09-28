<?php

namespace App\Controller;

use App\Entity\Challenges;
use App\Entity\UsersChallenges;
use App\Form\Type\ChallengeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    #[Route('/', name:"homepage")]

    public function generateChallenge(){

        $challenge = $this->getDoctrine()->getRepository(Challenges::class)->find(20);
        $user = $this->getUser();

        // $userChallenge = new UsersChallenges;

        // $userChallenge->setChallenge($challenge);
        // $userChallenge->setUser($user);
        // $userChallenge->setStatus(0);

        // $em = $this->getDoctrine()->getManager();
        // $em->persist($userChallenge);
        // $em->flush();

        $allUserChallenge = $user->getUsersChallenges();
        dump($allUserChallenge->getSnapshot());
        die;

        return $this->render('home/home.html.twig', [
            "challenges" => "tst"
        ]);
    }
}