<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Actor;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i<11; $i++) {
            $actor = new Actor();  
            $actor->setName($faker->firstname() . " " . $faker->lastname());
            $actor->setBirthday($faker->datetime());
            $actor->setNationality($faker->countryCode());
            $actor->setBiography($faker->paragraph());
            $actor->setPicture("actor.jpg");
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(1,5)));
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(1,5)));      
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(1,5)));   
            $slug = $this->slugger->slug($actor->getName());
            $actor->setSlug($slug);   
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
