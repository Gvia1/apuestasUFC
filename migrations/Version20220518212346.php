<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518212346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combate DROP FOREIGN KEY FK_118330CFFF51ECB6');
        $this->addSql('DROP INDEX UNIQ_118330CFFF51ECB6 ON combate');
        $this->addSql('ALTER TABLE combate DROP resultado_id');
        $this->addSql('ALTER TABLE resultado ADD metodo_id INT DEFAULT NULL, ADD metodo_especifico_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE resultado ADD CONSTRAINT FK_B2ED91CA45CBFCF FOREIGN KEY (metodo_id) REFERENCES metodo (id)');
        $this->addSql('ALTER TABLE resultado ADD CONSTRAINT FK_B2ED91CFE9C15E3 FOREIGN KEY (metodo_especifico_id) REFERENCES metodo_especifico (id)');
        $this->addSql('CREATE INDEX IDX_B2ED91CA45CBFCF ON resultado (metodo_id)');
        $this->addSql('CREATE INDEX IDX_B2ED91CFE9C15E3 ON resultado (metodo_especifico_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combate ADD resultado_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE combate ADD CONSTRAINT FK_118330CFFF51ECB6 FOREIGN KEY (resultado_id) REFERENCES resultado (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_118330CFFF51ECB6 ON combate (resultado_id)');
        $this->addSql('ALTER TABLE resultado DROP FOREIGN KEY FK_B2ED91CA45CBFCF');
        $this->addSql('ALTER TABLE resultado DROP FOREIGN KEY FK_B2ED91CFE9C15E3');
        $this->addSql('DROP INDEX IDX_B2ED91CA45CBFCF ON resultado');
        $this->addSql('DROP INDEX IDX_B2ED91CFE9C15E3 ON resultado');
        $this->addSql('ALTER TABLE resultado DROP metodo_id, DROP metodo_especifico_id');
    }
}
