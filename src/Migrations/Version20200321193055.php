<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321193055 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipient_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(250) NOT NULL, UNIQUE INDEX recipient_group (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');
        $this->addSql('ALTER TABLE recipient ADD recipient_group_id INT DEFAULT NULL;');
     $this->addSql('ALTER TABLE recipient ADD CONSTRAINT FK_6804FB49104C8843 FOREIGN KEY (recipient_group_id) REFERENCES recipient_group (id);');
     $this->addSql('CREATE INDEX IDX_6804FB49104C8843 ON recipient (recipient_group_id);');
     $this->addSql('ALTER TABLE donation_requests_items RENAME INDEX idx_dbad424de04907ed TO IDX_101F3ECDE04907ED;');
     $this->addSql('ALTER TABLE donation_requests_items RENAME INDEX idx_dbad424d126f525e TO IDX_101F3ECD126F525E;');

    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DROP INDEX IDX_101F3ECDE04907ED ON donation_requests_items');
        $this->addSql('DROP INDEX IDX_101F3ECD126F525E ON donation_requests_items');
        $this->addSql('DROP TABLE recipient_group;');

    }
}
