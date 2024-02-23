<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240223004059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD owner_id CHAR(36) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993987E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F52993987E3C61F9 ON `order` (owner_id)');
        $this->addSql('ALTER TABLE `order` RENAME INDEX uniq_f5299398f5b7af75 TO UNIQ_F5299398466D5220');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993987E3C61F9');
        $this->addSql('DROP INDEX IDX_F52993987E3C61F9 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP owner_id');
        $this->addSql('ALTER TABLE `order` RENAME INDEX uniq_f5299398466d5220 TO UNIQ_F5299398F5B7AF75');
    }
}
