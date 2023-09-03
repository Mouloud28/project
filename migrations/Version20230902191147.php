<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230902191147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE editeur_livre ADD CONSTRAINT FK_FDED6D5C3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE editeur_livre ADD CONSTRAINT FK_FDED6D5C37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_editeur MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON livre_editeur');
        $this->addSql('ALTER TABLE livre_editeur ADD livre_id INT NOT NULL, ADD editeur_id INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE livre_editeur ADD CONSTRAINT FK_C8D403BB37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_editeur ADD CONSTRAINT FK_C8D403BB3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_C8D403BB37D925CB ON livre_editeur (livre_id)');
        $this->addSql('CREATE INDEX IDX_C8D403BB3375BD21 ON livre_editeur (editeur_id)');
        $this->addSql('ALTER TABLE livre_editeur ADD PRIMARY KEY (livre_id, editeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE editeur_livre DROP FOREIGN KEY FK_FDED6D5C3375BD21');
        $this->addSql('ALTER TABLE editeur_livre DROP FOREIGN KEY FK_FDED6D5C37D925CB');
        $this->addSql('ALTER TABLE livre_editeur DROP FOREIGN KEY FK_C8D403BB37D925CB');
        $this->addSql('ALTER TABLE livre_editeur DROP FOREIGN KEY FK_C8D403BB3375BD21');
        $this->addSql('DROP INDEX IDX_C8D403BB37D925CB ON livre_editeur');
        $this->addSql('DROP INDEX IDX_C8D403BB3375BD21 ON livre_editeur');
        $this->addSql('ALTER TABLE livre_editeur ADD id INT AUTO_INCREMENT NOT NULL, DROP livre_id, DROP editeur_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
