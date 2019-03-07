<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CountryFixtures extends Fixture
{
    const QT = 206;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < self::QT; $i++) {
            $country = new Country();
            $country->setName($faker->unique()->country);
            $country->setExist(true);
            $manager->persist($country);
        }

        $manager->flush();
    }
}
