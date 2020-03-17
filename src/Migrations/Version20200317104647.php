<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317104647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE danation_requests_items ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE help_requests_items ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE danation_requests_items MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE danation_requests_items DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE danation_requests_items DROP id');
        $this->addSql('ALTER TABLE danation_requests_items ADD PRIMARY KEY (donation_request_id, item_id)');
        $this->addSql('ALTER TABLE help_requests_items MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE help_requests_items DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE help_requests_items DROP id');
        $this->addSql('ALTER TABLE help_requests_items ADD PRIMARY KEY (help_request_id, item_id)');
    }
}
