<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518203616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apuesta (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, INDEX IDX_A114C655DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE combate (id INT AUTO_INCREMENT NOT NULL, division_id INT DEFAULT NULL, rounds VARCHAR(255) NOT NULL, INDEX IDX_118330CF41859289 (division_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE combate_peleador (combate_id INT NOT NULL, peleador_id INT NOT NULL, INDEX IDX_133575905745F035 (combate_id), INDEX IDX_133575907DC76EF0 (peleador_id), PRIMARY KEY(combate_id, peleador_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE division (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evento (id INT AUTO_INCREMENT NOT NULL, localidad VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, fecha DATETIME NOT NULL, imagen VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metodo (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metodo_especifico (id INT AUTO_INCREMENT NOT NULL, metodo_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_99E50D90A45CBFCF (metodo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE peleador (id INT AUTO_INCREMENT NOT NULL, division_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, alias VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, edad VARCHAR(255) NOT NULL, altura VARCHAR(255) NOT NULL, peso VARCHAR(255) NOT NULL, victorias VARCHAR(255) NOT NULL, empates VARCHAR(255) NOT NULL, derrotas VARCHAR(255) NOT NULL, INDEX IDX_AE328E4541859289 (division_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resultado (id INT AUTO_INCREMENT NOT NULL, combate_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_B2ED91C5745F035 (combate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apuesta ADD CONSTRAINT FK_A114C655DB38439E FOREIGN KEY (usuario_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE combate ADD CONSTRAINT FK_118330CF41859289 FOREIGN KEY (division_id) REFERENCES division (id)');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_133575905745F035 FOREIGN KEY (combate_id) REFERENCES combate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_133575907DC76EF0 FOREIGN KEY (peleador_id) REFERENCES peleador (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metodo_especifico ADD CONSTRAINT FK_99E50D90A45CBFCF FOREIGN KEY (metodo_id) REFERENCES metodo (id)');
        $this->addSql('ALTER TABLE peleador ADD CONSTRAINT FK_AE328E4541859289 FOREIGN KEY (division_id) REFERENCES division (id)');
        $this->addSql('ALTER TABLE resultado ADD CONSTRAINT FK_B2ED91C5745F035 FOREIGN KEY (combate_id) REFERENCES combate (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combate_peleador DROP FOREIGN KEY FK_133575905745F035');
        $this->addSql('ALTER TABLE resultado DROP FOREIGN KEY FK_B2ED91C5745F035');
        $this->addSql('ALTER TABLE combate DROP FOREIGN KEY FK_118330CF41859289');
        $this->addSql('ALTER TABLE peleador DROP FOREIGN KEY FK_AE328E4541859289');
        $this->addSql('ALTER TABLE metodo_especifico DROP FOREIGN KEY FK_99E50D90A45CBFCF');
        $this->addSql('ALTER TABLE combate_peleador DROP FOREIGN KEY FK_133575907DC76EF0');
        $this->addSql('ALTER TABLE apuesta DROP FOREIGN KEY FK_A114C655DB38439E');
        $this->addSql('DROP TABLE apuesta');
        $this->addSql('DROP TABLE combate');
        $this->addSql('DROP TABLE combate_peleador');
        $this->addSql('DROP TABLE division');
        $this->addSql('DROP TABLE evento');
        $this->addSql('DROP TABLE metodo');
        $this->addSql('DROP TABLE metodo_especifico');
        $this->addSql('DROP TABLE peleador');
        $this->addSql('DROP TABLE resultado');
        $this->addSql('DROP TABLE `user`');
    }
}
