<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250330203537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ingested item table.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ing_ingested_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ing_ingested_item (id INT NOT NULL, dependant_from VARCHAR(255) NOT NULL, repository VARCHAR(255) NOT NULL, starred_score INT NOT NULL, fork_score INT NOT NULL, registration_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN ing_ingested_item.registration_date IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ing_ingested_item_id_seq CASCADE');
        $this->addSql('DROP TABLE ing_ingested_item');
    }
}
