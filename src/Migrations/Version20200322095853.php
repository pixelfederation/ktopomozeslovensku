<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322095853 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE help_request ADD recipient_group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE help_request ADD CONSTRAINT FK_658D7043104C8843 FOREIGN KEY (recipient_group_id) REFERENCES recipient_group (id)');
        $this->addSql('CREATE INDEX IDX_658D7043104C8843 ON help_request (recipient_group_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE help_request DROP FOREIGN KEY FK_658D7043104C8843');
        $this->addSql('DROP INDEX IDX_658D7043104C8843 ON help_request');
        $this->addSql('ALTER TABLE help_request DROP recipient_group_id');
    }
}
