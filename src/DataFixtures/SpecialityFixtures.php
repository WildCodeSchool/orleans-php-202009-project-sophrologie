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
        $speciality1->setDescription(' 
Gérer son stress, son anxiété 
Canaliser ses émotions 
Évacuer ses tensions
Dormir en toute sérénité
');
        $speciality1->setImage('1');
        $manager->persist($speciality1);

        $speciality2 = new Speciality();
        $speciality2->setTitle('Mieux être au travail ');
        $speciality2->setDescription('Rester concentré, être plus attentif
Etre plus performant au travail 
Préparer un entretien
Réussir un examen/un concours  ');
        $speciality2->setImage('1');
        $manager->persist($speciality2);

        $speciality3 = new Speciality();
        $speciality3->setTitle('Mincir sereinement et apaiser les troubles du comportement alimentaire');
         $speciality3->setDescription('Mal-être dans son corps
Perdre du poids
Calmer vos pulsions alimentaires
Reconnaître la faim/ la satiété
Retrouver confiance en soi
');
        $speciality3->setImage('1');

        $manager->persist($speciality3);

        $manager->flush();
    }
}
