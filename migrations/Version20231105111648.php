<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231105111648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bandes_annonces_teasers ADD serie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bandes_annonces_teasers ADD CONSTRAINT FK_CD5FDAA8D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('CREATE INDEX IDX_CD5FDAA8D94388BD ON bandes_annonces_teasers (serie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bandes_annonces_teasers DROP FOREIGN KEY FK_CD5FDAA8D94388BD');
        $this->addSql('DROP INDEX IDX_CD5FDAA8D94388BD ON bandes_annonces_teasers');
        $this->addSql('ALTER TABLE bandes_annonces_teasers DROP serie_id');
    }
}
