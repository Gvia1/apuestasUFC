<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604152856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combate ADD peleador2_id INT NOT NULL');
        $this->addSql('ALTER TABLE combate ADD CONSTRAINT FK_118330CF7919B70F FOREIGN KEY (peleador2_id) REFERENCES peleador (id)');
        $this->addSql('CREATE INDEX IDX_118330CF7919B70F ON combate (peleador2_id)');
        $this->addSql('ALTER TABLE user ADD nombre VARCHAR(255) NOT NULL, ADD apellidos VARCHAR(255) NOT NULL, ADD direccion VARCHAR(255) NOT NULL, ADD localidad VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD telefono VARCHAR(255) NOT NULL, ADD entidad VARCHAR(255) NOT NULL, ADD oficina VARCHAR(255) NOT NULL, ADD dc VARCHAR(255) NOT NULL, ADD numero_cuenta VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combate DROP FOREIGN KEY FK_118330CF7919B70F');
        $this->addSql('DROP INDEX IDX_118330CF7919B70F ON combate');
        $this->addSql('ALTER TABLE combate DROP peleador2_id');
        $this->addSql('ALTER TABLE `user` DROP nombre, DROP apellidos, DROP direccion, DROP localidad, DROP email, DROP telefono, DROP entidad, DROP oficina, DROP dc, DROP numero_cuenta');
    }
}
