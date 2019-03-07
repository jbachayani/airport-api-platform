<?php

namespace App\DataFixtures;

use App\Entity\Seat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AircraftFixtures extends Fixture implements DependentFixtureInterface
{
    const QT = 2000;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $aircraft = $manager->getRepository(Aircraft::class)->findAll();

        for ($i = 0; $i < self::QT; $i++) {
            $seat = new Seat();
            $seat->setName($faker->regexify('[A-H]{1}[0-9]{2,3}'));
            $seat->setAircraft($faker->randomElement($aircraft));
            $manager->persist($seat);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AircraftFixtures::class,
        ];
    }


}
