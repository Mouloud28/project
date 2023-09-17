<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230910204558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role_artiste_film (id INT AUTO_INCREMENT NOT NULL, artiste_id INT DEFAULT NULL, film_id INT DEFAULT NULL, role VARCHAR(255) NOT NULL, INDEX IDX_8EDAB67D21D25844 (artiste_id), INDEX IDX_8EDAB67D567F5183 (film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67D21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67D567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67D21D25844');
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67D567F5183');
        $this->addSql('DROP TABLE role_artiste_film');
    }
}
