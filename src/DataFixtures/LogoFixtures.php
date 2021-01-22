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
            $logo = new logo();

            $logo->setName($faker->text(150));
            $logo->setLogo($faker->imageUrl(50, 50));
            $logo->setDescription($faker->text(150));
            $manager->persist($logo);

            $manager->flush();
        }
    }
}
