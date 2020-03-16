<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200316130304 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipient (id INT AUTO_INCREMENT NOT NULL, institution_name VARCHAR(255) NOT NULL, UNIQUE INDEX institution_name_idx (institution_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donation (id INT AUTO_INCREMENT NOT NULL, recipient_id INT NOT NULL, donation_item_id INT NOT NULL, item_count INT NOT NULL, donated_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_31E581A0E92F8F78 (recipient_id), INDEX IDX_31E581A038C3AEEE (donation_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE donation ADD CONSTRAINT FK_31E581A0E92F8F78 FOREIGN KEY (recipient_id) REFERENCES recipient (id)');
        $this->addSql('ALTER TABLE donation ADD CONSTRAINT FK_31E581A038C3AEEE FOREIGN KEY (donation_item_id) REFERENCES donation_item (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation DROP FOREIGN KEY FK_31E581A0E92F8F78');
        $this->addSql('DROP TABLE recipient');
        $this->addSql('DROP TABLE donation');
    }
}
