<?php

namespace App\Controller;

use App\Entity\Challenges;
use App\Entity\User;
use App\Entity\UsersChallenges;
use App\Form\Type\ChallengeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    public function allUserNumber()
    {
        return $this->getDoctrine()->getRepository(User::class)->getUsersCount();
    }

    public function allChallengesCreated()
    {
        return count($this->getDoctrine()->getRepository(Challenges::class)->findAll());
    }

    public function allChallengesCompleted()
    {
        return count($this->getDoctrine()->getRepository(UsersChallenges::class)->findBy(['status' => 1]));
    }

    public function allChallengesOnDoing()
    {
        return count($this->getDoctrine()->getRepository(UsersChallenges::class)->findBy(['status' => 0]));
    }

    #[Route("/admin", name: "admin_panel")]

    public function showChallenges()
    {
        $challenge = $this->getDoctrine()->getRepository(Challenges::class)->findAll();

        $em = $this->getDoctrine()->getManager();

        $em->flush();

        return $this->render('admin/admin_panel.html.twig', [
            'challenges' => $challenge,
            'allUsersNumber' => $this->allUserNumber(),
            'allChallengesCreated' => $this->allChallengesCreated(),
            'allChallengesCompleted' => $this->allChallengesCompleted(),
            'allChallengesOnDoing' => $this->allChallengesOnDoing(),
        ]);
    }

    #[Route("/admin/add-challenge", name: "admin_add_challenge")]

    public function new(Request $request)
    {

        $challenge = new Challenges();

        $form = $this->createForm(ChallengeType::class, $challenge);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($challenge);
            $em->flush();
            return $this->redirectToRoute('admin_panel');
        }

        return $this->render('admin/admin_add_task.html.twig', [
            'addTask' => $form->createView()
        ]);
    }

    #[Route("/admin/edit-challenge/{id}", name: "admin_edit_challenge")]
    public function editTask($id, Request $request)
    {

        $challengeToEdit = $this->getDoctrine()->getRepository(Challenges::class)->find($id);

        $form = $this->createForm(ChallengeType::class, $challengeToEdit);
        $e = null;

        try {
            $form->handleRequest($request);
        } catch (\Exception $e) {
            $e = "Veuillez vérifier vos champs";
        }



        if ($form->isSubmitted() && $form->isValid()) {
            $challengeToEdit = $form;
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('admin_panel');
        }


        return $this->render('admin/admin_edit_challenge.html.twig', [
            'editTask' => $form->createView(),
            'error' => $e
        ]);
    }

    #[Route("/admin/delete/{id}", name: "admin_delete_challenge")]

    public function deleteTask($id)
    {

        $taskToDelete = $this->getDoctrine()->getRepository(Challenges::class)->find($id);
        // $userChallengeToDelete = $this->getDoctrine()->getRepository(UsersChallenges::class)->findBy(['user'=> $this->getUser(),'challenge'=>$taskToDelete]);
        // $this->getUser()->removeUsersChallenge($userChallengeToDelete[0]);
        $em = $this->getDoctrine()->getManager();
        $em->remove($taskToDelete);
        $em->flush();

        return $this->redirectToRoute('admin_panel');
    }
}
