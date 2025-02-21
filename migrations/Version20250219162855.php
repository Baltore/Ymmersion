<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250219162855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recette_likes (recette_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B53EC6EB89312FE9 (recette_id), INDEX IDX_B53EC6EBA76ED395 (user_id), PRIMARY KEY(recette_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recette_likes ADD CONSTRAINT FK_B53EC6EB89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recette_likes ADD CONSTRAINT FK_B53EC6EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recette_likes DROP FOREIGN KEY FK_B53EC6EB89312FE9');
        $this->addSql('ALTER TABLE recette_likes DROP FOREIGN KEY FK_B53EC6EBA76ED395');
        $this->addSql('DROP TABLE recette_likes');
    }
}
