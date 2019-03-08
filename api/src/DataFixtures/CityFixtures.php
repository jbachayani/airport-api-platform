<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CityFixtures extends Fixture implements DependentFixtureInterface
{
    const QT = 1200;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $countries = $manager->getRepository(Country::class)->findAll();

        for ($i = 0; $i < self::QT; $i++) {
            $city = new City();
            $city->setName($faker->city);
            $city->setCountry($faker->randomElement($countries));
            $manager->persist($city);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CountryFixtures::class,
        ];
    }
}
