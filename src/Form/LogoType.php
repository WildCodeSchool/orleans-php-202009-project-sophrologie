<?php

namespace App\Form;

use App\Entity\Logo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class LogoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('Name', TextType::class, [
                'label' => 'Nom de l\'entreprise',
                'attr' => [
                    'placeholder' => 'Entreprise X',
                ],
            ])
            ->add('Logo', UrlType::class, [
                'label' => 'URL du logo de l\'entreprise',
                'attr' => [
                    'placeholder' => 'logo entreprise X',
                ],
            ])

            ->add('Description', TextType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'description du partenariat avec l\'entreprise X',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Logo::class,
        ]);
    }
}
