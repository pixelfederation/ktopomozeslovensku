<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200320163037 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE account_transaction (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', credit DOUBLE PRECISION NOT NULL, debit DOUBLE PRECISION NOT NULL, transaction_id BIGINT NOT NULL, execution_id BIGINT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_A370F9D22FC0CB0F (transaction_id), INDEX search_idx (date), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE account_balance (id INT AUTO_INCREMENT NOT NULL, credit DOUBLE PRECISION NOT NULL, debit DOUBLE PRECISION NOT NULL, credit_count INT NOT NULL, debit_count INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_65DF0BB6AA9E377A (date), INDEX search_idx (date), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE account_actual_balance (id INT AUTO_INCREMENT NOT NULL, credit DOUBLE PRECISION NOT NULL, debit DOUBLE PRECISION NOT NULL, credit_count INT NOT NULL, debit_count INT NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO account_transaction (date, credit, debit, transaction_id, execution_id, created_at) VALUES (\'2020-03-13\', 495.16, 0, 1, 1, now())');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE account_transaction');
        $this->addSql('DROP TABLE account_balance');
        $this->addSql('DROP TABLE account_actual_balance');
    }
}
