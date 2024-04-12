<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240411034249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO driver values(1, "Fabian", "Lopez", "A")');
        $this->addSql('INSERT INTO vehicle values(1, "Honda", "CR-V", "D5F-34", "A")');
        $this->addSql('INSERT INTO driver values(2, "Felipe", "Reyes", "B")');
        $this->addSql('INSERT INTO vehicle values(2, "Jeep", "Avenger", "SE6-U4", "B")');
        $this->addSql('INSERT INTO driver values(3, "Julia", "Miranda", "C")');
        $this->addSql('INSERT INTO vehicle values(3, "Ford", "Fiesta", "4GT-TY", "C")');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE driver');
        $this->addSql('TRUNCATE TABLE vehicle');
    }
}
