<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230919103054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE editeurs_pays_origine_editeurs (livre_id INT NOT NULL, editeur_id INT NOT NULL, INDEX IDX_CFC334B437D925CB (livre_id), INDEX IDX_CFC334B43375BD21 (editeur_id), PRIMARY KEY(livre_id, editeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editeurs_france_editeurs (livre_id INT NOT NULL, editeur_id INT NOT NULL, INDEX IDX_D9B266A837D925CB (livre_id), INDEX IDX_D9B266A83375BD21 (editeur_id), PRIMARY KEY(livre_id, editeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE editeurs_pays_origine_editeurs ADD CONSTRAINT FK_CFC334B437D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editeurs_pays_origine_editeurs ADD CONSTRAINT FK_CFC334B43375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editeurs_france_editeurs ADD CONSTRAINT FK_D9B266A837D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editeurs_france_editeurs ADD CONSTRAINT FK_D9B266A83375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editeur_livre DROP FOREIGN KEY FK_FDED6D5C3375BD21');
        $this->addSql('ALTER TABLE editeur_livre DROP FOREIGN KEY FK_FDED6D5C37D925CB');
        $this->addSql('ALTER TABLE livre_editeur DROP FOREIGN KEY FK_C8D403BB3375BD21');
        $this->addSql('ALTER TABLE livre_editeur DROP FOREIGN KEY FK_C8D403BB37D925CB');
        $this->addSql('DROP TABLE editeur_livre');
        $this->addSql('DROP TABLE livre_editeur');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE editeur_livre (editeur_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_FDED6D5C37D925CB (livre_id), INDEX IDX_FDED6D5C3375BD21 (editeur_id), PRIMARY KEY(editeur_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livre_editeur (livre_id INT NOT NULL, editeur_id INT NOT NULL, INDEX IDX_C8D403BB37D925CB (livre_id), INDEX IDX_C8D403BB3375BD21 (editeur_id), PRIMARY KEY(livre_id, editeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE editeur_livre ADD CONSTRAINT FK_FDED6D5C3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('ALTER TABLE editeur_livre ADD CONSTRAINT FK_FDED6D5C37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_editeur ADD CONSTRAINT FK_C8D403BB3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_editeur ADD CONSTRAINT FK_C8D403BB37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editeurs_pays_origine_editeurs DROP FOREIGN KEY FK_CFC334B437D925CB');
        $this->addSql('ALTER TABLE editeurs_pays_origine_editeurs DROP FOREIGN KEY FK_CFC334B43375BD21');
        $this->addSql('ALTER TABLE editeurs_france_editeurs DROP FOREIGN KEY FK_D9B266A837D925CB');
        $this->addSql('ALTER TABLE editeurs_france_editeurs DROP FOREIGN KEY FK_D9B266A83375BD21');
        $this->addSql('DROP TABLE editeurs_pays_origine_editeurs');
        $this->addSql('DROP TABLE editeurs_france_editeurs');
    }
}
