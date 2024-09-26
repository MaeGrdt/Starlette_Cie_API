<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240926142125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits_variants ADD id_variant INT AUTO_INCREMENT NOT NULL, DROP id, ADD PRIMARY KEY (id_variant)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits_variants MODIFY id_variant INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON produits_variants');
        $this->addSql('ALTER TABLE produits_variants ADD id INT NOT NULL, DROP id_variant');
    }
}
