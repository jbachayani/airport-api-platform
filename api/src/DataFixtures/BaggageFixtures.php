<?php

namespace App\DataFixtures;

use App\Entity\Baggage;
use App\Entity\FlightSchedule;
use App\Entity\Passenger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class BaggageFixtures extends Fixture implements DependentFixtureInterface
{
    const QT = 800;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $passengers = $manager->getRepository(Passenger::class)->findAll();
        $flights = $manager->getRepository(FlightSchedule::class)->findAll();

        for ($i = 0; $i < self::QT; $i++) {
            $baggage = new Baggage();
            $baggage->setFollowCode($faker->unique()->regexify('[A-Z0-9]{13}'));
            $baggage->setWeight($faker->randomFloat($nbMaxDecimals = 2, $min = 1.00, $max = 30.00));
            $manager->persist($baggage);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            FlightScheduleFixtures::class,
            PassengerFixtures::class
        ];
    }
}
