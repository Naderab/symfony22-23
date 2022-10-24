<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221018133513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student ADD id_classroom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3341B9A0DA FOREIGN KEY (id_classroom_id) REFERENCES classroom (id)');
        $this->addSql('CREATE INDEX IDX_B723AF3341B9A0DA ON student (id_classroom_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3341B9A0DA');
        $this->addSql('DROP INDEX IDX_B723AF3341B9A0DA ON student');
        $this->addSql('ALTER TABLE student DROP id_classroom_id');
    }
}
