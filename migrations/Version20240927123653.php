<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240927123653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_actualite (id_article INT AUTO_INCREMENT NOT NULL, id_image INT DEFAULT NULL, nom_article VARCHAR(255) NOT NULL, resume LONGTEXT NOT NULL, corps LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, etat VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8EA7D1B32BB8456F (id_image), PRIMARY KEY(id_article)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_actualite ADD CONSTRAINT FK_8EA7D1B32BB8456F FOREIGN KEY (id_image) REFERENCES image (id_image)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_actualite DROP FOREIGN KEY FK_8EA7D1B32BB8456F');
        $this->addSql('DROP TABLE article_actualite');
    }
}
