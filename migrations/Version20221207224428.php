<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207224428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor ADD picture VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL, ADD nationality VARCHAR(255) NOT NULL, ADD birthday DATE NOT NULL, ADD biography LONGTEXT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_447556F95E237E06 ON actor (name)');
        $this->addSql('ALTER TABLE actor_program ADD CONSTRAINT FK_B01827EE3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE episode ADD duration INT NOT NULL, ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE program ADD slug VARCHAR(255) NOT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_92ED77842B36786B ON program (title)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode DROP duration, DROP slug');
        $this->addSql('DROP INDEX UNIQ_92ED77842B36786B ON program');
        $this->addSql('ALTER TABLE program DROP slug, DROP updated_at');
        $this->addSql('DROP INDEX UNIQ_447556F95E237E06 ON actor');
        $this->addSql('ALTER TABLE actor DROP picture, DROP updated_at, DROP slug, DROP nationality, DROP birthday, DROP biography');
        $this->addSql('ALTER TABLE actor_program DROP FOREIGN KEY FK_B01827EE3EB8070A');
    }
}
