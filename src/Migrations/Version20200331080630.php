<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200331080630 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE donation_item_group (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E550E05D1D775834 (value), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE donation_item ADD group_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE donation_item ADD CONSTRAINT FK_E880E34FE54D947 FOREIGN KEY (group_id) REFERENCES donation_item_group (id)');
        $this->addSql('CREATE INDEX IDX_E880E34FE54D947 ON donation_item (group_id)');
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Návlek na obuv');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Rukavice');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Respirátory FFP3');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Respirátory FFP2');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Respirátory FFP1');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Rúška');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Chirurgické rúška');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Operačné čiapky');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Ochranný overal');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Ochranné štíty');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Ochranné okuliare');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Germicídne žiariče');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Čističky vzduchu');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Dezinfekcia na nástroje');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Dezinfekcia na ruky');");
        $this->addSql("INSERT INTO donation_item_group (value) VALUES ('Dezinfekčné prostriedky');");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation_item DROP FOREIGN KEY FK_E880E34FE54D947');
        $this->addSql('DROP TABLE donation_item_group');
        $this->addSql('DROP INDEX IDX_E880E34FE54D947 ON donation_item');
        $this->addSql('ALTER TABLE donation_item DROP group_id');
    }
}
