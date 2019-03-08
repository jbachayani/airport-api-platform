<?php

namespace App\DataFixtures;

use App\Entity\Aircraft;
use App\Entity\Seat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class SeatFixtures extends Fixture implements DependentFixtureInterface
{
    const QT = 2000;
    const FLUSH_LIMIT = 200;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $aircraft = $manager->getRepository(Aircraft::class)->findAll();

        for ($i = 0; $i < self::QT; $i++) {
            $seat = new Seat();
            $seat->setName($faker->regexify('[A-H]{1}[0-9]{2,3}'));
            $seat->setAircraft($faker->randomElement($aircraft));
            $manager->persist($seat);

            // Prevent Memory error
            if ($i % self::FLUSH_LIMIT == 0) {
                $manager->flush();
            }
        }

        if (self::QT > 0 && self::QT % self::FLUSH_LIMIT != 0) {
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return [
            AircraftFixtures::class,
        ];
    }
}
