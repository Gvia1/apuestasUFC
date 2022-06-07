<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607185014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combate DROP FOREIGN KEY FK_118330CF7919B70F');
        $this->addSql('ALTER TABLE combate DROP FOREIGN KEY FK_118330CF6BAC18E1');
        $this->addSql('DROP INDEX IDX_118330CF6BAC18E1 ON combate');
        $this->addSql('DROP INDEX IDX_118330CF7919B70F ON combate');
        $this->addSql('ALTER TABLE combate DROP peleador2_id, DROP peleador1_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE combate ADD peleador2_id INT NOT NULL, ADD peleador1_id INT NOT NULL');
        $this->addSql('ALTER TABLE combate ADD CONSTRAINT FK_118330CF7919B70F FOREIGN KEY (peleador2_id) REFERENCES peleador (id)');
        $this->addSql('ALTER TABLE combate ADD CONSTRAINT FK_118330CF6BAC18E1 FOREIGN KEY (peleador1_id) REFERENCES peleador (id)');
        $this->addSql('CREATE INDEX IDX_118330CF6BAC18E1 ON combate (peleador1_id)');
        $this->addSql('CREATE INDEX IDX_118330CF7919B70F ON combate (peleador2_id)');
    }
}
