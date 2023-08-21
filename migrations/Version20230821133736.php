<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230821133736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, objet VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, fichier VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album ADD forum_id INT NOT NULL');
        $this->addSql('ALTER TABLE album ADD CONSTRAINT FK_39986E4329CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id)');
        $this->addSql('CREATE INDEX IDX_39986E4329CCBAD0 ON album (forum_id)');
        $this->addSql('ALTER TABLE article ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
        $this->addSql('ALTER TABLE film ADD forum_id INT NOT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE2229CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id)');
        $this->addSql('CREATE INDEX IDX_8244BE2229CCBAD0 ON film (forum_id)');
        $this->addSql('ALTER TABLE livre ADD forum_id INT NOT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F9929CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id)');
        $this->addSql('CREATE INDEX IDX_AC634F9929CCBAD0 ON livre (forum_id)');
        $this->addSql('ALTER TABLE serie ADD forum_id INT NOT NULL');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A933429CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id)');
        $this->addSql('CREATE INDEX IDX_AA3A933429CCBAD0 ON serie (forum_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE album DROP FOREIGN KEY FK_39986E4329CCBAD0');
        $this->addSql('DROP INDEX IDX_39986E4329CCBAD0 ON album');
        $this->addSql('ALTER TABLE album DROP forum_id');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66A76ED395');
        $this->addSql('DROP INDEX IDX_23A0E66A76ED395 ON article');
        $this->addSql('ALTER TABLE article DROP user_id');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE2229CCBAD0');
        $this->addSql('DROP INDEX IDX_8244BE2229CCBAD0 ON film');
        $this->addSql('ALTER TABLE film DROP forum_id');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F9929CCBAD0');
        $this->addSql('DROP INDEX IDX_AC634F9929CCBAD0 ON livre');
        $this->addSql('ALTER TABLE livre DROP forum_id');
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A933429CCBAD0');
        $this->addSql('DROP INDEX IDX_AA3A933429CCBAD0 ON serie');
        $this->addSql('ALTER TABLE serie DROP forum_id');
    }
}
