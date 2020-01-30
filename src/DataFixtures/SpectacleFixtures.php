<?php

namespace App\DataFixtures;

use App\Entity\Spectacle;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class SpectacleFixtures extends Fixture
{
    const TOWNS = [
        'ORLÉANS',
        'PARIS',
        'NANTES',
        'STRASBOURG',
        'LILLE',
        'MONTPELLIER',
        'NICE',
        'TOULOUSE',
        'LYON',
        'MARSEILLE',
        'ANGERS',
        'FOIX',
        'OLIVET',
        'RENNES',
        'REIMS',
        'GRENOBLE',
        'TOULON',
        'BORDEAUX',
        'LIMOGES',
        'ANNECY',
        'METZ',
        'PERPIGNAN',
        'NANCY',
        'CAEN',
        'TOURCOING',
        'AVIGNON',
        'POITIERS',
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach (self::TOWNS as $town) {

            $spectacle = new Spectacle();
            $spectacle->setDate($faker->dateTimeBetween($startDate = 'now', $endDate = '+1 years', $timezone = null));
            $spectacle->setDescription($faker->text);
            $spectacle->setPicture('https://images.unsplash.com/photo-1542332606-b2d1c52a6c33?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1267&q=80');
            $spectacle->setPlaces(rand(20, 70));
            $spectacle->setPrice(rand(0, 25));
            $spectacle->setTown($town);
            $spectacle->setRoomAddress($faker->address);
            $manager->persist($spectacle);
        }
        $manager->flush();
    }
}
