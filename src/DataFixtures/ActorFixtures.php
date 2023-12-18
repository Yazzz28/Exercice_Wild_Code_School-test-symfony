<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Actor;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * @Depends({"ProgramFixtures"})
 */
class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        /**
         * L'objet $faker que tu récupère est l'outil qui va te permettre 
         * de te générer toutes les données que tu souhaites
         */

        for ($i = 0; $i < 10; $i++) {
            $actor = new Actor();
            //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
            $actor->setName($faker->name());
            $actor->setAvatar($faker->imageUrl(640, 480));
            $manager->persist($actor);
            $this->addReference('actor_' . $i, $actor);
            $actor->addProgram($this->getReference('program_' . rand(0, 2)));
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
