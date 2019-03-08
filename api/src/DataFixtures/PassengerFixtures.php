<?php

namespace App\DataFixtures;

use App\Entity\Passenger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PassengerFixtures extends Fixture implements DependentFixtureInterface
{
    const QT = 10000;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        //$countries = $manager->getRepository(Country::class)->findAll();

        for ($i = 0; $i < self::QT; $i++) {
            $passenger = new Passenger();
            $passenger->setFirstName($faker->firstName);
            $passenger->setLastName($faker->lastName);
            $passenger->setEmail($faker->email);
            $passenger->setBaggage($faker->numberBetween($min = 0, $max = 5));
            $passenger->setBirthDate($faker->dateTime);
            $passenger->setHandicap($faker->boolean);
            $passenger->setPhoneNumber($faker->regexify('\+[0-9]{2,3}[0-9]{9}'));
            $manager->persist($passenger);
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
