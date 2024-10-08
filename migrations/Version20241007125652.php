<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241007125652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_actualite (id_article INT AUTO_INCREMENT NOT NULL, id_image INT DEFAULT NULL, nom_article VARCHAR(255) NOT NULL, resume LONGTEXT NOT NULL, corps LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, etat VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8EA7D1B32BB8456F (id_image), PRIMARY KEY(id_article)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id_avis INT AUTO_INCREMENT NOT NULL, id_produit INT DEFAULT NULL, id_utilisateur INT DEFAULT NULL, note INT NOT NULL, commentaire LONGTEXT DEFAULT NULL, date_avis DATETIME NOT NULL, INDEX IDX_8F91ABF0F7384557 (id_produit), INDEX IDX_8F91ABF050EAE44 (id_utilisateur), PRIMARY KEY(id_avis)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id_commande INT AUTO_INCREMENT NOT NULL, id_utilisateur INT NOT NULL, id_point_de_vente INT DEFAULT NULL, numero_commande VARCHAR(10) NOT NULL, date_commande DATETIME NOT NULL, statut VARCHAR(50) NOT NULL, total INT NOT NULL, INDEX IDX_6EEAA67D50EAE44 (id_utilisateur), INDEX IDX_6EEAA67DF47E927D (id_point_de_vente), PRIMARY KEY(id_commande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_detail (id_commande_detail INT AUTO_INCREMENT NOT NULL, id_commande INT DEFAULT NULL, quantite INT NOT NULL, prix_unitaire INT NOT NULL, UNIQUE INDEX UNIQ_2C5284463E314AE8 (id_commande), PRIMARY KEY(id_commande_detail)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_produit (id_commande_detail INT NOT NULL, id_produit INT NOT NULL, INDEX IDX_DF1E9E87C50C47CE (id_commande_detail), INDEX IDX_DF1E9E87F7384557 (id_produit), PRIMARY KEY(id_commande_detail, id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enrobage (id_enrobage INT AUTO_INCREMENT NOT NULL, id_image INT DEFAULT NULL, nom_enrobage VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_B476FC702BB8456F (id_image), PRIMARY KEY(id_enrobage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id_facture INT AUTO_INCREMENT NOT NULL, id_commande INT DEFAULT NULL, url_facture VARCHAR(255) NOT NULL, date_facture DATE NOT NULL, UNIQUE INDEX UNIQ_FE8664103E314AE8 (id_commande), PRIMARY KEY(id_facture)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favoris (id_favoris INT AUTO_INCREMENT NOT NULL, id_utilisateur INT DEFAULT NULL, id_produit INT DEFAULT NULL, date_ajout DATETIME NOT NULL, INDEX IDX_8933C43250EAE44 (id_utilisateur), INDEX IDX_8933C432F7384557 (id_produit), PRIMARY KEY(id_favoris)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id_image INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, type_image VARCHAR(50) NOT NULL, PRIMARY KEY(id_image)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id_paiement INT AUTO_INCREMENT NOT NULL, id_commande INT DEFAULT NULL, date_paiement DATETIME NOT NULL, montant INT NOT NULL, moyen_paiement VARCHAR(50) NOT NULL, statut_paiement VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_B1DC7A1E3E314AE8 (id_commande), PRIMARY KEY(id_paiement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE point_de_vente (id_point_de_vente INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, descriptif LONGTEXT NOT NULL, adresse VARCHAR(255) NOT NULL, jour VARCHAR(50) NOT NULL, horaire_debut TIME NOT NULL, horaire_fin TIME NOT NULL, cadence VARCHAR(50) NOT NULL, iframe_google_map LONGTEXT NOT NULL, PRIMARY KEY(id_point_de_vente)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id_produit INT AUTO_INCREMENT NOT NULL, id_image INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, categorie VARCHAR(50) NOT NULL, type_produit VARCHAR(50) NOT NULL, date_ajout DATETIME NOT NULL, UNIQUE INDEX UNIQ_29A5EC272BB8456F (id_image), PRIMARY KEY(id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits_variants (id_variant INT AUTO_INCREMENT NOT NULL, id_produit INT NOT NULL, id_image INT DEFAULT NULL, id_enrobage INT NOT NULL, prix INT NOT NULL, poids INT NOT NULL, affinage VARCHAR(20) NOT NULL, stock VARCHAR(20) NOT NULL, description LONGTEXT NOT NULL, composition LONGTEXT NOT NULL, date_ajout DATETIME NOT NULL, INDEX IDX_4CAEAB33F7384557 (id_produit), UNIQUE INDEX UNIQ_4CAEAB332BB8456F (id_image), INDEX IDX_4CAEAB33E4AD10E5 (id_enrobage), PRIMARY KEY(id_variant)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id_utilisateur INT AUTO_INCREMENT NOT NULL, id_image INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, telephone VARCHAR(14) DEFAULT NULL, mot_de_passe VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), UNIQUE INDEX UNIQ_1D1C63B32BB8456F (id_image), PRIMARY KEY(id_utilisateur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_actualite ADD CONSTRAINT FK_8EA7D1B32BB8456F FOREIGN KEY (id_image) REFERENCES image (id_image)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF050EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D50EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF47E927D FOREIGN KEY (id_point_de_vente) REFERENCES point_de_vente (id_point_de_vente)');
        $this->addSql('ALTER TABLE commande_detail ADD CONSTRAINT FK_2C5284463E314AE8 FOREIGN KEY (id_commande) REFERENCES commande (id_commande)');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87C50C47CE FOREIGN KEY (id_commande_detail) REFERENCES commande_detail (id_commande_detail)');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE enrobage ADD CONSTRAINT FK_B476FC702BB8456F FOREIGN KEY (id_image) REFERENCES image (id_image)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE8664103E314AE8 FOREIGN KEY (id_commande) REFERENCES commande (id_commande)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C43250EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id_utilisateur)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E3E314AE8 FOREIGN KEY (id_commande) REFERENCES commande (id_commande)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC272BB8456F FOREIGN KEY (id_image) REFERENCES image (id_image)');
        $this->addSql('ALTER TABLE produits_variants ADD CONSTRAINT FK_4CAEAB33F7384557 FOREIGN KEY (id_produit) REFERENCES produit (id_produit)');
        $this->addSql('ALTER TABLE produits_variants ADD CONSTRAINT FK_4CAEAB332BB8456F FOREIGN KEY (id_image) REFERENCES image (id_image)');
        $this->addSql('ALTER TABLE produits_variants ADD CONSTRAINT FK_4CAEAB33E4AD10E5 FOREIGN KEY (id_enrobage) REFERENCES enrobage (id_enrobage)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B32BB8456F FOREIGN KEY (id_image) REFERENCES image (id_image)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_actualite DROP FOREIGN KEY FK_8EA7D1B32BB8456F');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0F7384557');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF050EAE44');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D50EAE44');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF47E927D');
        $this->addSql('ALTER TABLE commande_detail DROP FOREIGN KEY FK_2C5284463E314AE8');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E87C50C47CE');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E87F7384557');
        $this->addSql('ALTER TABLE enrobage DROP FOREIGN KEY FK_B476FC702BB8456F');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE8664103E314AE8');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C43250EAE44');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432F7384557');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E3E314AE8');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC272BB8456F');
        $this->addSql('ALTER TABLE produits_variants DROP FOREIGN KEY FK_4CAEAB33F7384557');
        $this->addSql('ALTER TABLE produits_variants DROP FOREIGN KEY FK_4CAEAB332BB8456F');
        $this->addSql('ALTER TABLE produits_variants DROP FOREIGN KEY FK_4CAEAB33E4AD10E5');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B32BB8456F');
        $this->addSql('DROP TABLE article_actualite');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_detail');
        $this->addSql('DROP TABLE commande_produit');
        $this->addSql('DROP TABLE enrobage');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE point_de_vente');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produits_variants');
        $this->addSql('DROP TABLE utilisateur');
    }
}
