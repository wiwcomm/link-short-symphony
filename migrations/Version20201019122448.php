<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201019122448 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE links_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE items');
        $this->addSql('ALTER TABLE links ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE links ADD link TEXT NOT NULL');
        $this->addSql('ALTER TABLE links ADD short_link VARCHAR(1024) DEFAULT NULL');
        $this->addSql('ALTER TABLE links ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE links_id_seq CASCADE');
        $this->addSql('CREATE TABLE items (id BIGINT DEFAULT NULL, category_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, price BIGINT DEFAULT NULL)');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE links DROP id');
        $this->addSql('ALTER TABLE links DROP link');
        $this->addSql('ALTER TABLE links DROP short_link');
    }
}
