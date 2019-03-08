<?php

namespace App\DataFixtures;

use App\Entity\Aircraft;
use App\Entity\Manufacturer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AircraftFixtures extends Fixture implements DependentFixtureInterface
{
    const QT = 100;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $manufacturers = $manager->getRepository(Manufacturer::class)->findAll();

        for ($i = 0; $i < self::QT; $i++) {
            $aircraft = new Aircraft();
            $aircraft->setCapacity($faker->numberBetween($min = 0, $max = 20000));
            $aircraft->setModel($faker->title);
            $aircraft->setSerialNumber($faker->uuid);
            $aircraft->setType($faker->ean8);
            $aircraft->setWeight($faker->randomFloat($min = 0.0, $max = 800000.0));
            $aircraft->setManufacturer($faker->randomElement($manufacturers));
            $manager->persist($aircraft);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ManufacturerFixtures::class,
        ];
    }


}
