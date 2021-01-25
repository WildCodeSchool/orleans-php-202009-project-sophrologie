<?php

namespace App\Form;

use App\Entity\Speciality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecialityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Spécialité',
                'attr' => [
                    'placeholder' => 'Spécialité',
                ],
            ])
            ->add('keywords', TextType::class, [
                    'label' => 'Mots Clefs',
                    'attr' => [
                        'placeholder' => 'gestion du stress, mal être dans son corps',
                    ],
                ])
            ->add('description', TextareaType::class, [
                    'label' => 'Titre',
                    'attr' => [
                        'placeholder' => 'Apprendre à être plus attentif à ce que vous faites,
                         à vivre dans le moment présent......',
                    ],
                ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Speciality::class,
        ]);
    }
}
