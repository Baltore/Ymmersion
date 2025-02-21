<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250219030425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, recette_id INT NOT NULL, contenu LONGTEXT NOT NULL, note INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_67F068BCFB88E14F (utilisateur_id), INDEX IDX_67F068BC89312FE9 (recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, temps_preparation INT NOT NULL, temps_cuisson INT NOT NULL, portions INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_49BB6390FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette_ingredient (id INT AUTO_INCREMENT NOT NULL, recette_id INT NOT NULL, ingredient_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, unite VARCHAR(50) NOT NULL, INDEX IDX_17C041A989312FE9 (recette_id), INDEX IDX_17C041A9933FE08C (ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_utilisateur (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, ingredient_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_C2D2C587FB88E14F (utilisateur_id), INDEX IDX_C2D2C587933FE08C (ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A9933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE stock_utilisateur ADD CONSTRAINT FK_C2D2C587FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE stock_utilisateur ADD CONSTRAINT FK_C2D2C587933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCFB88E14F');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC89312FE9');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390FB88E14F');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A989312FE9');
        $this->addSql('ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A9933FE08C');
        $this->addSql('ALTER TABLE stock_utilisateur DROP FOREIGN KEY FK_C2D2C587FB88E14F');
        $this->addSql('ALTER TABLE stock_utilisateur DROP FOREIGN KEY FK_C2D2C587933FE08C');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE recette_ingredient');
        $this->addSql('DROP TABLE stock_utilisateur');
        $this->addSql('DROP TABLE utilisateur');
    }
}
