<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230926114727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users_challenges DROP FOREIGN KEY FK_D0DE087479F37AE5');
        $this->addSql('ALTER TABLE users_challenges DROP FOREIGN KEY FK_D0DE0874BB636FB4');
        $this->addSql('DROP INDEX IDX_D0DE087479F37AE5 ON users_challenges');
        $this->addSql('DROP INDEX IDX_D0DE0874BB636FB4 ON users_challenges');
        $this->addSql('ALTER TABLE users_challenges ADD user_id INT NOT NULL, ADD challenge_id INT NOT NULL, DROP id_user_id, DROP id_challenge_id');
        $this->addSql('ALTER TABLE users_challenges ADD CONSTRAINT FK_D0DE0874A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE users_challenges ADD CONSTRAINT FK_D0DE087498A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenges (id)');
        $this->addSql('CREATE INDEX IDX_D0DE0874A76ED395 ON users_challenges (user_id)');
        $this->addSql('CREATE INDEX IDX_D0DE087498A21AC6 ON users_challenges (challenge_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users_challenges DROP FOREIGN KEY FK_D0DE0874A76ED395');
        $this->addSql('ALTER TABLE users_challenges DROP FOREIGN KEY FK_D0DE087498A21AC6');
        $this->addSql('DROP INDEX IDX_D0DE0874A76ED395 ON users_challenges');
        $this->addSql('DROP INDEX IDX_D0DE087498A21AC6 ON users_challenges');
        $this->addSql('ALTER TABLE users_challenges ADD id_user_id INT NOT NULL, ADD id_challenge_id INT NOT NULL, DROP user_id, DROP challenge_id');
        $this->addSql('ALTER TABLE users_challenges ADD CONSTRAINT FK_D0DE087479F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE users_challenges ADD CONSTRAINT FK_D0DE0874BB636FB4 FOREIGN KEY (id_challenge_id) REFERENCES challenges (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D0DE087479F37AE5 ON users_challenges (id_user_id)');
        $this->addSql('CREATE INDEX IDX_D0DE0874BB636FB4 ON users_challenges (id_challenge_id)');
    }
}
