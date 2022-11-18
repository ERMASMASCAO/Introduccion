<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221118122814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, published_at DATE NOT NULL, INDEX IDX_5F9E962A4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        // $this->addSql('ALTER TABLE post CHANGE post_user_id post_user_id VARCHAR(255) DEFAULT NULL');
        //$this->addSql('ALTER TABLE user CHANGE id id VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(180) NOT NULL');
        //$this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON user (name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A4B89032C');
        $this->addSql('DROP TABLE comments');
        $this->addSql('ALTER TABLE post CHANGE post_user_id post_user_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D6495E237E06 ON user');
        $this->addSql('ALTER TABLE user CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL');
    }
}
