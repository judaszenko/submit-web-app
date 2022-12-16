<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725063523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_profile ADD foregin_user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB40526EBDC83 FOREIGN KEY (foregin_user_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D95AB40526EBDC83 ON user_profile (foregin_user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_profile DROP FOREIGN KEY FK_D95AB40526EBDC83');
        $this->addSql('DROP INDEX UNIQ_D95AB40526EBDC83 ON user_profile');
        $this->addSql('ALTER TABLE user_profile DROP foregin_user_id_id');
    }
}
