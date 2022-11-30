<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 1; $i < 6; $i++) {
            for($j = 1; $j < 6; $j++) {
                for($k = 1; $k < 11; $k++) {


            $episode = new Episode();
            //Ce Faker va nous permettre d'alimenter l'instance de episode que l'on souhaite ajouter en base
            $episode->setNumber($k);
            $episode->setTitle($faker->words(3,true));
            $episode->setSynopsis($faker->paragraph());
            $episode->setSeason($this->getReference('program_' . $i . '_season_' . $j));
            $manager->persist($episode);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}
