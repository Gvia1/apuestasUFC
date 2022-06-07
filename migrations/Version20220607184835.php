<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607184835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combate ADD ganador_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE combate ADD CONSTRAINT FK_118330CFA338CEA5 FOREIGN KEY (ganador_id) REFERENCES peleador (id)');
        $this->addSql('CREATE INDEX IDX_118330CFA338CEA5 ON combate (ganador_id)');
        $this->addSql('ALTER TABLE peleador DROP victorias, DROP empates, DROP derrotas');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combate DROP FOREIGN KEY FK_118330CFA338CEA5');
        $this->addSql('DROP INDEX IDX_118330CFA338CEA5 ON combate');
        $this->addSql('ALTER TABLE combate DROP ganador_id');
        $this->addSql('ALTER TABLE peleador ADD victorias VARCHAR(255) NOT NULL, ADD empates VARCHAR(255) NOT NULL, ADD derrotas VARCHAR(255) NOT NULL');
    }
}
