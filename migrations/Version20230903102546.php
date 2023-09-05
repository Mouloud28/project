<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230903102546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, livre_id INT NOT NULL, editeur_id INT NOT NULL, pays VARCHAR(255) NOT NULL, INDEX IDX_AF3C677937D925CB (livre_id), INDEX IDX_AF3C67793375BD21 (editeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C677937D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C67793375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C677937D925CB');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C67793375BD21');
        $this->addSql('DROP TABLE publication');
    }
}
