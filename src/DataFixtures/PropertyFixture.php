<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 100; $i++){
            $property = new Property();
            $property->setTitle($faker->words('4', 'true'));
            $property->setDescription($faker->sentences('3', 'true'));
            $property->setSurface($faker->numberBetween(10, 250));
            $property->setRooms($faker->numberBetween(1, 7));
            $property->setBedrooms($faker->numberBetween(1, 6));
            $property->setFloor($faker->numberBetween(1, 12));
            $property->setPrice($faker->numberBetween(80000, 1000000));
            $property->setHeat($faker->numberBetween(0, count(Property::HEAT) - 1));
            $property->setCity($faker->city);
            $property->setAddress($faker->address);
            $property->setPostalCode($faker->postcode);
            $property->setsold(false);

            $manager->persist($property);
        }
        $manager->flush();
    }
}
