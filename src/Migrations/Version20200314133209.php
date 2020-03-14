<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200314133209 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation_request ADD donation_item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE donation_request ADD CONSTRAINT FK_113B732F38C3AEEE FOREIGN KEY (donation_item_id) REFERENCES donation_item (id)');
        $this->addSql('CREATE INDEX IDX_113B732F38C3AEEE ON donation_request (donation_item_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation_request DROP FOREIGN KEY FK_113B732F38C3AEEE');
        $this->addSql('DROP INDEX IDX_113B732F38C3AEEE ON donation_request');
        $this->addSql('ALTER TABLE donation_request DROP donation_item_id');
    }
}
