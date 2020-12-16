<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('phone', TextType::class)
            ->add('email', EmailType::class)
            ->add('theme', ChoiceType::class, [
                'choices' => [
                    'Sélectionnez un thème' => 'ChoiceSelect',
                    'Je souhaite obtenir des informations supplémentaires' => 'Demande d\'informations',
                    'Je suis une entreprise (demande de devis personnalisé)' => 'Demande de devis',
                    'Je souhaite prendre RDV' => 'Prise de RDV',
                    'Autre thème' => 'Autre sujet'
                    ]
                ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Saisissez votre message...',
                ]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
