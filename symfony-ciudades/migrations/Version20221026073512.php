<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221026073512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pais (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ciudades ADD pais_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ciudades ADD CONSTRAINT FK_FF77006C604D5C6 FOREIGN KEY (pais_id) REFERENCES pais (id)');
        $this->addSql('CREATE INDEX IDX_FF77006C604D5C6 ON ciudades (pais_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ciudades DROP FOREIGN KEY FK_FF77006C604D5C6');
        $this->addSql('DROP TABLE pais');
        $this->addSql('DROP INDEX IDX_FF77006C604D5C6 ON ciudades');
        $this->addSql('ALTER TABLE ciudades DROP pais_id');
    }
}
