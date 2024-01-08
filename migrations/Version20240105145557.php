<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240105145557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE games_info ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE games_info ADD CONSTRAINT FK_D4F1FD8EFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D4F1FD8EFB88E14F ON games_info (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE games_info DROP FOREIGN KEY FK_D4F1FD8EFB88E14F');
        $this->addSql('DROP INDEX IDX_D4F1FD8EFB88E14F ON games_info');
        $this->addSql('ALTER TABLE games_info DROP utilisateur_id');
    }
}
