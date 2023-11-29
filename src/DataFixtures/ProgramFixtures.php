<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAM = [
        'Walking dead' => [
            'category' => 'category_Action',
            'synopsis' => 'Des zombies envahissent la terre',
            'poster' => 'assets/images/Walking-dead.jpg'
        ],
        'The Haunting Of Hill House' => [
            'category' => 'category_Horreur',
            'synopsis' => 'Des frères et soeurs reviennent dans la maison de leur enfance',
            'poster' => 'assets/images/The-Haunting-Of-Hill-House.webp'
        ],
        'American Horror Story' => [
            'category' => 'category_Horreur',
            'synopsis' => 'Une famille qui emménage dans une maison hantée',
            'poster' => 'assets/images/American-Horror-Story.jpg'
        ],
        'Love Death And Robots' => [
            'category' => 'category_Science-fiction',
            'synopsis' => 'Différentes histoires qui se passent dans le futur',
            'poster' => 'assets/images/love-dead-robot.jpg'
        ],
        'Penny Dreadful' => [
            'category' => 'category_Fantastique',
            'synopsis' => 'Des personnages de la littérature fantastique se retrouvent',
            'poster' => 'assets/images/Penny-dreadul.webp'
        ],
        'Fear The Walking Dead' => [
            'category' => 'category_Horreur',
            'synopsis' => 'La série se passe au tout début de l\'épidémie',
            'poster' => 'assets/images/fear the walking dead.jpg'
        ],
        'Breaking Bad' => [
            'category' => 'category_Thriller',
            'synopsis' => 'Un professeur de chimie qui fabrique de la drogue',
            'poster' => 'assets/images/Breaking-Bad.jpg'
        ],
        'The Office' => [
            'category' => 'category_Comédie',
            'synopsis' => 'Les employés d\'une entreprise de vente de papier',
            'poster' => 'assets/images/the-office.jpg'
        ],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAM as $title => $data) {
            $program = new Program();
            $program->setTitle($title);
            $program->setSynopsis($data['synopsis']);
            $program->setCategory($this->getReference($data['category']));
            $program->setPoster($data['poster']);
            $manager->persist($program);
            $this->addReference($title, $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }


}

