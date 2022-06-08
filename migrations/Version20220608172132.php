<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220608172132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apuesta ADD metodo_id INT DEFAULT NULL, ADD metodo_especifico_id INT DEFAULT NULL, ADD ganador_id INT DEFAULT NULL, ADD round VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE apuesta ADD CONSTRAINT FK_A114C655A45CBFCF FOREIGN KEY (metodo_id) REFERENCES metodo (id)');
        $this->addSql('ALTER TABLE apuesta ADD CONSTRAINT FK_A114C655FE9C15E3 FOREIGN KEY (metodo_especifico_id) REFERENCES metodo_especifico (id)');
        $this->addSql('ALTER TABLE apuesta ADD CONSTRAINT FK_A114C655A338CEA5 FOREIGN KEY (ganador_id) REFERENCES peleador (id)');
        $this->addSql('CREATE INDEX IDX_A114C655A45CBFCF ON apuesta (metodo_id)');
        $this->addSql('CREATE INDEX IDX_A114C655FE9C15E3 ON apuesta (metodo_especifico_id)');
        $this->addSql('CREATE INDEX IDX_A114C655A338CEA5 ON apuesta (ganador_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apuesta DROP FOREIGN KEY FK_A114C655A45CBFCF');
        $this->addSql('ALTER TABLE apuesta DROP FOREIGN KEY FK_A114C655FE9C15E3');
        $this->addSql('ALTER TABLE apuesta DROP FOREIGN KEY FK_A114C655A338CEA5');
        $this->addSql('DROP INDEX IDX_A114C655A45CBFCF ON apuesta');
        $this->addSql('DROP INDEX IDX_A114C655FE9C15E3 ON apuesta');
        $this->addSql('DROP INDEX IDX_A114C655A338CEA5 ON apuesta');
        $this->addSql('ALTER TABLE apuesta DROP metodo_id, DROP metodo_especifico_id, DROP ganador_id, DROP round');
    }
}
