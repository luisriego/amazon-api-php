<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218221527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orden DROP FOREIGN KEY FK_E128CFD7F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_E128CFD7F5B7AF75 ON orden');
        $this->addSql('ALTER TABLE orden CHANGE address_id order_address_id CHAR(36) DEFAULT NULL');
        $this->addSql('ALTER TABLE orden ADD CONSTRAINT FK_E128CFD7466D5220 FOREIGN KEY (order_address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E128CFD7466D5220 ON orden (order_address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orden DROP FOREIGN KEY FK_E128CFD7466D5220');
        $this->addSql('DROP INDEX UNIQ_E128CFD7466D5220 ON orden');
        $this->addSql('ALTER TABLE orden CHANGE order_address_id address_id CHAR(36) DEFAULT NULL');
        $this->addSql('ALTER TABLE orden ADD CONSTRAINT FK_E128CFD7F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E128CFD7F5B7AF75 ON orden (address_id)');
    }
}
