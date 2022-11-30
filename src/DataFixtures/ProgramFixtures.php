<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $program = new Program();
        $program->setTitle('The Walking dead');
        $program->setSynopsis("Après une apocalypse ayant transformé la quasi-totalité de la population en zombies, un groupe d'hommes et de femmes mené par l'officier Rick Grimes tente de survivre... Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde devenu méconnaissable, à travers leur périple dans le Sud profond des États-Unis.");
        $program->setCategory($this->getReference('category_Action'));
        $program->setPoster("https://fr.web.img5.acsta.net/c_310_420/pictures/22/08/29/18/20/3648785.jpg");
        $manager->persist($program);
        $this->addReference("program_1" , $program);

        $program = new Program();
        $program->setTitle('Doctor who');
        $program->setSynopsis("Extraterrestre de 900 ans, le Docteur est un aventurier qui voyage à travers le temps et l'espace à l'aide de son vaisseau, le TARDIS (Time And Relative Dimension In Space), qui, pour mieux s'adapter à l'environnement, a l'apparence d'une cabine téléphonique. Le Docteur voyage en compagnie d'une jeune fille. Ensemble, ils font de nombreuses rencontres sur les diverses planètes qu'ils explorent... ");
        $program->setCategory($this->getReference('category_Aventure'));
        $program->setPoster("https://sm.ign.com/t/ign_fr/tv/d/doctor-who/doctor-who-1_9u6h.300.jpg");
        $manager->persist($program);
        $this->addReference("program_2", $program);

        $program = new Program();
        $program->setTitle('Breaking Bad');
        $program->setSynopsis("Walter White, 50 ans, est professeur de chimie dans un lycée du Nouveau-Mexique. Pour subvenir aux besoins de Skyler, sa femme enceinte, et de Walt Junior, son fils handicapé, il est obligé de travailler doublement. Son quotidien déjà morose devient carrément noir lorsqu'il apprend qu'il est atteint d'un incurable cancer des poumons. Les médecins ne lui donnent pas plus de deux ans à vivre. Pour réunir rapidement beaucoup d'argent afin de mettre sa famille à l'abri, Walter ne voit plus qu'une solution : mettre ses connaissances en chimie à profit pour fabriquer et vendre du crystal meth, une drogue de synthèse qui rapporte beaucoup. Il propose à Jesse, un de ses anciens élèves devenu un petit dealer de seconde zone, de faire équipe avec lui. Le duo improvisé met en place un labo itinérant dans un vieux camping-car. Cette association inattendue va les entraîner dans une série de péripéties tant comiques que pathétiques.
        ");
        $program->setCategory($this->getReference('category_Action'));
        $program->setPoster("https://fr.web.img3.acsta.net/c_310_420/pictures/19/06/18/12/11/3956503.jpg");
        $manager->persist($program);
        $this->addReference("program_3", $program);

        $program = new Program();
        $program->setTitle('Game of Thrones: House of the Dragon');
        $program->setSynopsis("L'histoire de la famille Targaryen, près de 200 ans avant les événements de Game Of Thrones. Alors que le Roi Viserys règne sur Westeros, la question de sa succession inquiète. Sans progéniture mâle, qui prendra sa suite ? Avec pas moins de 10 dragons adultes sous leur contrôle, les Targaryen dominent le Royaume des Sept Couronnes depuis fort longtemps. La seule puissance capable de les renverser est la Maison Targaryen elle-même. Les tensions, trahisons et jalousies qui secouent le clan en interne leur seront-elles fatales ?");
        $program->setCategory($this->getReference('category_Fantastique'));
        $program->setPoster("https://fr.web.img5.acsta.net/c_310_420/pictures/22/06/23/09/17/1110439.jpg");
        $manager->persist($program);
        $this->addReference("program_4", $program);

        $program = new Program();
        $program->setTitle('American Horror Story');
        $program->setSynopsis("A chaque saison, son histoire. American Horror Story nous embarque dans des récits à la fois poignants et cauchemardesques, mêlant la peur, le gore et le politiquement correct. De quoi vous confronter à vos plus grandes frayeurs !");
        $program->setCategory($this->getReference('category_Horreur'));
        $program->setPoster("https://fr.web.img6.acsta.net/c_310_420/pictures/22/10/03/14/11/0328175.jpg");
        $manager->persist($program);
        $this->addReference("program_5", $program);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }
}
