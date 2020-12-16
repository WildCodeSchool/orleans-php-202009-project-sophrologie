<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;
use Faker;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
            $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++) {
            $event = new Event();

            $event->setTitle($faker->word);
            $event->setUrl($faker->imageUrl(300, 300));
            $event->setDescription($faker->text());
            $event->setEventlink($faker->url());
            $event->setCategory($faker->Word());
            $event->setDate($faker->dateTime());
            $event->setEventdate($faker->dateTime());
            $event->setSummary($faker->text());
            $event->setArticle($faker->text());
            $event->setVideo($faker->url());
            $manager->persist($event);
        }
        $manager->flush();
    }
}
