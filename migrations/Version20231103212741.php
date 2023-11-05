<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231103212741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bandes_annonces_teasers ADD poster VARCHAR(255) DEFAULT NULL, CHANGE video video VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE film DROP bandes_annonces_teasers');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bandes_annonces_teasers DROP poster, CHANGE video video VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE film ADD bandes_annonces_teasers VARCHAR(255) DEFAULT NULL');
    }
}
