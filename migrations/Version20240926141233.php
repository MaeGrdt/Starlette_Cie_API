<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240926141233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits_variants (id INT AUTO_INCREMENT NOT NULL, id_produit INT NOT NULL, id_image INT DEFAULT NULL, prix INT NOT NULL, poids INT NOT NULL, affinage VARCHAR(50) NOT NULL, stock VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, composition LONGTEXT NOT NULL, date_ajout DATETIME NOT NULL, INDEX IDX_4CAEAB33F7384557 (id_produit), UNIQUE INDEX UNIQ_4CAEAB332BB8456F (id_image), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produits_variants ADD CONSTRAINT FK_4CAEAB33F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE produits_variants ADD CONSTRAINT FK_4CAEAB332BB8456F FOREIGN KEY (id_image) REFERENCES image (id_image)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits_variants DROP FOREIGN KEY FK_4CAEAB33F7384557');
        $this->addSql('ALTER TABLE produits_variants DROP FOREIGN KEY FK_4CAEAB332BB8456F');
        $this->addSql('DROP TABLE produits_variants');
    }
}
