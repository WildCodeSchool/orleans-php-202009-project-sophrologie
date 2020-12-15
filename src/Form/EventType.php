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
use Symfony\Component\Form\Extension\Core\Type\DateType;

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
                'label' => 'Description',
                'required' => false,
                'attr' => [
                    'placeholder' => 'salon du bien être',
                ],
            ])
            ->add('url', UrlType::class, [
                'label' => 'Lien de l\'image',
                'required' => false,
                'attr' => [
                    'placeholder' => 'https//image.jpeg',
                ],
            ])
            ->add('eventdate', DateType::class, [
                'label' => 'Date de publication',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false,


            ])
            ->add('category', TextType::class, [
                'label' => 'Catégorie',
                'attr' => [
                    'placeholder' => 'Evènement, Actualités, Interviews',
                ],
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'Résumé',
                'required' => false,
                'attr' => [
                    'placeholder' => 'résumé de l\'article que vous souhaitez publier',
                ],
            ])
            ->add('article', TextareaType::class, [
                'label' => 'Article',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Vous pouvez saisir ici le texte de l\'article que vous souhaitez publier',
                ],
            ])
            ->add('date', DateType::class, [
                'label' => 'Date de la manifestation',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false,
            ])
            ->add('eventlink', UrlType::class, [
                'label' => 'Lien vers le site de l\'évènement',
                'required' => false,
                'attr' => [
                    'placeholder' => 'https//lien-vers-le-site-de-la-manifestation.com',
                ],
            ])
            ->add('video', UrlType::class, [
                'label' => 'Lien vers une vidéo youtube de relaxation',
                'required' => false,
                'attr' => [
                    'placeholder' => 'https//lien-vers-la-video.com',
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
