<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518212531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combate ADD evento_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE combate ADD CONSTRAINT FK_118330CF87A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id)');
        $this->addSql('CREATE INDEX IDX_118330CF87A5F842 ON combate (evento_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combate DROP FOREIGN KEY FK_118330CF87A5F842');
        $this->addSql('DROP INDEX IDX_118330CF87A5F842 ON combate');
        $this->addSql('ALTER TABLE combate DROP evento_id');
    }
}
