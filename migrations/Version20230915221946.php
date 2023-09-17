<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230915221946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_artiste_film ADD role_id INT DEFAULT NULL, DROP role');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67DD60322AC FOREIGN KEY (role_id) REFERENCES metier (id)');
        $this->addSql('CREATE INDEX IDX_8EDAB67DD60322AC ON role_artiste_film (role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67DD60322AC');
        $this->addSql('DROP INDEX IDX_8EDAB67DD60322AC ON role_artiste_film');
        $this->addSql('ALTER TABLE role_artiste_film ADD role LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', DROP role_id');
    }
}
