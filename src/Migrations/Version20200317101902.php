<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317101902 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE danation_requests_items (donation_request_id INT NOT NULL, item_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_DBAD424DE04907ED (donation_request_id), INDEX IDX_DBAD424D126F525E (item_id), PRIMARY KEY(donation_request_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE help_requests_items (help_request_id INT NOT NULL, item_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_A147A08DA8AB70A7 (help_request_id), INDEX IDX_A147A08D126F525E (item_id), PRIMARY KEY(help_request_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE danation_requests_items ADD CONSTRAINT FK_DBAD424DE04907ED FOREIGN KEY (donation_request_id) REFERENCES donation_request (id)');
        $this->addSql('ALTER TABLE danation_requests_items ADD CONSTRAINT FK_DBAD424D126F525E FOREIGN KEY (item_id) REFERENCES donation_item (id)');
        $this->addSql('ALTER TABLE help_requests_items ADD CONSTRAINT FK_A147A08DA8AB70A7 FOREIGN KEY (help_request_id) REFERENCES help_request (id)');
        $this->addSql('ALTER TABLE help_requests_items ADD CONSTRAINT FK_A147A08D126F525E FOREIGN KEY (item_id) REFERENCES donation_item (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE danation_requests_items');
        $this->addSql('DROP TABLE help_requests_items');
    }
}
