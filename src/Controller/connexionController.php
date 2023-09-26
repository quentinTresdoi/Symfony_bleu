<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Challenges;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class connexionController extends AbstractController
{
    #[Route("/lucky", name:"connexion")]
    public function new(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $task = new User();
        $task->setEmail('Your Email');
        $task->setPassword(('Your Passeword'));

        $form = $this->createFormBuilder($task)
            ->add('Email', EmailType::class)
            ->add('Password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'Connexion'))
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ // test si le formulaire a été soumis et s'il est valide
            // on redirige vers la route show_task avec l'id du post créé ou modifié   
        }
        return $this->render('connexion.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    
}
