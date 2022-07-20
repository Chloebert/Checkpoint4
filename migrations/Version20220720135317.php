<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720135317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cat_picture (id INT AUTO_INCREMENT NOT NULL, cat_id INT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, main_picture TINYINT(1) DEFAULT NULL, INDEX IDX_366ACDDFE6ADA943 (cat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cat_picture ADD CONSTRAINT FK_366ACDDFE6ADA943 FOREIGN KEY (cat_id) REFERENCES cat (id)');
        $this->addSql('ALTER TABLE cat CHANGE date_of_birth date_of_birth DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cat_picture');
        $this->addSql('ALTER TABLE cat CHANGE date_of_birth date_of_birth DATE NOT NULL');
    }
}
