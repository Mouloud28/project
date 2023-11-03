<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102214240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bandes_annonces_teasers ADD film_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bandes_annonces_teasers ADD CONSTRAINT FK_CD5FDAA8567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('CREATE INDEX IDX_CD5FDAA8567F5183 ON bandes_annonces_teasers (film_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bandes_annonces_teasers DROP FOREIGN KEY FK_CD5FDAA8567F5183');
        $this->addSql('DROP INDEX IDX_CD5FDAA8567F5183 ON bandes_annonces_teasers');
        $this->addSql('ALTER TABLE bandes_annonces_teasers DROP film_id');
    }
}
