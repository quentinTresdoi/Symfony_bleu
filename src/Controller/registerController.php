<?php

// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Category;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class registerController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function GenerateFormInscription(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne sont pas identiques',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_name' => 'password',
                'second_name' => 'confirm',
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])

            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'Administateur' =>"ROLE_ADMIN",
                    'Utilisateur' =>'ROLE_USER',
                ],
                'multiple' => true,
                'expanded' => true,
            ])

            ->add('save', SubmitType::class, array('label' => 'S\'inscrire'))
            ->getForm();

        $form->handleRequest($request);
        
        $e = null;

        if ($form->isSubmitted() && $form->isValid()) {

            
            $user->setPoints(0);
            
            $plaintextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $em = $this->getDoctrine()->getManager();
            try {
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute("app_login");
            } catch (\Exception $e) {
                $e = "Cet e-mail existe déjà";
            }
            
            
        }
        return $this->render('Register/register.html.twig', [
            'form' => $form->createView(),
            'error' => $e
        ]);

        // $errors = $form->getErrors();
        // if($errors = $form->getErrors(true)){
        //     return $this->render('Register/register.html.twig', ['error' => $errors]);
        //     throw new \LogicException('Your password is incorect or email incorrect.');
            
        // }
    }
}
