<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322172129 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipient RENAME INDEX fk_6804fb49104c8843 TO IDX_6804FB49104C8843');
        $this->addSql('ALTER TABLE donation_requests_items RENAME INDEX idx_dbad424de04907ed TO IDX_101F3ECDE04907ED');
        $this->addSql('ALTER TABLE donation_requests_items RENAME INDEX idx_dbad424d126f525e TO IDX_101F3ECD126F525E');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation_requests_items RENAME INDEX idx_101f3ecd126f525e TO IDX_DBAD424D126F525E');
        $this->addSql('ALTER TABLE donation_requests_items RENAME INDEX idx_101f3ecde04907ed TO IDX_DBAD424DE04907ED');
        $this->addSql('ALTER TABLE recipient RENAME INDEX idx_6804fb49104c8843 TO FK_6804FB49104C8843');
    }
}
