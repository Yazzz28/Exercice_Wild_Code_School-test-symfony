<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //Puis ici nous demandons à la Factory de nous fournir un Faker
        $faker = Factory::create();

        /**
        * L'objet $faker que tu récupère est l'outil qui va te permettre 
        * de te générer toutes les données que tu souhaites
        */

        for($i = 0; $i < 5000; $i++) {
            $episode = new Episode();
            //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
            $episode->setTitle($faker->sentence());
            $episode->setNumber($faker->numberBetween(1, 10));
            $episode->setSynopsis($faker->paragraphs(3, true));
            $episode->setSeason($this->getReference('season_' . rand(0,499)));
            $manager->persist($episode);
            $this->addReference('episode_' . $i, $episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
            ProgramFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
