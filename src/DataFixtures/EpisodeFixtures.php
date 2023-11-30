<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $episodesData = [
            'Arena' => [
                'Welcome to the Playground' => [
                    'season' => 1,
                    'number' => 1,
                    'synopsis' => 'description de l\'episode 1 de Arcane que je n\'ai pas vu',
                ],
                'The Duel' => [
                    'season' => 1,
                    'number' => 2,
                    'synopsis' => 'description de l\'episode 2 de Arcane que je n\'ai pas vu',
                ],
                'The Amnesiac' => [
                    'season' => 1,
                    'number' => 3,
                    'synopsis' => 'description de l\'episode 3 de Arcane que je n\'ai pas vu',
                ],
                'A Chance Encounter' => [
                    'season' => 1,
                    'number' => 4,
                    'synopsis' => 'description de l\'episode 4 de Arcane que je n\'ai pas vu',
                ],
            ],
        ];

        foreach ($episodesData as $seasonTitle => $episodes) {
            foreach ($episodes as $title => $data) {
                $episode = new Episode();
                $episode->setTitle($title);
                $episode->setNumber($data['number']);
                $episode->setSynopsis($data['synopsis']);
                $episode->setSeason($this->getReference('season' . $data['season'] .'_Arcane'));
                $manager->persist($episode);
                $this->addReference($title, $episode);
            }
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
