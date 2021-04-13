<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210410203133 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, nom_medecin VARCHAR(255) NOT NULL, prenom_med VARCHAR(255) NOT NULL, num_tel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medicament ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723ABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_9A9C723ABCF5E72D ON medicament (categorie_id)');
        $this->addSql('ALTER TABLE ordonnance ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326CBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_924B326CBCF5E72D ON ordonnance (categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723ABCF5E72D');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326CBCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP INDEX IDX_9A9C723ABCF5E72D ON medicament');
        $this->addSql('ALTER TABLE medicament DROP categorie_id');
        $this->addSql('DROP INDEX IDX_924B326CBCF5E72D ON ordonnance');
        $this->addSql('ALTER TABLE ordonnance DROP categorie_id');
    }
}
