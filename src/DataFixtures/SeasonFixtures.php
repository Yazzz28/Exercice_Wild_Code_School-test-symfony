<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $seasonData = [
            1 => [
                'number' => 1,
                'year' => 2021,
                'description' => 'description de la saison 1 de Arcane que je n\'ai pas vu',
                'program' => 'program_Arcane',
            ],
            2 => [
                'number' => 2,
                'year' => 2022,
                'description' => 'description de la saison 2 de Arcane que je n\'ai pas vu',
                'program' => 'program_Arcane',
            ],
            3 => [
                'number' => 1,
                'year' => 2021,
                'description' => 'description de la saison 1 de Arcane que je n\'ai pas vu',
                'program' => 'program_Arcane',
            ],
            4 => [
                'number' => 2,
                'year' => 2022,
                'description' => 'description de la saison 2 de Arcane que je n\'ai pas vu',
                'program' => 'program_Arcane',
            ]
        ];

        foreach ($seasonData as $key => $data) {
            $season = new Season();
            $season->setNumber($data['number']);
            $season->setYear($data['year']);
            $season->setDescription($data['description']);
            $season->setProgram($this->getReference($data['program']));
            $manager->persist($season);
            $this->addReference('season_' . $key, $season);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
