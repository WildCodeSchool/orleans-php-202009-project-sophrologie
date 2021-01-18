<?php

namespace App\DataFixtures;

use App\Entity\Price;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class PriceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 5; $i++) {
            $prices = new Price();
            $prices->setName($faker->text(15));
            $prices->setPrice($faker->numberBetween(30, 230));
            $prices->setDescription($faker->text(50));
            $manager->persist($prices);
        }
        $manager->flush();
    }
}
