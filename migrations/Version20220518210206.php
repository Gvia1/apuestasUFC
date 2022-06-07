<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518210206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apuesta ADD combate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE apuesta ADD CONSTRAINT FK_A114C6555745F035 FOREIGN KEY (combate_id) REFERENCES combate (id)');
        $this->addSql('CREATE INDEX IDX_A114C6555745F035 ON apuesta (combate_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apuesta DROP FOREIGN KEY FK_A114C6555745F035');
        $this->addSql('DROP INDEX IDX_A114C6555745F035 ON apuesta');
        $this->addSql('ALTER TABLE apuesta DROP combate_id');
    }
}
