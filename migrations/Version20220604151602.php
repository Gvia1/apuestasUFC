<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604151602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movimientos_financieros (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, importe INT NOT NULL, concepto VARCHAR(255) NOT NULL, INDEX IDX_17198357DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movimientos_financieros ADD CONSTRAINT FK_17198357DB38439E FOREIGN KEY (usuario_id) REFERENCES `user` (id)');
        $this->addSql('DROP TABLE resultado');
        $this->addSql('ALTER TABLE combate ADD ganador_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE combate ADD CONSTRAINT FK_118330CFA338CEA5 FOREIGN KEY (ganador_id) REFERENCES peleador (id)');
        $this->addSql('CREATE INDEX IDX_118330CFA338CEA5 ON combate (ganador_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE resultado (id INT AUTO_INCREMENT NOT NULL, combate_id INT DEFAULT NULL, metodo_id INT DEFAULT NULL, metodo_especifico_id INT DEFAULT NULL, INDEX IDX_B2ED91CA45CBFCF (metodo_id), INDEX IDX_B2ED91CFE9C15E3 (metodo_especifico_id), UNIQUE INDEX UNIQ_B2ED91C5745F035 (combate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE resultado ADD CONSTRAINT FK_B2ED91C5745F035 FOREIGN KEY (combate_id) REFERENCES combate (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE resultado ADD CONSTRAINT FK_B2ED91CA45CBFCF FOREIGN KEY (metodo_id) REFERENCES metodo (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE resultado ADD CONSTRAINT FK_B2ED91CFE9C15E3 FOREIGN KEY (metodo_especifico_id) REFERENCES metodo_especifico (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE movimientos_financieros');
        $this->addSql('ALTER TABLE combate DROP FOREIGN KEY FK_118330CFA338CEA5');
        $this->addSql('DROP INDEX IDX_118330CFA338CEA5 ON combate');
        $this->addSql('ALTER TABLE combate DROP ganador_id');
    }
}
