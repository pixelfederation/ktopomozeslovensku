<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322105418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'default values';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("--  Auto-generated SQL script #202003221153
                        INSERT INTO project.recipient_group (id,name)
                          VALUES (101,'Nemocnica');
                        INSERT INTO project.recipient_group (id,name)
                          VALUES (102,'Ambulancia');
                        INSERT INTO project.recipient_group (id,name)
                          VALUES (103,'Zariadenie siciálnych služieb');
                        INSERT INTO project.recipient_group (id,name)
                          VALUES (104,'Záchranná služba');
                        INSERT INTO project.recipient_group (id,name)
                          VALUES (105,'Občianske združenie');
                        INSERT INTO project.recipient_group (id,name)
                          VALUES (106,'Lekáreň');
                        INSERT INTO project.recipient_group (id,name)
                          VALUES (107,'Firma');");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
    }
}
