<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230829081840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AB3CDB74');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E7A1254A');
        $this->addSql('DROP TABLE conditions_generales_utilisation');
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE livre CHANGE categorie_id categorie_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_8D93D649E7A1254A ON user');
        $this->addSql('DROP INDEX IDX_8D93D649AB3CDB74 ON user');
        $this->addSql('ALTER TABLE user DROP contact_id, DROP conditions_generales_utilisation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conditions_generales_utilisation (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, introduction LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, objet VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, fichier VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livre CHANGE categorie_id categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD contact_id INT DEFAULT NULL, ADD conditions_generales_utilisation_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AB3CDB74 FOREIGN KEY (conditions_generales_utilisation_id) REFERENCES conditions_generales_utilisation (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E7A1254A ON user (contact_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649AB3CDB74 ON user (conditions_generales_utilisation_id)');
    }
}
