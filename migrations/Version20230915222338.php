<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230915222338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role_artiste_film_metier (role_artiste_film_id INT NOT NULL, metier_id INT NOT NULL, INDEX IDX_277C0D7CEEF10C49 (role_artiste_film_id), INDEX IDX_277C0D7CED16FA20 (metier_id), PRIMARY KEY(role_artiste_film_id, metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role_artiste_film_metier ADD CONSTRAINT FK_277C0D7CEEF10C49 FOREIGN KEY (role_artiste_film_id) REFERENCES role_artiste_film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_artiste_film_metier ADD CONSTRAINT FK_277C0D7CED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_artiste_film DROP FOREIGN KEY FK_8EDAB67DD60322AC');
        $this->addSql('DROP INDEX IDX_8EDAB67DD60322AC ON role_artiste_film');
        $this->addSql('ALTER TABLE role_artiste_film DROP role_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_artiste_film_metier DROP FOREIGN KEY FK_277C0D7CEEF10C49');
        $this->addSql('ALTER TABLE role_artiste_film_metier DROP FOREIGN KEY FK_277C0D7CED16FA20');
        $this->addSql('DROP TABLE role_artiste_film_metier');
        $this->addSql('ALTER TABLE role_artiste_film ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE role_artiste_film ADD CONSTRAINT FK_8EDAB67DD60322AC FOREIGN KEY (role_id) REFERENCES metier (id)');
        $this->addSql('CREATE INDEX IDX_8EDAB67DD60322AC ON role_artiste_film (role_id)');
    }
}
