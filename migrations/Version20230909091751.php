<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230909091751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album_artiste (album_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_C9D0685D1137ABCF (album_id), INDEX IDX_C9D0685D21D25844 (artiste_id), PRIMARY KEY(album_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album_artiste ADD CONSTRAINT FK_C9D0685D1137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_artiste ADD CONSTRAINT FK_C9D0685D21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album_artiste DROP FOREIGN KEY FK_C9D0685D1137ABCF');
        $this->addSql('ALTER TABLE album_artiste DROP FOREIGN KEY FK_C9D0685D21D25844');
        $this->addSql('DROP TABLE album_artiste');
    }
}
