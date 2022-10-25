<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221025105239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3341B9A0DA');
        $this->addSql('ALTER TABLE student ADD average INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3341B9A0DA FOREIGN KEY (id_classroom_id) REFERENCES classroom (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF3341B9A0DA');
        $this->addSql('ALTER TABLE student DROP average');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF3341B9A0DA FOREIGN KEY (id_classroom_id) REFERENCES classroom (id) ON DELETE CASCADE');
    }
}
