<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240926143958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enrobage (id_enrobage INT AUTO_INCREMENT NOT NULL, id_image INT DEFAULT NULL, nom_enrobage VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_B476FC702BB8456F (id_image), PRIMARY KEY(id_enrobage)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enrobage ADD CONSTRAINT FK_B476FC702BB8456F FOREIGN KEY (id_image) REFERENCES image (id_image)');
        $this->addSql('ALTER TABLE produits_variants ADD id_enrobage INT NOT NULL');
        $this->addSql('ALTER TABLE produits_variants ADD CONSTRAINT FK_4CAEAB33E4AD10E5 FOREIGN KEY (id_enrobage) REFERENCES enrobage (id_enrobage)');
        $this->addSql('CREATE INDEX IDX_4CAEAB33E4AD10E5 ON produits_variants (id_enrobage)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits_variants DROP FOREIGN KEY FK_4CAEAB33E4AD10E5');
        $this->addSql('ALTER TABLE enrobage DROP FOREIGN KEY FK_B476FC702BB8456F');
        $this->addSql('DROP TABLE enrobage');
        $this->addSql('DROP INDEX IDX_4CAEAB33E4AD10E5 ON produits_variants');
        $this->addSql('ALTER TABLE produits_variants DROP id_enrobage');
    }
}
