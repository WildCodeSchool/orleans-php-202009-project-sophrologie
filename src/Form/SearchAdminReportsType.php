<?php

namespace App\Form;

use App\Entity\SearchAdminReports;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchAdminReportsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userSelected', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'fullname',
                'multiple' => false,
                'expanded' => false,
                'required' => false,
                'label' => 'Sélectionner un patient ',
                'label_attr' => [
                    'class' => 'my-2 mr-2'
                ],
                'query_builder' => function (UserRepository $userRepository) {
                    return $userRepository->createQueryBuilder('u')
                        ->Where('u.roles LIKE :role')
                        ->setParameter('role', '%' . 'ROLE_USER' . '%')
                        ->orderBy('u.lastname', 'ASC');
                }]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'        => SearchAdminReports::class,
            'method'            => 'get',
            'csrf_protection'   => false
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
