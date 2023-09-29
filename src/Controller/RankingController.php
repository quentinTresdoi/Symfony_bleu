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

class RankingController extends AbstractController
{

    #[Route('/ranking', name: 'ranking')]
    public function getUsersSortedByPoints(){
        
        $allUserSortedByPoints =  $this->getDoctrine()->getRepository(User::class)->findBy([], ['points' => 'DESC'], 10);
           
        return $this->render('ranking/ranking.html.twig', [
            'allUser' => $allUserSortedByPoints
        ]);
    }

}