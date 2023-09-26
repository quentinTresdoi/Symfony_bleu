<?php 

namespace App\Controller;

use App\Entity\Challenges;
use App\Form\Type\ChallengeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController{
    
    #[Route("/admin",name:"admin_panel")]

    public function new(Request $request){
        
        $challenge = new Challenges();

        $form = $this->createForm(ChallengeType::class,$challenge);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($challenge);
            $em->flush();

        }

        return $this->render('admin.html.twig', [
            'addTask' => $form->createView()
        ]);

    }


}