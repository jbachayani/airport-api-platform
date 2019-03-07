<?php

namespace App\DataFixtures;

use App\Entity\Airline;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AirlineFixtures extends Fixture
{
    const QT = 100;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 personnes
        for ($i = 0; $i < self::QT; $i++) {
            $airline = new Airline();
            $airline->setName($faker->name);
            $airline->setAddress($faker->address);
            $airline->setActive($faker->boolean);
            $airline->setCode($faker->regexify('[A-Z]{3}'));
            $airline->setCreationDate($faker->dateTime);
            $manager->persist($airline);
        }

        $manager->flush();
    }
}
