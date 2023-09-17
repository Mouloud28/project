<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230915204828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film DROP scenariste, DROP producteur, DROP casting, DROP compositeur');
        $this->addSql('ALTER TABLE role_artiste_film ADD film2_id INT DEFAULT NULL, ADD film3_id INT DEFAULT NULL, ADD film4_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67DB03E2FB6 FOREIGN KEY (film2_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67D88248D3 FOREIGN KEY (film3_id) REFERENCES film (id)');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67D9555706A FOREIGN KEY (film4_id) REFERENCES film (id)');
        $this->addSql('CREATE INDEX IDX_8EDAB67DB03E2FB6 ON role_artiste_film (film2_id)');
        $this->addSql('CREATE INDEX IDX_8EDAB67D88248D3 ON role_artiste_film (film3_id)');
        $this->addSql('CREATE INDEX IDX_8EDAB67D9555706A ON role_artiste_film (film4_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film ADD scenariste VARCHAR(255) NOT NULL, ADD producteur VARCHAR(255) NOT NULL, ADD casting VARCHAR(255) NOT NULL, ADD compositeur VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67DB03E2FB6');
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67D88248D3');
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67D9555706A');
        $this->addSql('DROP INDEX IDX_8EDAB67DB03E2FB6 ON role_artiste_film');
        $this->addSql('DROP INDEX IDX_8EDAB67D88248D3 ON role_artiste_film');
        $this->addSql('DROP INDEX IDX_8EDAB67D9555706A ON role_artiste_film');
        $this->addSql('ALTER TABLE role_artiste_film DROP film2_id, DROP film3_id, DROP film4_id');
    }
}
