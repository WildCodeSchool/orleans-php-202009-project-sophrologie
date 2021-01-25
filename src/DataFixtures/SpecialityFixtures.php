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
        $speciality1->setKeywords(' 
Gérer son stress, son anxiété 
Canaliser ses émotions 
Évacuer ses tensions
Dormir en toute sérénité
');
        $speciality1->setDescription('Apprendre à mieux gérer vos émotions, tout particulièrement le stress ou
         l\'anxiété afin de retrouver un état de bien-être au quotidien. Les origines du stress peuvent être multiples :
          un manque de confiance en soi, des difficultés d’apprentissage ou de concentration, un changement dans sa
           vie personnelle, un deuil, des troubles du sommeil…  Les symptômes du stress peuvent se manifester dans
            tout l\'organisme : une tachycardie et/ou une hypertension, des vertiges, des troubles du transit, 
            une sensation d’étouffement, de l’eczéma, des difficultés à s’endormir …');
        $manager->persist($speciality1);

        $speciality2 = new Speciality();
        $speciality2->setTitle('Mieux être au travail ');
        $speciality2->setKeywords('Rester concentré, être plus attentif
Etre plus performant au travail 
Préparer un entretien
Réussir un examen/un concours  ');
        $speciality2->setDescription('Apprendre à être plus attentif à ce que vous faites, à vivre
         dans le moment présent et à ne pas toujours être sous pression … Une pause réparatrice permet d’être
          plus performant(e), mais il faut d’abord accepter de prendre un véritable temps pour soi pour en
           ressentir plus intensément le bienfait. La sophrologie peut vous être utile en prévention d’un burn-out,
            pour vous préparer à un entretien ou pour améliorer vos chances de réussite à un concours. ');
        $manager->persist($speciality2);

        $speciality3 = new Speciality();
        $speciality3->setTitle('Mincir sereinement et apaiser les troubles du comportement alimentaire');
        $speciality3->setKeywords('Mal-être dans son corps
Perdre du poids
Calmer vos pulsions alimentaires
Reconnaître la faim/ la satiété
Retrouver confiance en soi
');
        $speciality3->setDescription('Apprendre à être plus serein(ne) avec la nourriture. 
        Vous mangez pour trouver du réconfort, vous mangez sans avoir faim ou vous pensez avoir tout 
        le temps faim. Vous n’osez plus vous regarder dans un miroir, vous n’aimez pas votre corps,
         vous ne vous acceptez pas tel que vous êtes. Si vous vous reconnaissez dans une ou même plusieurs 
         des situations citées, alors la sophrologie pourra sans doute vous aider à maitriser vos pulsions alimentaires 
         dommageables à votre équilibre nutritionnel et vous aider à mincir plus sereinement et durablement 
         en retrouvant votre droit au bien-être.
');

        $manager->persist($speciality3);

        $manager->flush();
    }
}
