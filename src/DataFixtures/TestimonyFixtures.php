<?php

namespace App\DataFixtures;

use App\Entity\Testimony;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TestimonyFixtures extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $testimony = new Testimony();
        $testimony->setDescription('Actualités');
        $testimony->setFirtsname('Prénom');
        $testimony->setTitle('Titre');
        $testimony->setAge(1);
        $testimony->setDate('01-01-0000');
        $manager->persist($testimony);
        $this->addReference('actualites', $testimony);


        $testimony1 = new Testimony();
        $testimony->setDescription('Actualités');
        $testimony->setFirtsname('Prénom');
        $testimony->setTitle('Titre');
        $testimony->setAge(1);
        $testimony->setDate('01-01-0000');
        $manager->persist($testimony1);
        $this->addReference('evenements', $testimony);

        $testimony2 = new Testimony();
        $testimony->setDescription('Actualités');
        $testimony->setFirtsname('Prénom');
        $testimony->setTitle('Titre');
        $testimony->setAge(1);
        $testimony->setDate('01-01-0000');
        $manager->persist($testimony2);
        $this->addReference('enregistrements', $testimony);


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
