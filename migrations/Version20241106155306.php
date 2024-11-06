<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241106155306 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produits_variants (id_variant INT AUTO_INCREMENT NOT NULL, id_produit INT NOT NULL, id_image INT DEFAULT NULL, id_enrobage INT DEFAULT NULL, prix INT NOT NULL, poids INT NOT NULL, affinage VARCHAR(20) DEFAULT NULL, stock VARCHAR(20) NOT NULL, date_ajout DATETIME NOT NULL, INDEX IDX_4CAEAB33F7384557 (id_produit), UNIQUE INDEX UNIQ_4CAEAB332BB8456F (id_image), INDEX IDX_4CAEAB33E4AD10E5 (id_enrobage), PRIMARY KEY(id_variant)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produits_variants ADD CONSTRAINT FK_4CAEAB33F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE produits_variants ADD CONSTRAINT FK_4CAEAB332BB8456F FOREIGN KEY (id_image) REFERENCES image (id_image)');
        $this->addSql('ALTER TABLE produits_variants ADD CONSTRAINT FK_4CAEAB33E4AD10E5 FOREIGN KEY (id_enrobage) REFERENCES enrobage (id_enrobage)');
        $this->addSql('ALTER TABLE produit ADD description LONGTEXT NOT NULL, ADD composition LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits_variants DROP FOREIGN KEY FK_4CAEAB33F7384557');
        $this->addSql('ALTER TABLE produits_variants DROP FOREIGN KEY FK_4CAEAB332BB8456F');
        $this->addSql('ALTER TABLE produits_variants DROP FOREIGN KEY FK_4CAEAB33E4AD10E5');
        $this->addSql('DROP TABLE produits_variants');
        $this->addSql('ALTER TABLE produit DROP description, DROP composition');
    }
}
