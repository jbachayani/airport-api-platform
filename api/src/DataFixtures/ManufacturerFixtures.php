<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ManufacturerFixtures extends Fixture
{
    const QT = 100;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 personnes
        for ($i = 0; $i < self::QT; $i++) {
            $manufacturer = new Manufacturer();
            $manufacturer->setName($faker->name);
            $manager->persist($manufacturer);
        }

        $manager->flush();
    }
}
