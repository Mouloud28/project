<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919095303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteurs_artistes (livre_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_9CB780CB37D925CB (livre_id), INDEX IDX_9CB780CB21D25844 (artiste_id), PRIMARY KEY(livre_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traducteurs_artistes (livre_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_AE76706137D925CB (livre_id), INDEX IDX_AE76706121D25844 (artiste_id), PRIMARY KEY(livre_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteurs_artistes ADD CONSTRAINT FK_9CB780CB37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE auteurs_artistes ADD CONSTRAINT FK_9CB780CB21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE traducteurs_artistes ADD CONSTRAINT FK_AE76706137D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE traducteurs_artistes ADD CONSTRAINT FK_AE76706121D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_livre DROP FOREIGN KEY FK_D84A556721D25844');
        $this->addSql('ALTER TABLE artiste_livre DROP FOREIGN KEY FK_D84A556737D925CB');
        $this->addSql('ALTER TABLE livre_artiste DROP FOREIGN KEY FK_5174711B21D25844');
        $this->addSql('ALTER TABLE livre_artiste DROP FOREIGN KEY FK_5174711B37D925CB');
        $this->addSql('DROP TABLE artiste_livre');
        $this->addSql('DROP TABLE livre_artiste');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiste_livre (artiste_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_D84A556721D25844 (artiste_id), INDEX IDX_D84A556737D925CB (livre_id), PRIMARY KEY(artiste_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livre_artiste (livre_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_5174711B37D925CB (livre_id), INDEX IDX_5174711B21D25844 (artiste_id), PRIMARY KEY(livre_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE artiste_livre ADD CONSTRAINT FK_D84A556721D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE artiste_livre ADD CONSTRAINT FK_D84A556737D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_artiste ADD CONSTRAINT FK_5174711B21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_artiste ADD CONSTRAINT FK_5174711B37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE auteurs_artistes DROP FOREIGN KEY FK_9CB780CB37D925CB');
        $this->addSql('ALTER TABLE auteurs_artistes DROP FOREIGN KEY FK_9CB780CB21D25844');
        $this->addSql('ALTER TABLE traducteurs_artistes DROP FOREIGN KEY FK_AE76706137D925CB');
        $this->addSql('ALTER TABLE traducteurs_artistes DROP FOREIGN KEY FK_AE76706121D25844');
        $this->addSql('DROP TABLE auteurs_artistes');
        $this->addSql('DROP TABLE traducteurs_artistes');
    }
}
