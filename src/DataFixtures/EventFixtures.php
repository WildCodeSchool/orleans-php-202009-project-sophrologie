<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;
use Faker;

class EventFixtures extends Fixture
{

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }


    public function load(ObjectManager $manager)
    {
            $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++) {
            $event = new Event();

            $event->setTitle($faker->text(50));
            $image = 'https://loremflickr.com/g/320/240/zen';
            $picture = uniqid() . '.jpg';
            copy($image, __DIR__ . '/../../public/uploads/' . $picture);
            $event->setPicture($picture);
            $event->setDescription($faker->text(200));
            $event->setEventlink($faker->url());
            $event->setDate($faker->dateTime());
            $event->setCategory($this->getReference('actualites'));
            $event->setEventdate($faker->dateTime());
            $event->setSummary($faker->text(500));
            $event->setArticle($faker->text(1500));
            $event->setVideo($faker->url());
            $event->setArchive($faker->boolean);
            $event->setPictureFile();
            $event->setUploadedAt($faker->dateTime());
            $manager->persist($event);
        }
        $manager->flush();
    }
}
