<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230915212556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_artiste_film ADD film5_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67D2DE9170F FOREIGN KEY (film5_id) REFERENCES film (id)');
        $this->addSql('CREATE INDEX IDX_8EDAB67D2DE9170F ON role_artiste_film (film5_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67D2DE9170F');
        $this->addSql('DROP INDEX IDX_8EDAB67D2DE9170F ON role_artiste_film');
        $this->addSql('ALTER TABLE role_artiste_film DROP film5_id');
    }
}
