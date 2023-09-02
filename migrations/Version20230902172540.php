<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230902172540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE editeur_livre (editeur_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_FDED6D5C3375BD21 (editeur_id), INDEX IDX_FDED6D5C37D925CB (livre_id), PRIMARY KEY(editeur_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_editeur (livre_id INT NOT NULL, editeur_id INT NOT NULL, INDEX IDX_C8D403BB37D925CB (livre_id), INDEX IDX_C8D403BB3375BD21 (editeur_id), PRIMARY KEY(livre_id, editeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE editeur_livre ADD CONSTRAINT FK_FDED6D5C3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editeur_livre ADD CONSTRAINT FK_FDED6D5C37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_editeur ADD CONSTRAINT FK_C8D403BB37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_editeur ADD CONSTRAINT FK_C8D403BB3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE editeur_livre DROP FOREIGN KEY FK_FDED6D5C3375BD21');
        $this->addSql('ALTER TABLE editeur_livre DROP FOREIGN KEY FK_FDED6D5C37D925CB');
        $this->addSql('ALTER TABLE livre_editeur DROP FOREIGN KEY FK_C8D403BB37D925CB');
        $this->addSql('ALTER TABLE livre_editeur DROP FOREIGN KEY FK_C8D403BB3375BD21');
        $this->addSql('DROP TABLE editeur_livre');
        $this->addSql('DROP TABLE livre_editeur');
    }
}
