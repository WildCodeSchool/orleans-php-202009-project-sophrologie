<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Actualité',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'description',
                'attr' => [
                    'placeholder' => 'salon du bien être',
                ],
            ])
            ->add('url', UrlType::class, [
                'label' => 'lien de l\'image',
                'attr' => [
                    'placeholder' => 'https//image.jpeg',
                ],
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'date de publication',
            ])
            ->add('category', TextType::class, [
                'label' => 'catégorie',
                'attr' => [
                    'placeholder' => 'Evènement, Actualités, Interviews',
                ],
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'résumé',
                'attr' => [
                    'placeholder' => 'résumé de l\'article que vous souhaitez publier',
                ],
            ])
            ->add('article', TextareaType::class, [
                'label' => 'article',
                'attr' => [
                    'placeholder' => 'Vous pouvez saisir ici le texte de l\'article que vous souhaitez publier',
                ],
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'date de la manifestation',
            ])
            ->add('eventlink', UrlType::class, [
                'label' => 'lien vers le site de l\'évènement',
                'attr' => [
                    'placeholder' => 'https//lien-vers-le-site-de-la-manifestation.com',
                ],
            ])
            ->add('video', UrlType::class, [
                'label' => 'lien vers une vidéo youtube de relaxation',
                'attr' => [
                    'placeholder' => 'https//lien-vers-le-site-de-la-manifestation.com',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
