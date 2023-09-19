<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919074635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE realisateurs_artistes (film_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_319CC93567F5183 (film_id), INDEX IDX_319CC9321D25844 (artiste_id), PRIMARY KEY(film_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producteurs_artistes (film_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_F9B689B1567F5183 (film_id), INDEX IDX_F9B689B121D25844 (artiste_id), PRIMARY KEY(film_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scenaristes_artistes (film_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_A45BFB56567F5183 (film_id), INDEX IDX_A45BFB5621D25844 (artiste_id), PRIMARY KEY(film_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE casting_artiste (film_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_E4E893AB567F5183 (film_id), INDEX IDX_E4E893AB21D25844 (artiste_id), PRIMARY KEY(film_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compositeurs_artistes (film_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_3A1CB325567F5183 (film_id), INDEX IDX_3A1CB32521D25844 (artiste_id), PRIMARY KEY(film_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE realisateurs_artistes ADD CONSTRAINT FK_319CC93567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE realisateurs_artistes ADD CONSTRAINT FK_319CC9321D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producteurs_artistes ADD CONSTRAINT FK_F9B689B1567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producteurs_artistes ADD CONSTRAINT FK_F9B689B121D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE scenaristes_artistes ADD CONSTRAINT FK_A45BFB56567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE scenaristes_artistes ADD CONSTRAINT FK_A45BFB5621D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE casting_artiste ADD CONSTRAINT FK_E4E893AB567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE casting_artiste ADD CONSTRAINT FK_E4E893AB21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compositeurs_artistes ADD CONSTRAINT FK_3A1CB325567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compositeurs_artistes ADD CONSTRAINT FK_3A1CB32521D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_film DROP FOREIGN KEY FK_1A8CDAA121D25844');
        $this->addSql('ALTER TABLE artiste_film DROP FOREIGN KEY FK_1A8CDAA1567F5183');
        $this->addSql('DROP TABLE artiste_film');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiste_film (artiste_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_1A8CDAA121D25844 (artiste_id), INDEX IDX_1A8CDAA1567F5183 (film_id), PRIMARY KEY(artiste_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE artiste_film ADD CONSTRAINT FK_1A8CDAA121D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE artiste_film ADD CONSTRAINT FK_1A8CDAA1567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE realisateurs_artistes DROP FOREIGN KEY FK_319CC93567F5183');
        $this->addSql('ALTER TABLE realisateurs_artistes DROP FOREIGN KEY FK_319CC9321D25844');
        $this->addSql('ALTER TABLE producteurs_artistes DROP FOREIGN KEY FK_F9B689B1567F5183');
        $this->addSql('ALTER TABLE producteurs_artistes DROP FOREIGN KEY FK_F9B689B121D25844');
        $this->addSql('ALTER TABLE scenaristes_artistes DROP FOREIGN KEY FK_A45BFB56567F5183');
        $this->addSql('ALTER TABLE scenaristes_artistes DROP FOREIGN KEY FK_A45BFB5621D25844');
        $this->addSql('ALTER TABLE casting_artiste DROP FOREIGN KEY FK_E4E893AB567F5183');
        $this->addSql('ALTER TABLE casting_artiste DROP FOREIGN KEY FK_E4E893AB21D25844');
        $this->addSql('ALTER TABLE compositeurs_artistes DROP FOREIGN KEY FK_3A1CB325567F5183');
        $this->addSql('ALTER TABLE compositeurs_artistes DROP FOREIGN KEY FK_3A1CB32521D25844');
        $this->addSql('DROP TABLE realisateurs_artistes');
        $this->addSql('DROP TABLE producteurs_artistes');
        $this->addSql('DROP TABLE scenaristes_artistes');
        $this->addSql('DROP TABLE casting_artiste');
        $this->addSql('DROP TABLE compositeurs_artistes');
    }
}
