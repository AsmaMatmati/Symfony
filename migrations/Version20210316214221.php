<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210316214221 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation CHANGE date_c date_c DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ordonnance ADD nbr_jrs INT NOT NULL, ADD nbr_doses DOUBLE PRECISION NOT NULL, ADD nbr_fois INT NOT NULL, ADD nbr_paquets INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation CHANGE date_c date_c DATE NOT NULL');
        $this->addSql('ALTER TABLE ordonnance DROP nbr_jrs, DROP nbr_doses, DROP nbr_fois, DROP nbr_paquets');
    }
}
