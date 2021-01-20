<?php

namespace App\DataFixtures;

use App\Entity\Testimony;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TestimonyFixtures extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $testimony = new Testimony();
            $testimony->setDescription($faker->sentence);
            $testimony->setFirtsname($faker->firstName);
            $testimony->setTitle($faker->jobTitle);
            $testimony->setAge($faker->numberBetween(9, 60));
            $testimony->setDate($faker->dateTime);
            $manager->persist($testimony);
            $this->setReference('témoignage', $testimony);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
