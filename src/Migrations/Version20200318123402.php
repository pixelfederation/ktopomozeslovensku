<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200318123402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE danation_requests_items CHANGE item_id item_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL, CHANGE other other LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE help_requests_items CHANGE item_id item_id INT DEFAULT NULL, CHANGE quantity quantity INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE danation_requests_items CHANGE item_id item_id INT NOT NULL, CHANGE quantity quantity INT NOT NULL, CHANGE other other LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE help_requests_items CHANGE item_id item_id INT NOT NULL, CHANGE quantity quantity INT NOT NULL');
    }
}
