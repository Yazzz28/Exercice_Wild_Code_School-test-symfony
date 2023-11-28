<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Horreur',
        'Science-fiction',
        'Fantastique',
        'Policier',
        'Aventure',
        'Romance',
        'Historique',
        'Thriller',
        'Comédie',
        'Drame',
        'Documentaire',
        'Biographie',
        'Autobiographie',
        'Essai',
        'Poésie',
        'Théâtre',
        'Nouvelle',
        'Conte',
        'Fable',
        'Légende',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);

            $manager->persist($category);
        }

        $manager->flush();
    }
}