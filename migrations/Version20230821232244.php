<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230821232244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiste_film (artiste_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_1A8CDAA121D25844 (artiste_id), INDEX IDX_1A8CDAA1567F5183 (film_id), PRIMARY KEY(artiste_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artiste_serie (artiste_id INT NOT NULL, serie_id INT NOT NULL, INDEX IDX_DE1389CA21D25844 (artiste_id), INDEX IDX_DE1389CAD94388BD (serie_id), PRIMARY KEY(artiste_id, serie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artiste_album (artiste_id INT NOT NULL, album_id INT NOT NULL, INDEX IDX_4DB174BD21D25844 (artiste_id), INDEX IDX_4DB174BD1137ABCF (album_id), PRIMARY KEY(artiste_id, album_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artiste_livre (artiste_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_D84A556721D25844 (artiste_id), INDEX IDX_D84A556737D925CB (livre_id), PRIMARY KEY(artiste_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editeur_livre (editeur_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_FDED6D5C3375BD21 (editeur_id), INDEX IDX_FDED6D5C37D925CB (livre_id), PRIMARY KEY(editeur_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre_livre (genre_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_1165505C4296D31F (genre_id), INDEX IDX_1165505C37D925CB (livre_id), PRIMARY KEY(genre_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre_film (genre_id INT NOT NULL, film_id INT NOT NULL, INDEX IDX_39A967D24296D31F (genre_id), INDEX IDX_39A967D2567F5183 (film_id), PRIMARY KEY(genre_id, film_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre_serie (genre_id INT NOT NULL, serie_id INT NOT NULL, INDEX IDX_173C8CF14296D31F (genre_id), INDEX IDX_173C8CF1D94388BD (serie_id), PRIMARY KEY(genre_id, serie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre_album (genre_id INT NOT NULL, album_id INT NOT NULL, INDEX IDX_849E71864296D31F (genre_id), INDEX IDX_849E71861137ABCF (album_id), PRIMARY KEY(genre_id, album_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier_artiste (metier_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_9163D2F2ED16FA20 (metier_id), INDEX IDX_9163D2F221D25844 (artiste_id), PRIMARY KEY(metier_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artiste_film ADD CONSTRAINT FK_1A8CDAA121D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_film ADD CONSTRAINT FK_1A8CDAA1567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_serie ADD CONSTRAINT FK_DE1389CA21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_serie ADD CONSTRAINT FK_DE1389CAD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_album ADD CONSTRAINT FK_4DB174BD21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_album ADD CONSTRAINT FK_4DB174BD1137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_livre ADD CONSTRAINT FK_D84A556721D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_livre ADD CONSTRAINT FK_D84A556737D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editeur_livre ADD CONSTRAINT FK_FDED6D5C3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editeur_livre ADD CONSTRAINT FK_FDED6D5C37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_livre ADD CONSTRAINT FK_1165505C4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_livre ADD CONSTRAINT FK_1165505C37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_film ADD CONSTRAINT FK_39A967D24296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_film ADD CONSTRAINT FK_39A967D2567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_serie ADD CONSTRAINT FK_173C8CF14296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_serie ADD CONSTRAINT FK_173C8CF1D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_album ADD CONSTRAINT FK_849E71864296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_album ADD CONSTRAINT FK_849E71861137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_artiste ADD CONSTRAINT FK_9163D2F2ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_artiste ADD CONSTRAINT FK_9163D2F221D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste ADD ville_id INT NOT NULL');
        $this->addSql('ALTER TABLE artiste ADD CONSTRAINT FK_9C07354FA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_9C07354FA73F0036 ON artiste (ville_id)');
        $this->addSql('ALTER TABLE categorie ADD forum_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD63429CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id)');
        $this->addSql('CREATE INDEX IDX_497DD63429CCBAD0 ON categorie (forum_id)');
        $this->addSql('ALTER TABLE critique ADD livre_id INT DEFAULT NULL, ADD film_id INT DEFAULT NULL, ADD serie_id INT DEFAULT NULL, ADD album_id INT DEFAULT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE critique ADD CONSTRAINT FK_1F95032437D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE critique ADD CONSTRAINT FK_1F950324567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE critique ADD CONSTRAINT FK_1F950324D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE critique ADD CONSTRAINT FK_1F9503241137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE critique ADD CONSTRAINT FK_1F950324A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1F95032437D925CB ON critique (livre_id)');
        $this->addSql('CREATE INDEX IDX_1F950324567F5183 ON critique (film_id)');
        $this->addSql('CREATE INDEX IDX_1F950324D94388BD ON critique (serie_id)');
        $this->addSql('CREATE INDEX IDX_1F9503241137ABCF ON critique (album_id)');
        $this->addSql('CREATE INDEX IDX_1F950324A76ED395 ON critique (user_id)');
        $this->addSql('ALTER TABLE livre ADD langue_id INT NOT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F992AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
        $this->addSql('CREATE INDEX IDX_AC634F992AADBACD ON livre (langue_id)');
        $this->addSql('ALTER TABLE message ADD user_id INT DEFAULT NULL, ADD sujet_id INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F7C4D497E FOREIGN KEY (sujet_id) REFERENCES sujet (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FA76ED395 ON message (user_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F7C4D497E ON message (sujet_id)');
        $this->addSql('ALTER TABLE notation ADD user_id INT NOT NULL, ADD livre_id INT DEFAULT NULL, ADD film_id INT DEFAULT NULL, ADD serie_id INT DEFAULT NULL, ADD album_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notation ADD CONSTRAINT FK_268BC95A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE notation ADD CONSTRAINT FK_268BC9537D925CB FOREIGN KEY (livre_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE notation ADD CONSTRAINT FK_268BC95567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE notation ADD CONSTRAINT FK_268BC95D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE notation ADD CONSTRAINT FK_268BC951137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_268BC95A76ED395 ON notation (user_id)');
        $this->addSql('CREATE INDEX IDX_268BC9537D925CB ON notation (livre_id)');
        $this->addSql('CREATE INDEX IDX_268BC95567F5183 ON notation (film_id)');
        $this->addSql('CREATE INDEX IDX_268BC95D94388BD ON notation (serie_id)');
        $this->addSql('CREATE INDEX IDX_268BC951137ABCF ON notation (album_id)');
        $this->addSql('ALTER TABLE sujet ADD forum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sujet ADD CONSTRAINT FK_2E13599D29CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id)');
        $this->addSql('CREATE INDEX IDX_2E13599D29CCBAD0 ON sujet (forum_id)');
        $this->addSql('ALTER TABLE user ADD contact_id INT DEFAULT NULL, ADD conditions_generales_utilisation_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AB3CDB74 FOREIGN KEY (conditions_generales_utilisation_id) REFERENCES conditions_generales_utilisation (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E7A1254A ON user (contact_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649AB3CDB74 ON user (conditions_generales_utilisation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste_film DROP FOREIGN KEY FK_1A8CDAA121D25844');
        $this->addSql('ALTER TABLE artiste_film DROP FOREIGN KEY FK_1A8CDAA1567F5183');
        $this->addSql('ALTER TABLE artiste_serie DROP FOREIGN KEY FK_DE1389CA21D25844');
        $this->addSql('ALTER TABLE artiste_serie DROP FOREIGN KEY FK_DE1389CAD94388BD');
        $this->addSql('ALTER TABLE artiste_album DROP FOREIGN KEY FK_4DB174BD21D25844');
        $this->addSql('ALTER TABLE artiste_album DROP FOREIGN KEY FK_4DB174BD1137ABCF');
        $this->addSql('ALTER TABLE artiste_livre DROP FOREIGN KEY FK_D84A556721D25844');
        $this->addSql('ALTER TABLE artiste_livre DROP FOREIGN KEY FK_D84A556737D925CB');
        $this->addSql('ALTER TABLE editeur_livre DROP FOREIGN KEY FK_FDED6D5C3375BD21');
        $this->addSql('ALTER TABLE editeur_livre DROP FOREIGN KEY FK_FDED6D5C37D925CB');
        $this->addSql('ALTER TABLE genre_livre DROP FOREIGN KEY FK_1165505C4296D31F');
        $this->addSql('ALTER TABLE genre_livre DROP FOREIGN KEY FK_1165505C37D925CB');
        $this->addSql('ALTER TABLE genre_film DROP FOREIGN KEY FK_39A967D24296D31F');
        $this->addSql('ALTER TABLE genre_film DROP FOREIGN KEY FK_39A967D2567F5183');
        $this->addSql('ALTER TABLE genre_serie DROP FOREIGN KEY FK_173C8CF14296D31F');
        $this->addSql('ALTER TABLE genre_serie DROP FOREIGN KEY FK_173C8CF1D94388BD');
        $this->addSql('ALTER TABLE genre_album DROP FOREIGN KEY FK_849E71864296D31F');
        $this->addSql('ALTER TABLE genre_album DROP FOREIGN KEY FK_849E71861137ABCF');
        $this->addSql('ALTER TABLE metier_artiste DROP FOREIGN KEY FK_9163D2F2ED16FA20');
        $this->addSql('ALTER TABLE metier_artiste DROP FOREIGN KEY FK_9163D2F221D25844');
        $this->addSql('DROP TABLE artiste_film');
        $this->addSql('DROP TABLE artiste_serie');
        $this->addSql('DROP TABLE artiste_album');
        $this->addSql('DROP TABLE artiste_livre');
        $this->addSql('DROP TABLE editeur_livre');
        $this->addSql('DROP TABLE genre_livre');
        $this->addSql('DROP TABLE genre_film');
        $this->addSql('DROP TABLE genre_serie');
        $this->addSql('DROP TABLE genre_album');
        $this->addSql('DROP TABLE metier_artiste');
        $this->addSql('ALTER TABLE artiste DROP FOREIGN KEY FK_9C07354FA73F0036');
        $this->addSql('DROP INDEX IDX_9C07354FA73F0036 ON artiste');
        $this->addSql('ALTER TABLE artiste DROP ville_id');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD63429CCBAD0');
        $this->addSql('DROP INDEX IDX_497DD63429CCBAD0 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP forum_id');
        $this->addSql('ALTER TABLE critique DROP FOREIGN KEY FK_1F95032437D925CB');
        $this->addSql('ALTER TABLE critique DROP FOREIGN KEY FK_1F950324567F5183');
        $this->addSql('ALTER TABLE critique DROP FOREIGN KEY FK_1F950324D94388BD');
        $this->addSql('ALTER TABLE critique DROP FOREIGN KEY FK_1F9503241137ABCF');
        $this->addSql('ALTER TABLE critique DROP FOREIGN KEY FK_1F950324A76ED395');
        $this->addSql('DROP INDEX IDX_1F95032437D925CB ON critique');
        $this->addSql('DROP INDEX IDX_1F950324567F5183 ON critique');
        $this->addSql('DROP INDEX IDX_1F950324D94388BD ON critique');
        $this->addSql('DROP INDEX IDX_1F9503241137ABCF ON critique');
        $this->addSql('DROP INDEX IDX_1F950324A76ED395 ON critique');
        $this->addSql('ALTER TABLE critique DROP livre_id, DROP film_id, DROP serie_id, DROP album_id, DROP user_id');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F992AADBACD');
        $this->addSql('DROP INDEX IDX_AC634F992AADBACD ON livre');
        $this->addSql('ALTER TABLE livre DROP langue_id');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F7C4D497E');
        $this->addSql('DROP INDEX IDX_B6BD307FA76ED395 ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F7C4D497E ON message');
        $this->addSql('ALTER TABLE message DROP user_id, DROP sujet_id');
        $this->addSql('ALTER TABLE notation DROP FOREIGN KEY FK_268BC95A76ED395');
        $this->addSql('ALTER TABLE notation DROP FOREIGN KEY FK_268BC9537D925CB');
        $this->addSql('ALTER TABLE notation DROP FOREIGN KEY FK_268BC95567F5183');
        $this->addSql('ALTER TABLE notation DROP FOREIGN KEY FK_268BC95D94388BD');
        $this->addSql('ALTER TABLE notation DROP FOREIGN KEY FK_268BC951137ABCF');
        $this->addSql('DROP INDEX IDX_268BC95A76ED395 ON notation');
        $this->addSql('DROP INDEX IDX_268BC9537D925CB ON notation');
        $this->addSql('DROP INDEX IDX_268BC95567F5183 ON notation');
        $this->addSql('DROP INDEX IDX_268BC95D94388BD ON notation');
        $this->addSql('DROP INDEX IDX_268BC951137ABCF ON notation');
        $this->addSql('ALTER TABLE notation DROP user_id, DROP livre_id, DROP film_id, DROP serie_id, DROP album_id');
        $this->addSql('ALTER TABLE sujet DROP FOREIGN KEY FK_2E13599D29CCBAD0');
        $this->addSql('DROP INDEX IDX_2E13599D29CCBAD0 ON sujet');
        $this->addSql('ALTER TABLE sujet DROP forum_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E7A1254A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AB3CDB74');
        $this->addSql('DROP INDEX IDX_8D93D649E7A1254A ON user');
        $this->addSql('DROP INDEX IDX_8D93D649AB3CDB74 ON user');
        $this->addSql('ALTER TABLE user DROP contact_id, DROP conditions_generales_utilisation_id');
    }
}
