<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190930152707 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE visite (id INT AUTO_INCREMENT NOT NULL, bien_id INT DEFAULT NULL, visiteur_id INT DEFAULT NULL, suite VARCHAR(50) NOT NULL, date DATE NOT NULL, INDEX IDX_B09C8CBBBD95B80F (bien_id), INDEX IDX_B09C8CBB7F72333D (visiteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, nb_piece INT NOT NULL, nb_chambre INT NOT NULL, superficie INT NOT NULL, prix DOUBLE PRECISION NOT NULL, chauffage VARCHAR(50) NOT NULL, annee INT NOT NULL, localisation VARCHAR(50) NOT NULL, etat VARCHAR(25) NOT NULL, INDEX IDX_45EDC386C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, adresse VARCHAR(50) NOT NULL, telephone VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBBBD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE visite ADD CONSTRAINT FK_B09C8CBB7F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBBBD95B80F');
        $this->addSql('ALTER TABLE visite DROP FOREIGN KEY FK_B09C8CBB7F72333D');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386C54C8C93');
        $this->addSql('DROP TABLE visite');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE visiteur');
        $this->addSql('DROP TABLE type');
    }
}
