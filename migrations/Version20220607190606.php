<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607190606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE combate_peleador (combate_id INT NOT NULL, peleador_id INT NOT NULL, INDEX IDX_133575905745F035 (combate_id), INDEX IDX_133575907DC76EF0 (peleador_id), PRIMARY KEY(combate_id, peleador_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_133575905745F035 FOREIGN KEY (combate_id) REFERENCES combate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE combate_peleador ADD CONSTRAINT FK_133575907DC76EF0 FOREIGN KEY (peleador_id) REFERENCES peleador (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE combate_peleador');
    }
}
