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

        $this->addSql('ALTER TABLE recipient RENAME INDEX fk_6804fb49104c8843 TO IDX_6804FB49104C8843');
        $this->addSql('DROP INDEX recipient_group ON recipient_group');
        $this->addSql('ALTER TABLE donation ADD CONSTRAINT FK_31E581A0E92F8F78 FOREIGN KEY (recipient_id) REFERENCES recipient (id)');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation DROP FOREIGN KEY FK_31E581A0E92F8F78');
        $this->addSql('ALTER TABLE recipient RENAME INDEX idx_6804fb49104c8843 TO FK_6804FB49104C8843');
        $this->addSql('CREATE UNIQUE INDEX recipient_group ON recipient_group (name)');

        $this->addSql('ALTER TABLE recipient DROP FOREIGN KEY FK_6804FB49104C8843;');
        $this->addSql('ALTER TABLE recipient DROP COLUMN recipient_group_id;');
        $this->addSql('DROP TABLE recipient_group;');
    }
}
