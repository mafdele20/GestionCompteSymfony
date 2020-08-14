<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200813111350 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD employeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404555D7C53EC FOREIGN KEY (employeur_id) REFERENCES employeur (id)');
        $this->addSql('CREATE INDEX IDX_C74404555D7C53EC ON client (employeur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404555D7C53EC');
        $this->addSql('DROP INDEX IDX_C74404555D7C53EC ON client');
        $this->addSql('ALTER TABLE client DROP employeur_id');
    }
}
