<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class ChallengeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void{
        $builder
        ->add('title', TextType::class, ['label' => 'Nom', 'required' => true])
        ->add('description', TextareaType::class, ['label' => 'Description', 'required' => true])
        ->add('points',NumberType::class, ['label' => 'Points', 'required' => true, 'invalid_message' => 'Veuillez mettre un nombre'])
        ->add('categories',TextType::class, ['label' => 'Catégorie', 'required' => true])
        ->add('submit', SubmitType::class, ['label' => 'Soumettre']);
    }
}