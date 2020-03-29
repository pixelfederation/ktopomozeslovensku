<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Service\AccentsRemover;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200329185512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipient ADD institution_name_searchable VARCHAR(255) NOT NULL');
        $rows = $this->connection->query("SELECT id, institution_name FROM recipient");

        if (!$rows) {
            return;
        }

        foreach ($rows as $row) {var_dump($row);
            $this->addSql('UPDATE recipient SET institution_name_searchable = ? WHERE  id = ?', [
                AccentsRemover::removeAccents($row['institution_name']),
                $row['id']
            ]);
        }
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipient DROP institution_name_searchable');
    }
}
