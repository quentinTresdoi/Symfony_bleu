<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230926112026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users_challenges (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_challenge_id INT NOT NULL, status INT NOT NULL, INDEX IDX_D0DE087479F37AE5 (id_user_id), INDEX IDX_D0DE0874BB636FB4 (id_challenge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_challenges ADD CONSTRAINT FK_D0DE087479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE users_challenges ADD CONSTRAINT FK_D0DE0874BB636FB4 FOREIGN KEY (id_challenge_id) REFERENCES challenges (id)');
        $this->addSql('ALTER TABLE challenges DROP created_by');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users_challenges DROP FOREIGN KEY FK_D0DE087479F37AE5');
        $this->addSql('ALTER TABLE users_challenges DROP FOREIGN KEY FK_D0DE0874BB636FB4');
        $this->addSql('DROP TABLE users_challenges');
        $this->addSql('ALTER TABLE challenges ADD created_by VARCHAR(255) NOT NULL');
    }
}
