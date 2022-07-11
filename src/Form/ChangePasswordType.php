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
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled'=> true,
            ])
            ->add('prenom', TextType::class, [
                'disabled' => true
            ])
            ->add('nom', TextType::class, [
                'disabled' => true
            ])

            ->add('old_password', PasswordType::class, [
                'mapped'=> false,
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre mot de passe actuel'
                ]
            ])

            ->add('new_password', RepeatedType::class,[
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message'=> "Vous devez répétez le même mot de passe !",
                'label' => 'Mon nouveau mot de passe',
                'required'=> true,
                'first_options' => [ 
                    'label'=> ' Votre nouveau mot de passe',
                        'attr' => [
                            'placeholder' => "Vueillez saisir votre nouveau mot de passe"
                        ]
                    ],
                'second_options'=> [
                    'label'=> 'Confirmez votre nouveau mot de passe',
                    'attr' => [
                    'placeholder' => "Vueillez conformer votre nouveau mot de passe "
                    ]
                ]
            ])

            ->add('submit', SubmitType::class,[
                'label' => "Mettre à jour "  ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
