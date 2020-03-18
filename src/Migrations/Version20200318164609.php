<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200318164609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation_request ADD resolved TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE partner CHANGE helped_at helped_at DATE NOT NULL');
        $this->addSql('ALTER TABLE help_request ADD resolved TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE donation_requests_items CHANGE quantity quantity INT NOT NULL');
        $this->addSql('ALTER TABLE help_requests_items CHANGE quantity quantity INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation_request DROP resolved');
        $this->addSql('ALTER TABLE donation_requests_items CHANGE quantity quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE help_request DROP resolved');
        $this->addSql('ALTER TABLE help_requests_items CHANGE quantity quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partner CHANGE helped_at helped_at DATE DEFAULT \'2020-03-15\' NOT NULL');
    }
}
