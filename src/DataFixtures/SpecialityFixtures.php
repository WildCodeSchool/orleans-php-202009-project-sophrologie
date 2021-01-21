<?php

namespace App\DataFixtures;

use App\Entity\Speciality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpecialityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $speciality1 = new Speciality();
        $speciality1->setTitle('Mieux vivre au quotidien');
        $speciality1->getDescription('En savoir plus: Apprendre à mieux gérer vos émotions, 
        tout particulièrement le stress ou l\'anxiété afin de retrouver un état de bien-être au quotidien.');
        $manager->persist($speciality1);

        $speciality2 = new Speciality();
        $speciality2->setTitle('Admin');
        $speciality2->getDescription('En savoir plus: Apprendre à mieux gérer vos émotions,
         tout particulièrement le stress ou l\'anxiété afin de retrouver un état de bien-être au quotidien.');

        $manager->persist($speciality2);

        $speciality3 = new Speciality();
        $speciality3->setTitle('Admin');
         $speciality3->getDescription('En savoir plus: Apprendre à mieux gérer vos émotions, 
         tout particulièrement le stress ou l\'anxiété afin de retrouver un état de bien-être au quotidien.');

        $manager->persist($speciality3);

        $manager->flush();
    }
}
