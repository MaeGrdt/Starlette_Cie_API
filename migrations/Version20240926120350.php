<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240926120350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit (id_produit INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, categorie VARCHAR(50) NOT NULL, type VARCHAR(50) NOT NULL, date_ajout DATETIME NOT NULL, PRIMARY KEY(id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favoris ADD id_produit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('CREATE INDEX IDX_8933C432F7384557 ON favoris (id_produit)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432F7384557');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP INDEX IDX_8933C432F7384557 ON favoris');
        $this->addSql('ALTER TABLE favoris DROP id_produit');
    }
}
