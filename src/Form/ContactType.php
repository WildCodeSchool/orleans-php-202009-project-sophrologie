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
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Olivier',
                ]])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Serre',
                ]])
            ->add('phone', TextType::class, [
                'attr' => [
                    'placeholder' => '01 02 03 04 05'
                ]])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'olivier.serre@gmail.com',
                ]])
            ->add('theme', ChoiceType::class, [
                'choices' => [
                    'Je souhaite obtenir des informations supplémentaires' => 'Demande d\'informations',
                    'Je suis une entreprise (demande de devis personnalisé)' => 'Demande de devis',
                    'Je souhaite prendre RDV' => 'Prise de RDV',
                    'Autre thème' => 'Autre sujet'
                    ]
                ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Bonjour, j\'aimerais avoir plus d\'informations au sujet de...',
                ]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
