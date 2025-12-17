<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251130155737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE esport ADD membres LONGTEXT DEFAULT NULL, ADD membres_link VARCHAR(255) DEFAULT NULL, DROP game, CHANGE taille_equipe taille_equipe INT NOT NULL, CHANGE palmares palmares LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE esport ADD game VARCHAR(255) NOT NULL, DROP membres, DROP membres_link, CHANGE taille_equipe taille_equipe VARCHAR(255) NOT NULL, CHANGE palmares palmares VARCHAR(255) DEFAULT NULL');
    }
}
