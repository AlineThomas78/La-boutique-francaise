<?php

namespace App\Form;

use App\Classe\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchType extends AbstractType
{   

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add( 'string', TextType::class, [
                'label' => 'Rechercher',
                'required' => 'false',
                'attr' => [
                    'placeholder' => 'Votre Recherche ...'
                ]
                ]);

            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'methode' => 'GET',
            'crsf_protection' => "false",

        ]);
    }

    public function getBlocPrefix()
    {
        return '';
    }
}