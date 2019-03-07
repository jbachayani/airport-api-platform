<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class BookFixtures extends Fixture implements DependentFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $authors = $manager->getRepository(Author::class)->findAll();

        // on créé 10 personnes
        for ($i = 0; $i < 500; $i++) {
            $book = new Book();
            $book->setDescription($faker->text);
            $book->setName($faker->name);
            $book->setPublicationDate($faker->dateTime);
            $book->setReference($faker->randomNumber(6));
            $book->setAuthor($authors[array_rand($authors)]);

            $manager->persist($book);
        }
        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            AuthorFixtures::class,
        ];
    }
}
