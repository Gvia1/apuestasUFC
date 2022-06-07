<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604234339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE combate_peleador');
        $this->addSql('ALTER TABLE combate ADD peleador1_id INT NOT NULL');
        $this->addSql('ALTER TABLE combate ADD CONSTRAINT FK_118330CF6BAC18E1 FOREIGN KEY (peleador1_id) REFERENCES peleador (id)');
        $this->addSql('CREATE INDEX IDX_118330CF6BAC18E1 ON combate (peleador1_id)');
        $this->addSql('ALTER TABLE peleador ADD victorias VARCHAR(255) NOT NULL, ADD empates VARCHAR(255) NOT NULL, ADD derrotas VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE combate_peleador (combate_id INT NOT NULL, peleador_id INT NOT NULL, INDEX IDX_133575905745F035 (combate_id), INDEX IDX_133575907DC76EF0 (peleador_id), PRIMARY KEY(combate_id, peleador_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_133575905745F035 FOREIGN KEY (combate_id) REFERENCES combate (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_133575907DC76EF0 FOREIGN KEY (peleador_id) REFERENCES peleador (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE combate DROP FOREIGN KEY FK_118330CF6BAC18E1');
        $this->addSql('DROP INDEX IDX_118330CF6BAC18E1 ON combate');
        $this->addSql('ALTER TABLE combate DROP peleador1_id');
        $this->addSql('ALTER TABLE peleador DROP victorias, DROP empates, DROP derrotas');
    }
}
