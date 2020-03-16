<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200316141813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE donation_requests_items (donation_request_id INT NOT NULL, item_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_101F3ECDE04907ED (donation_request_id), INDEX IDX_101F3ECD126F525E (item_id), PRIMARY KEY(donation_request_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donation_item (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE help_requests_items (help_request_id INT NOT NULL, item_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_A147A08DA8AB70A7 (help_request_id), INDEX IDX_A147A08D126F525E (item_id), PRIMARY KEY(help_request_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE donation_requests_items ADD CONSTRAINT FK_101F3ECDE04907ED FOREIGN KEY (donation_request_id) REFERENCES donation_request (id)');
        $this->addSql('ALTER TABLE donation_requests_items ADD CONSTRAINT FK_101F3ECD126F525E FOREIGN KEY (item_id) REFERENCES donation_item (id)');
        $this->addSql('ALTER TABLE help_requests_items ADD CONSTRAINT FK_A147A08DA8AB70A7 FOREIGN KEY (help_request_id) REFERENCES help_request (id)');
        $this->addSql('ALTER TABLE help_requests_items ADD CONSTRAINT FK_A147A08D126F525E FOREIGN KEY (item_id) REFERENCES donation_item (id)');
        $this->addSql('DROP INDEX IDX_113B732F38C3AEEE ON donation_request');
        $this->addSql('ALTER TABLE donation_request DROP quantity, DROP donation_item_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation_requests_items DROP FOREIGN KEY FK_101F3ECD126F525E');
        $this->addSql('ALTER TABLE help_requests_items DROP FOREIGN KEY FK_A147A08D126F525E');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE donation_requests_items');
        $this->addSql('DROP TABLE donation_item');
        $this->addSql('DROP TABLE help_requests_items');
        $this->addSql('ALTER TABLE donation_request ADD quantity INT NOT NULL, ADD donation_item_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_113B732F38C3AEEE ON donation_request (donation_item_id)');
    }
}
