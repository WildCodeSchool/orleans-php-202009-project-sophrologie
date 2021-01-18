<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{

    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setFirstname('Admin');
        $admin->setLastname('Adminator');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setEmail('amdin@inspireexpire.com');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));
        $manager->persist($admin);

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFirstname('User');
            $user->setLastname('Useritor');
            $user->setEmail('user' . $i . '@inspireexpire.com');
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'contributorpassword'
            ));
            $manager->persist($user);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
         return ['group1'];
    }
}
