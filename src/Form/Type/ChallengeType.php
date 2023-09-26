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
        ->add('Title', TextType::class)
        ->add('Description', TextareaType::class)
        ->add('Points',NumberType::class)
        ->add('Categories',TextType::class)
        ->add('Ajouter', SubmitType::class);
    }
}