<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221105180854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D4C396E9D');
        $this->addSql('DROP INDEX IDX_5A8A6C8D4C396E9D ON post');
        $this->addSql('ALTER TABLE post DROP creator_nick_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post ADD creator_nick_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D4C396E9D FOREIGN KEY (creator_nick_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D4C396E9D ON post (creator_nick_id)');
    }
}
