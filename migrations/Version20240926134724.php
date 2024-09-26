<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240926134724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur ADD id_image INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B32BB8456F FOREIGN KEY (id_image) REFERENCES image (id_image)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B32BB8456F ON utilisateur (id_image)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B32BB8456F');
        $this->addSql('DROP INDEX UNIQ_1D1C63B32BB8456F ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP id_image');
    }
}
