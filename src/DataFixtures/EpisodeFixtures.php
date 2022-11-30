<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $episode = new Episode();
        $episode->setNumber(1);
        $episode->setTitle('Passé décomposé');
        $episode->setSynopsis("Après être sorti du coma, Rick se met à la recherche de sa famille; il réalise rapidement que le monde a été dévasté par les morts-vivants; il rencontre en chemin Morgan et Duane, qui lui enseignent les règles de survie.");
        $episode->setSeason($this->getReference("TWD_Season1"));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setNumber(2);
        $episode->setTitle('Tripes');
        $episode->setSynopsis("Rick parvient à s'échapper du tank grâce à l'aide de Glenn, dont il avait entendu la voix à la radio. Rick et Glenn se réunissent avec les compagnons de Glenn, un autre groupe de survivants venus pour se ravitailler au supermarché.");
        $episode->setSeason($this->getReference("TWD_Season1"));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setNumber(3);
        $episode->setTitle('T\'as qu\'à discuter avec les grenouilles');
        $episode->setSynopsis("Rick décide de retourner à Atlanta; il doit y récupérer un sac rempli d'armes à feu et y sauver la vie d'un homme; Shane et Lori doivent composer avec le retour inattendu d'une personne qu'ils croyaient morte.");
        $episode->setSeason($this->getReference("TWD_Season1"));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setNumber(4);
        $episode->setTitle('Le Gang');
        $episode->setSynopsis("En cherchant Merle, le groupe essaie de retrouver le sac d'armes mais un autre groupe de survivants les attaque. Le groupe parvient à capturer un attaquant blessé, Miguelito, mais les autres s'enfuient en voiture en emmenant Glenn comme otage.");
        $episode->setSeason($this->getReference("TWD_Season1"));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setNumber(5);
        $episode->setTitle('Feux de forêt');
        $episode->setSynopsis("Les cadavres sont enterrés, ceux des zombis brûlés, mais Andrea protège le corps d'Amy jusqu'à son réveil en zombi, pour finir par l'achever. Dale, la voyant totalement bouleversée, tente en vain de la réconforter.");
        $episode->setSeason($this->getReference("TWD_Season1"));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setNumber(6);
        $episode->setTitle('Sujet-test 19');
        $episode->setSynopsis("Edwin Jenner accueille les survivants au CDC. Le petit groupe profite d'un repos provisoire. Andrea reste dans un état dépressif et Dale tente vainement de la réconforter.");
        $episode->setSeason($this->getReference("TWD_Season1"));
        $manager->persist($episode);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}
