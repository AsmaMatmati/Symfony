<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402151741 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ordonnance (id INT AUTO_INCREMENT NOT NULL, medicaments_id INT DEFAULT NULL, consultation_id INT DEFAULT NULL, patient_id INT DEFAULT NULL, users_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, nbr_jrs INT NOT NULL, nbr_doses DOUBLE PRECISION NOT NULL, nbr_fois INT NOT NULL, nbr_paquets INT NOT NULL, INDEX IDX_924B326CC403D7FB (medicaments_id), INDEX IDX_924B326C62FF6CDF (consultation_id), INDEX IDX_924B326C6B899279 (patient_id), INDEX IDX_924B326C67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326CC403D7FB FOREIGN KEY (medicaments_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C62FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ordonnance');
    }
}
