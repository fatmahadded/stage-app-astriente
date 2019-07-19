<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190718230319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur ADD vivier_id INT DEFAULT NULL, ADD repos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B33B322EA FOREIGN KEY (vivier_id) REFERENCES vivier (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3A213D4CB FOREIGN KEY (repos_id) REFERENCES repos (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B33B322EA ON utilisateur (vivier_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3A213D4CB ON utilisateur (repos_id)');
        $this->addSql('ALTER TABLE vivier ADD entite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vivier ADD CONSTRAINT FK_5748DA5E9BEA957A FOREIGN KEY (entite_id) REFERENCES entite (id)');
        $this->addSql('CREATE INDEX IDX_5748DA5E9BEA957A ON vivier (entite_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B33B322EA');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3A213D4CB');
        $this->addSql('DROP INDEX IDX_1D1C63B33B322EA ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3A213D4CB ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP vivier_id, DROP repos_id');
        $this->addSql('ALTER TABLE vivier DROP FOREIGN KEY FK_5748DA5E9BEA957A');
        $this->addSql('DROP INDEX IDX_5748DA5E9BEA957A ON vivier');
        $this->addSql('ALTER TABLE vivier DROP entite_id');
    }
}
