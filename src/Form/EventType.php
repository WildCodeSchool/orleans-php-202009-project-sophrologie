<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Event;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            ->add('pictureFile', VichImageType::class, [
                'required'      => false,
                'label' => false,
                'attr' => ['placeholder' => 'Sélectionner un fichier'],
                      ])
            ->add('eventdate', DateType::class, [
                'label' => 'Date de la manifestation',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false,
            ])

            ->add('category', EntityType::class, [
                'label' => 'Categorie',
                'class' => Category::class,
                'choice_label' => 'name',

                 ])

            ->add('summary', TextareaType::class, [
                'label' => 'Résumé',
                'required' => false,
                'attr' => [
                    'placeholder' => 'résumé de l\'article que vous souhaitez publier',
                ],
            ])
            ->add('article', CKEditorType::class, [
                'label' => 'Article',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Vous pouvez saisir ici le texte de l\'article que vous souhaitez publier',
                ],
            ])
            ->add('date', DateType::class, [
                'label' => 'Date de publication',
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
            ])
        ->add('archive', ChoiceType::class, [
        'choices' => [
            'Archive' => '1',
            'En ligne' => '0',
          ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
