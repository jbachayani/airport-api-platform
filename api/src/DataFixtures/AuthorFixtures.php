<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AuthorFixtures extends Fixture {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 personnes
        for ($i = 0; $i < 100; $i++) {
            $author = new Author();
            $author->setLastname($faker->lastName);
            $author->setFirstname($faker->lastName);
            $author->setAge($faker->randomDigit);

            $manager->persist($author);
        }
        $manager->flush();
    }
}
