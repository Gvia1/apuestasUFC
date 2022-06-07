<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607181824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE resultado');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE resultado (id INT AUTO_INCREMENT NOT NULL, combate_id INT DEFAULT NULL, metodo_id INT DEFAULT NULL, metodo_especifico_id INT DEFAULT NULL, INDEX IDX_B2ED91CA45CBFCF (metodo_id), INDEX IDX_B2ED91CFE9C15E3 (metodo_especifico_id), UNIQUE INDEX UNIQ_B2ED91C5745F035 (combate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE resultado ADD CONSTRAINT FK_B2ED91C5745F035 FOREIGN KEY (combate_id) REFERENCES combate (id)');
        $this->addSql('ALTER TABLE resultado ADD CONSTRAINT FK_B2ED91CFE9C15E3 FOREIGN KEY (metodo_especifico_id) REFERENCES metodo_especifico (id)');
        $this->addSql('ALTER TABLE resultado ADD CONSTRAINT FK_B2ED91CA45CBFCF FOREIGN KEY (metodo_id) REFERENCES metodo (id)');
    }
}
