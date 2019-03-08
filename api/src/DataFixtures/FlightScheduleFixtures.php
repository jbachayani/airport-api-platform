<?php

namespace App\DataFixtures;

use App\Entity\Aircraft;
use App\Entity\Airport;
use App\Entity\FlightSchedule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class FlightScheduleFixtures extends Fixture implements DependentFixtureInterface
{
    const QT = 800;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $listState = array('', '');
        $aircrafts = $manager->getRepository(Aircraft::class)->findAll();
        $airports = $manager->getRepository(Airport::class)->findAll();

        for ($i = 0; $i < self::QT; $i++) {
            $flight = new FlightSchedule();
            $flight->setCode($faker->unique()->regexify('[A-Z]{2}[0-9]{5}'));
            $flight->setState($faker->randomElement($listState));
            $flight->setDepertureDate($faker->dateTime);
            $flight->setArrivalDate($faker->dateTime);
            $flight->setAircraft($faker->randomElement($aircrafts));
            $flight->setTimeOfFlying($faker->numberBetween($min = 0, $max = 86400));
            $manager->persist($flight);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AircraftFixtures::class,
            AirportFixtures::class
        ];
    }
}
