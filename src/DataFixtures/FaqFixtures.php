<?php

namespace App\DataFixtures;

use App\Entity\Faq;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FaqFixtures extends Fixture
{

    public function getDependencies()
    {
        return [FaqFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 5; $i++) {
            $faq = new Faq();
            $faq->setSubject($faker->text);
            $faq->setFeedback($faker->text);
            $manager->persist($faq);
        }
        $manager->flush();
    }
}
