<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Airport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AirportFixtures extends Fixture implements DependentFixtureInterface
{
    const QT = 1500;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $cities = $manager->getRepository(City::class)->findAll();

        for ($i = 0; $i < self::QT; $i++) {
            $airport = new Airport();
            $airport->setName('Airport ' . $faker->unique()->name);
            $airport->setCode($faker->unique()->regexify('[A-Z]{3}'));
            $airport->setAircraftCapacity($faker->numberBetween($min = 0, $max = 50));
            $airport->setCity($faker->randomElement($cities));
            $manager->persist($airport);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CityFixtures::class,
        ];
    }
}
