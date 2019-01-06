<?php

namespace BlogBundle\DataFixtures;

use BlogBundle\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ClientFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $client = new Client();
            $client->setFirstName($faker->firstName);
            $client->setLastName($faker->lastName);
            $client->setCreatedAt($faker->dateTimeBetween('-9 years', 'now'));
            $client->setExpiresAt($faker->dateTimeBetween('+1 years', '+5 years'));
            $manager->persist($client);
        }
        $manager->flush();
    }
}