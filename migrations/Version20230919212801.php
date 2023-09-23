<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919212801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE createurs_artistes (serie_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_B0FDF9FED94388BD (serie_id), INDEX IDX_B0FDF9FE21D25844 (artiste_id), PRIMARY KEY(serie_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producteurs_artistes2 (serie_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_A64A8B9ED94388BD (serie_id), INDEX IDX_A64A8B9E21D25844 (artiste_id), PRIMARY KEY(serie_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scenaristes_artistes2 (serie_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_98791137D94388BD (serie_id), INDEX IDX_9879113721D25844 (artiste_id), PRIMARY KEY(serie_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE casting_artiste2 (serie_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_5B352CFED94388BD (serie_id), INDEX IDX_5B352CFE21D25844 (artiste_id), PRIMARY KEY(serie_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compositeurs_artistes2 (serie_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_51EB76F9D94388BD (serie_id), INDEX IDX_51EB76F921D25844 (artiste_id), PRIMARY KEY(serie_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE createurs_artistes ADD CONSTRAINT FK_B0FDF9FED94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE createurs_artistes ADD CONSTRAINT FK_B0FDF9FE21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producteurs_artistes2 ADD CONSTRAINT FK_A64A8B9ED94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producteurs_artistes2 ADD CONSTRAINT FK_A64A8B9E21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE scenaristes_artistes2 ADD CONSTRAINT FK_98791137D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE scenaristes_artistes2 ADD CONSTRAINT FK_9879113721D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE casting_artiste2 ADD CONSTRAINT FK_5B352CFED94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE casting_artiste2 ADD CONSTRAINT FK_5B352CFE21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compositeurs_artistes2 ADD CONSTRAINT FK_51EB76F9D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compositeurs_artistes2 ADD CONSTRAINT FK_51EB76F921D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_serie DROP FOREIGN KEY FK_DE1389CA21D25844');
        $this->addSql('ALTER TABLE artiste_serie DROP FOREIGN KEY FK_DE1389CAD94388BD');
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67D567F5183');
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67DB03E2FB6');
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67D21D25844');
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67D88248D3');
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67D2DE9170F');
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67D9555706A');
        $this->addSql('ALTER TABLE role_artiste_film_metier DROP FOREIGN KEY FK_277C0D7CEEF10C49');
        $this->addSql('ALTER TABLE role_artiste_film_metier DROP FOREIGN KEY FK_277C0D7CED16FA20');
        $this->addSql('DROP TABLE artiste_serie');
        $this->addSql('DROP TABLE role_artiste_film');
        $this->addSql('DROP TABLE role_artiste_film_metier');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiste_serie (artiste_id INT NOT NULL, serie_id INT NOT NULL, INDEX IDX_DE1389CA21D25844 (artiste_id), INDEX IDX_DE1389CAD94388BD (serie_id), PRIMARY KEY(artiste_id, serie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE role_artiste_film (id INT AUTO_INCREMENT NOT NULL, artiste_id INT DEFAULT NULL, film_id INT DEFAULT NULL, film2_id INT DEFAULT NULL, film3_id INT DEFAULT NULL, film4_id INT DEFAULT NULL, film5_id INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8EDAB67D88248D3 (film3_id), INDEX IDX_8EDAB67D21D25844 (artiste_id), INDEX IDX_8EDAB67D9555706A (film4_id), INDEX IDX_8EDAB67D567F5183 (film_id), INDEX IDX_8EDAB67D2DE9170F (film5_id), INDEX IDX_8EDAB67DB03E2FB6 (film2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE role_artiste_film_metier (role_artiste_film_id INT NOT NULL, metier_id INT NOT NULL, INDEX IDX_277C0D7CED16FA20 (metier_id), INDEX IDX_277C0D7CEEF10C49 (role_artiste_film_id), PRIMARY KEY(role_artiste_film_id, metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE artiste_serie ADD CONSTRAINT FK_DE1389CA21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE artiste_serie ADD CONSTRAINT FK_DE1389CAD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67D567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67DB03E2FB6 FOREIGN KEY (film2_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67D21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67D88248D3 FOREIGN KEY (film3_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67D2DE9170F FOREIGN KEY (film5_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67D9555706A FOREIGN KEY (film4_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE role_artiste_film_metier ADD CONSTRAINT FK_277C0D7CEEF10C49 FOREIGN KEY (role_artiste_film_id) REFERENCES role_artiste_film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_artiste_film_metier ADD CONSTRAINT FK_277C0D7CED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE createurs_artistes DROP FOREIGN KEY FK_B0FDF9FED94388BD');
        $this->addSql('ALTER TABLE createurs_artistes DROP FOREIGN KEY FK_B0FDF9FE21D25844');
        $this->addSql('ALTER TABLE producteurs_artistes2 DROP FOREIGN KEY FK_A64A8B9ED94388BD');
        $this->addSql('ALTER TABLE producteurs_artistes2 DROP FOREIGN KEY FK_A64A8B9E21D25844');
        $this->addSql('ALTER TABLE scenaristes_artistes2 DROP FOREIGN KEY FK_98791137D94388BD');
        $this->addSql('ALTER TABLE scenaristes_artistes2 DROP FOREIGN KEY FK_9879113721D25844');
        $this->addSql('ALTER TABLE casting_artiste2 DROP FOREIGN KEY FK_5B352CFED94388BD');
        $this->addSql('ALTER TABLE casting_artiste2 DROP FOREIGN KEY FK_5B352CFE21D25844');
        $this->addSql('ALTER TABLE compositeurs_artistes2 DROP FOREIGN KEY FK_51EB76F9D94388BD');
        $this->addSql('ALTER TABLE compositeurs_artistes2 DROP FOREIGN KEY FK_51EB76F921D25844');
        $this->addSql('DROP TABLE createurs_artistes');
        $this->addSql('DROP TABLE producteurs_artistes2');
        $this->addSql('DROP TABLE scenaristes_artistes2');
        $this->addSql('DROP TABLE casting_artiste2');
        $this->addSql('DROP TABLE compositeurs_artistes2');
    }
}
