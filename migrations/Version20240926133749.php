<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240926133749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit CHANGE id_image_id id_image INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC272BB8456F FOREIGN KEY (id_image) REFERENCES image (id_image)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29A5EC272BB8456F ON produit (id_image)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC272BB8456F');
        $this->addSql('DROP INDEX UNIQ_29A5EC272BB8456F ON produit');
        $this->addSql('ALTER TABLE produit CHANGE id_image id_image_id INT DEFAULT NULL');
    }
}
