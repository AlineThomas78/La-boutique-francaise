<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class,[
            'label' => 'Nom' ])

        ->add('prenom', TextType::class, [
            'label' => 'Prénom' ]) 

        ->add('email', EmailType::class, [
            'label' => 'Email',
            'attr' => [
                'placeholder'=> "Veuillez saisir votre email"
            ]
        ])
            ->add('password', PasswordType::class,[
                'label'=> "Mot de passe",
                'attr'=> [
                    'placeholder' => "Veuillez saisir votre mot de passe "
                ]
            ])

            ->add('password_confirm', PasswordType::class, [
                'label' => "Confirmez votre mot de passe",
                'mapped' => false,
                'attr' => [
                    'placeholder' => "Confirmez votre mot de passe"
                ]
            ])

            ->add('submit', SubmitType::class,[
                'label' => "S'inscire"  ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
