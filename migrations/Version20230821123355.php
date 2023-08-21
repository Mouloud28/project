<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230821123355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E43BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_39986E43BCF5E72D ON album (categorie_id)');
        $this->addSql('ALTER TABLE article ADD film_id INT DEFAULT NULL, ADD serie_id INT DEFAULT NULL, ADD album_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E661137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66567F5183 ON article (film_id)');
        $this->addSql('CREATE INDEX IDX_23A0E66D94388BD ON article (serie_id)');
        $this->addSql('CREATE INDEX IDX_23A0E661137ABCF ON article (album_id)');
        $this->addSql('ALTER TABLE film ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_8244BE22BCF5E72D ON film (categorie_id)');
        $this->addSql('ALTER TABLE livre ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_AC634F99BCF5E72D ON livre (categorie_id)');
        $this->addSql('ALTER TABLE serie ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A9334BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_AA3A9334BCF5E72D ON serie (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E43BCF5E72D');
        $this->addSql('DROP INDEX IDX_39986E43BCF5E72D ON album');
        $this->addSql('ALTER TABLE album DROP categorie_id');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66567F5183');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66D94388BD');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E661137ABCF');
        $this->addSql('DROP INDEX IDX_23A0E66567F5183 ON article');
        $this->addSql('DROP INDEX IDX_23A0E66D94388BD ON article');
        $this->addSql('DROP INDEX IDX_23A0E661137ABCF ON article');
        $this->addSql('ALTER TABLE article DROP film_id, DROP serie_id, DROP album_id');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22BCF5E72D');
        $this->addSql('DROP INDEX IDX_8244BE22BCF5E72D ON film');
        $this->addSql('ALTER TABLE film DROP categorie_id');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99BCF5E72D');
        $this->addSql('DROP INDEX IDX_AC634F99BCF5E72D ON livre');
        $this->addSql('ALTER TABLE livre DROP categorie_id');
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A9334BCF5E72D');
        $this->addSql('DROP INDEX IDX_AA3A9334BCF5E72D ON serie');
        $this->addSql('ALTER TABLE serie DROP categorie_id');
    }
}
