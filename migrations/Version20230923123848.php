<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230923123848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_artiste (film_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_7CB92E6C567F5183 (film_id), INDEX IDX_7CB92E6C21D25844 (artiste_id), PRIMARY KEY(film_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie_artiste (serie_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_A89E46E8D94388BD (serie_id), INDEX IDX_A89E46E821D25844 (artiste_id), PRIMARY KEY(serie_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_artiste ADD CONSTRAINT FK_7CB92E6C567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_artiste ADD CONSTRAINT FK_7CB92E6C21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_artiste ADD CONSTRAINT FK_A89E46E8D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE serie_artiste ADD CONSTRAINT FK_A89E46E821D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_artiste DROP FOREIGN KEY FK_7CB92E6C567F5183');
        $this->addSql('ALTER TABLE film_artiste DROP FOREIGN KEY FK_7CB92E6C21D25844');
        $this->addSql('ALTER TABLE serie_artiste DROP FOREIGN KEY FK_A89E46E8D94388BD');
        $this->addSql('ALTER TABLE serie_artiste DROP FOREIGN KEY FK_A89E46E821D25844');
        $this->addSql('DROP TABLE film_artiste');
        $this->addSql('DROP TABLE serie_artiste');
    }
}
