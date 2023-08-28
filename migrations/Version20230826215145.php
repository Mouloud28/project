<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230826215145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste CHANGE photo photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE artiste_film DROP FOREIGN KEY FK_1A8CDAA121D25844');
        $this->addSql('ALTER TABLE artiste_film ADD CONSTRAINT FK_1A8CDAA121D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE artiste_serie DROP FOREIGN KEY FK_DE1389CA21D25844');
        $this->addSql('ALTER TABLE artiste_serie ADD CONSTRAINT FK_DE1389CA21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE artiste_album DROP FOREIGN KEY FK_4DB174BD21D25844');
        $this->addSql('ALTER TABLE artiste_album ADD CONSTRAINT FK_4DB174BD21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE artiste_livre DROP FOREIGN KEY FK_D84A556721D25844');
        $this->addSql('ALTER TABLE artiste_livre ADD CONSTRAINT FK_D84A556721D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste CHANGE photo photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE artiste_album DROP FOREIGN KEY FK_4DB174BD21D25844');
        $this->addSql('ALTER TABLE artiste_album ADD CONSTRAINT FK_4DB174BD21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_film DROP FOREIGN KEY FK_1A8CDAA121D25844');
        $this->addSql('ALTER TABLE artiste_film ADD CONSTRAINT FK_1A8CDAA121D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_livre DROP FOREIGN KEY FK_D84A556721D25844');
        $this->addSql('ALTER TABLE artiste_livre ADD CONSTRAINT FK_D84A556721D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste_serie DROP FOREIGN KEY FK_DE1389CA21D25844');
        $this->addSql('ALTER TABLE artiste_serie ADD CONSTRAINT FK_DE1389CA21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
    }
}
