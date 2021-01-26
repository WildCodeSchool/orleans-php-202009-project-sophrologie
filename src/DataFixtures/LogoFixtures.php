<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Logo;
use Faker;

class LogoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++) {
            $logocompany = new logo();

            $logocompany->setName($faker->text(20));
            $image = 'https://loremflickr.com/g/350/250/logo';
            $logo = uniqid() . '.jpg';
            copy($image, __DIR__ . '/../../public/uploads/' . $logo);
            $logocompany->setLogo($logo);
            $logocompany->setDescription($faker->text(150));
            $manager->persist($logocompany);

            $manager->flush();
        }
    }
}
