<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230923213745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compositeurs_artistes3 (album_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_26EC466F1137ABCF (album_id), INDEX IDX_26EC466F21D25844 (artiste_id), PRIMARY KEY(album_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producteurs_artistes3 (album_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_D14DBB081137ABCF (album_id), INDEX IDX_D14DBB0821D25844 (artiste_id), PRIMARY KEY(album_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compositeurs_artistes3 ADD CONSTRAINT FK_26EC466F1137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compositeurs_artistes3 ADD CONSTRAINT FK_26EC466F21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producteurs_artistes3 ADD CONSTRAINT FK_D14DBB081137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE producteurs_artistes3 ADD CONSTRAINT FK_D14DBB0821D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_artiste DROP FOREIGN KEY FK_C9D0685D1137ABCF');
        $this->addSql('ALTER TABLE album_artiste DROP FOREIGN KEY FK_C9D0685D21D25844');
        $this->addSql('ALTER TABLE artiste_album DROP FOREIGN KEY FK_4DB174BD1137ABCF');
        $this->addSql('ALTER TABLE artiste_album DROP FOREIGN KEY FK_4DB174BD21D25844');
        $this->addSql('DROP TABLE album_artiste');
        $this->addSql('DROP TABLE artiste_album');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album_artiste (album_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_C9D0685D21D25844 (artiste_id), INDEX IDX_C9D0685D1137ABCF (album_id), PRIMARY KEY(album_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE artiste_album (artiste_id INT NOT NULL, album_id INT NOT NULL, INDEX IDX_4DB174BD21D25844 (artiste_id), INDEX IDX_4DB174BD1137ABCF (album_id), PRIMARY KEY(artiste_id, album_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE album_artiste ADD CONSTRAINT FK_C9D0685D1137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_artiste ADD CONSTRAINT FK_C9D0685D21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_album ADD CONSTRAINT FK_4DB174BD1137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_album ADD CONSTRAINT FK_4DB174BD21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE compositeurs_artistes3 DROP FOREIGN KEY FK_26EC466F1137ABCF');
        $this->addSql('ALTER TABLE compositeurs_artistes3 DROP FOREIGN KEY FK_26EC466F21D25844');
        $this->addSql('ALTER TABLE producteurs_artistes3 DROP FOREIGN KEY FK_D14DBB081137ABCF');
        $this->addSql('ALTER TABLE producteurs_artistes3 DROP FOREIGN KEY FK_D14DBB0821D25844');
        $this->addSql('DROP TABLE compositeurs_artistes3');
        $this->addSql('DROP TABLE producteurs_artistes3');
    }
}
