<?php

namespace App\DataFixtures;

use App\Entity\FlightSchedule;
use App\Entity\Passenger;
use App\Entity\PassengerHasFlight;
use App\Entity\Seat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PassengerHasFlightFixtures extends Fixture implements DependentFixtureInterface
{
    const QT = 1500;
    const FLUSH_LIMIT = 50;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $seats = $manager->getRepository(Seat::class)->findAll();
        $passengers = $manager->getRepository(Passenger::class)->findAll();
        $flights = $manager->getRepository(FlightSchedule::class)->findAll();

        for ($i = 0; $i < self::QT; $i++) {
            $pasHasFlight = new PassengerHasFlight();
            $pasHasFlight->setSeats($faker->randomElement($seats));
            $pasHasFlight->setPassengers($faker->randomElement($passengers));
            $pasHasFlight->setFlightSchedules($faker->randomElement($flights));
            $manager->persist($pasHasFlight);

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
            AirportFixtures::class,
            SeatFixtures::class,
            PassengerFixtures::class
        ];
    }
}
