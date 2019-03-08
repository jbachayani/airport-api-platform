<?php

namespace App\DataFixtures;

use App\Entity\Airport;
use App\Entity\Passenger;
use App\Entity\PassengerHasFlight;
use App\Entity\Seat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PassengerHasFlightFixtures extends Fixture implements DependentFixtureInterface
{
    const QT = 800;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $passengers = $manager->getRepository(Passenger::class)->findAll();
        $airports = $manager->getRepository(Airport::class)->findAll();
        $seats = $manager->getRepository(Seat::class)->findAll();

        for ($i = 0; $i < self::QT; $i++) {
            $pasHasFlight = new PassengerHasFlight();
            $manager->persist($pasHasFlight);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AirportFixtures::class,
            SeatFixtures::class,
            PassengerFixtures::class
        ];
    }
}
