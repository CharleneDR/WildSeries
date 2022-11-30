<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2010);
        $season->setDescription("Après avoir été blessé dans l’exercice de ses fonctions, le shérif Rick Grimes se réveille d’un coma de plusieurs semaines et découvre un monde post-apocalyptique où la quasi-totalité de la population américaine s’est transformée en zombies. Seul et déboussolé, Rick se rend à Atlanta pour rechercher sa femme Lori et son fils Carl. Sur son chemin, il fera la rencontre d’autres survivants avec lesquels il tentera de rester en vie dans ce monde métamorphosé, effrayant et périlleux.");
        $season->setProgram($this->getReference('The Walking dead'));
        $manager->persist($season);
        $this->addReference("TWD_Season".$season->getNumber(), $season);

        $season = new Season();
        $season->setNumber(2);
        $season->setYear(2011);
        $season->setDescription("A la suite de l’explosion du CDC, Rick et son groupe fuient Atlanta alors que la ville est infestée de zombies. Confrontés à une nouvelle menace, ces derniers trouvent refuge dans la ferme d’Hershel Greene, un homme dont la famille cache un terrible secret. Mais les liens du groupe sont mis à rude épreuve lorsque des tensions éclatent entre les survivants et les habitants de la ferme, mais également entre Rick et Shane.");
        $season->setProgram($this->getReference('The Walking dead'));
        $manager->persist($season);
        $this->addReference("TWD_Season".$season->getNumber(), $season);

        $season = new Season();
        $season->setNumber(3);
        $season->setYear(2012);
        $season->setDescription("Quelques mois après avoir abandonné la ferme d’Hershel, Rick et sa communauté de survivants découvrent une prison abandonnée dans laquelle s’installer. Mais la sécurité du groupe se trouve rapidement menacée par la communauté voisine dirigée par un homme impitoyable, surnommé le Gouverneur.");
        $season->setProgram($this->getReference('The Walking dead'));
        $manager->persist($season);
        $this->addReference("TWD_Season".$season->getNumber(), $season);

        $season = new Season();
        $season->setNumber(4);
        $season->setYear(2013);
        $season->setDescription("Plusieurs mois se sont écoulés depuis l’attaque du Gouverneur et la vie reprend peu à peu son cours à la prison. Lorsqu’un événement tragique oblige les survivants à se séparer et à emprunter des chemins différents, la survie devient plus périlleuse. Confrontés à de nouveaux dangers et ennemis, ils devront faire face à des choix difficiles.");
        $season->setProgram($this->getReference('The Walking dead'));
        $manager->persist($season);
        $this->addReference("TWD_Season".$season->getNumber(), $season);

        $season = new Season();
        $season->setNumber(5);
        $season->setYear(2014);
        $season->setDescription("Captifs de la communauté du Terminus, Rick et les siens parviennent à prendre la fuite. Après un long périple et de nombreux sacrifices, le groupe trouve refuge à Alexandria, une petite ville fortifiée qui n’a jamais été confrontée aux horreurs du monde tel qu’il est devenu. Mais leur arrivée ne sera pas vue d’un très bon œil, d’autant que Rick tentera de prendre les choses en main.");
        $season->setProgram($this->getReference('The Walking dead'));
        $manager->persist($season);
        $this->addReference("TWD_Season".$season->getNumber(), $season);

        $season = new Season();
        $season->setNumber(6);
        $season->setYear(2015);
        $season->setDescription("Lorsque de nouvelles menaces mettent en danger la sécurité d’Alexandria, l’utopie prend fin, et la communauté va vite s’apercevoir que le monde qui l’entoure est bien plus vaste et complexe qu’il n’y paraît. Après avoir fait la rencontre d'un groupe dont l’aide pourrait s’avérer précieuse, Rick et les siens sont confrontés aux Sauveurs, une bande armée cruelle et implacable. Pour faire face à ce nouvel adversaire, ils devront se montrer plus redoutables que jamais.");
        $season->setProgram($this->getReference('The Walking dead'));
        $manager->persist($season);
        $this->addReference("TWD_Season".$season->getNumber(), $season);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }
}
