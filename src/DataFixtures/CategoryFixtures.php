<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $category = new Category();
        $category->setName('Actualités');
        $manager->persist($category);
        $this->addReference('actualites', $category);


        $category1 = new Category();
        $category1->setName('Evènements');
        $manager->persist($category1);
        $this->addReference('evenements', $category);

        $category2 = new Category();
        $category2->setName('Enregistrements');
        $manager->persist($category2);
        $this->addReference('enregistrements', $category);


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
