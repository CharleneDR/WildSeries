<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207221942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actor ADD nationality VARCHAR(255) NOT NULL, ADD birthday DATE NOT NULL, ADD biography LONGTEXT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_447556F95E237E06 ON actor (name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_447556F95E237E06 ON actor');
        $this->addSql('ALTER TABLE actor DROP nationality, DROP birthday, DROP biography');
    }
}
