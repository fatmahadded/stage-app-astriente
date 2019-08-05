<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190731131042 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE astreinte (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, paye_id INT DEFAULT NULL, rapport_id INT DEFAULT NULL, semaine_id INT NOT NULL, vivier_id INT NOT NULL, INDEX IDX_F23DC073A76ED395 (user_id), UNIQUE INDEX UNIQ_F23DC073D3964A07 (paye_id), UNIQUE INDEX UNIQ_F23DC0731DFBCC46 (rapport_id), INDEX IDX_F23DC073122EEC90 (semaine_id), INDEX IDX_F23DC0733B322EA (vivier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entite (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, rapport_id INT NOT NULL, label VARCHAR(255) NOT NULL, date DATE NOT NULL, heure_debut TIME NOT NULL, heure_fin TIME NOT NULL, INDEX IDX_D11814AB1DFBCC46 (rapport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jour_ferie (id INT AUTO_INCREMENT NOT NULL, jour DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paye (id INT AUTO_INCREMENT NOT NULL, astreinte_id INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_C04B89FFA3648894 (astreinte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport (id INT AUTO_INCREMENT NOT NULL, retours_id INT DEFAULT NULL, astreinte_id INT NOT NULL, note VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_BE34A09C6A5166D3 (retours_id), UNIQUE INDEX UNIQ_BE34A09CA3648894 (astreinte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE remplacement (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, astreinte_id INT NOT NULL, date DATE NOT NULL, seance VARCHAR(50) NOT NULL, num INT NOT NULL, INDEX IDX_18EC0D1EA76ED395 (user_id), INDEX IDX_18EC0D1EA3648894 (astreinte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repos (id INT AUTO_INCREMENT NOT NULL, nombre_heures VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE retour (id INT AUTO_INCREMENT NOT NULL, entree_appreciated VARCHAR(255) NOT NULL, entree_to_improve VARCHAR(255) NOT NULL, moyens_appreciated VARCHAR(255) NOT NULL, moyens_to_improve VARCHAR(255) NOT NULL, intervention_bonne_pratique VARCHAR(255) NOT NULL, intervention_difficultes VARCHAR(255) NOT NULL, intervention_commentaires VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semaine (id INT AUTO_INCREMENT NOT NULL, num_semaine INT NOT NULL, debut_semaine DATE NOT NULL, fin_semaine DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, vivier_id INT DEFAULT NULL, repos_id INT DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', nom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_active VARCHAR(255) NOT NULL, INDEX IDX_1D1C63B33B322EA (vivier_id), UNIQUE INDEX UNIQ_1D1C63B3A213D4CB (repos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vivier (id INT AUTO_INCREMENT NOT NULL, entite_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_5748DA5E9BEA957A (entite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE astreinte ADD CONSTRAINT FK_F23DC073A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE astreinte ADD CONSTRAINT FK_F23DC073D3964A07 FOREIGN KEY (paye_id) REFERENCES paye (id)');
        $this->addSql('ALTER TABLE astreinte ADD CONSTRAINT FK_F23DC0731DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id)');
        $this->addSql('ALTER TABLE astreinte ADD CONSTRAINT FK_F23DC073122EEC90 FOREIGN KEY (semaine_id) REFERENCES semaine (id)');
        $this->addSql('ALTER TABLE astreinte ADD CONSTRAINT FK_F23DC0733B322EA FOREIGN KEY (vivier_id) REFERENCES vivier (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB1DFBCC46 FOREIGN KEY (rapport_id) REFERENCES rapport (id)');
        $this->addSql('ALTER TABLE paye ADD CONSTRAINT FK_C04B89FFA3648894 FOREIGN KEY (astreinte_id) REFERENCES astreinte (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C6A5166D3 FOREIGN KEY (retours_id) REFERENCES retour (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09CA3648894 FOREIGN KEY (astreinte_id) REFERENCES astreinte (id)');
        $this->addSql('ALTER TABLE remplacement ADD CONSTRAINT FK_18EC0D1EA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE remplacement ADD CONSTRAINT FK_18EC0D1EA3648894 FOREIGN KEY (astreinte_id) REFERENCES astreinte (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B33B322EA FOREIGN KEY (vivier_id) REFERENCES vivier (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3A213D4CB FOREIGN KEY (repos_id) REFERENCES repos (id)');
        $this->addSql('ALTER TABLE vivier ADD CONSTRAINT FK_5748DA5E9BEA957A FOREIGN KEY (entite_id) REFERENCES entite (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE paye DROP FOREIGN KEY FK_C04B89FFA3648894');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09CA3648894');
        $this->addSql('ALTER TABLE remplacement DROP FOREIGN KEY FK_18EC0D1EA3648894');
        $this->addSql('ALTER TABLE vivier DROP FOREIGN KEY FK_5748DA5E9BEA957A');
        $this->addSql('ALTER TABLE astreinte DROP FOREIGN KEY FK_F23DC073D3964A07');
        $this->addSql('ALTER TABLE astreinte DROP FOREIGN KEY FK_F23DC0731DFBCC46');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB1DFBCC46');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3A213D4CB');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C6A5166D3');
        $this->addSql('ALTER TABLE astreinte DROP FOREIGN KEY FK_F23DC073122EEC90');
        $this->addSql('ALTER TABLE astreinte DROP FOREIGN KEY FK_F23DC073A76ED395');
        $this->addSql('ALTER TABLE remplacement DROP FOREIGN KEY FK_18EC0D1EA76ED395');
        $this->addSql('ALTER TABLE astreinte DROP FOREIGN KEY FK_F23DC0733B322EA');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B33B322EA');
        $this->addSql('DROP TABLE astreinte');
        $this->addSql('DROP TABLE entite');
        $this->addSql('DROP TABLE intervention');
        $this->addSql('DROP TABLE jour_ferie');
        $this->addSql('DROP TABLE paye');
        $this->addSql('DROP TABLE rapport');
        $this->addSql('DROP TABLE remplacement');
        $this->addSql('DROP TABLE repos');
        $this->addSql('DROP TABLE retour');
        $this->addSql('DROP TABLE semaine');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE vivier');
    }
}
