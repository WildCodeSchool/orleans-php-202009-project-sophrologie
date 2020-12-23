<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchEventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('searchcategory', ChoiceType::class, [
                'choices' =>
                    [
                        'Enregistrements' => 'Enregistrements',
                        'Evèvements' => 'Evènements',
                        'Actualités' => 'Actualités',
                    ],
                'label' => 'Recherche par catégorie',
                'multiple' => true,
                'by_reference' => false,
                'expanded' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
