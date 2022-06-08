<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220608170445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE combate_peleador (id INT AUTO_INCREMENT NOT NULL, peleador_id INT NOT NULL, combate_id INT NOT NULL, metodo_id INT NOT NULL, metodo_especifico_id INT DEFAULT NULL, ganador TINYINT(1) DEFAULT NULL, round VARCHAR(255) NOT NULL, INDEX IDX_133575907DC76EF0 (peleador_id), INDEX IDX_133575905745F035 (combate_id), INDEX IDX_13357590A45CBFCF (metodo_id), INDEX IDX_13357590FE9C15E3 (metodo_especifico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_133575907DC76EF0 FOREIGN KEY (peleador_id) REFERENCES peleador (id)');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_133575905745F035 FOREIGN KEY (combate_id) REFERENCES combate (id)');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_13357590A45CBFCF FOREIGN KEY (metodo_id) REFERENCES metodo (id)');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_13357590FE9C15E3 FOREIGN KEY (metodo_especifico_id) REFERENCES metodo_especifico (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE combate_peleador');
    }
}
