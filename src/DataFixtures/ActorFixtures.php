<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i<11; $i++) {
            $actor = new Actor();  
            $actor->setName($faker->firstname() . " " . $faker->lastname());
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(1,5)));
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(1,5)));      
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(1,5)));      
            $manager->persist($actor);  
            $this->addReference($actor->getName(), $actor);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }
}