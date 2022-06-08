<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220608164932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE combate_peleador');
        $this->addSql('ALTER TABLE combate DROP FOREIGN KEY FK_118330CFA338CEA5');
        $this->addSql('DROP INDEX IDX_118330CFA338CEA5 ON combate');
        $this->addSql('ALTER TABLE combate DROP ganador_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE combate_peleador (combate_id INT NOT NULL, peleador_id INT NOT NULL, INDEX IDX_133575905745F035 (combate_id), INDEX IDX_133575907DC76EF0 (peleador_id), PRIMARY KEY(combate_id, peleador_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_133575905745F035 FOREIGN KEY (combate_id) REFERENCES combate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_133575907DC76EF0 FOREIGN KEY (peleador_id) REFERENCES peleador (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE combate ADD ganador_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE combate ADD CONSTRAINT FK_118330CFA338CEA5 FOREIGN KEY (ganador_id) REFERENCES peleador (id)');
        $this->addSql('CREATE INDEX IDX_118330CFA338CEA5 ON combate (ganador_id)');
    }
}
