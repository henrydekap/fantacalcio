<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220819133223 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE match_day ADD season_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_E1EE884E4EC001D1 ON match_day (season_id)');
        $this->addSql('ALTER TABLE player ADD season_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_98197A654EC001D1 ON player (season_id)');

        //add default season
        $this->addSql('INSERT INTO season (id, name) VALUE (1, "20/21")');
        $this->addSql('UPDATE match_day SET season_id = 1');
        $this->addSql('UPDATE player SET season_id = 1');

        //add constraints
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A654EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE match_day ADD CONSTRAINT FK_E1EE884E4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE match_day DROP FOREIGN KEY FK_E1EE884E4EC001D1');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A654EC001D1');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP INDEX IDX_E1EE884E4EC001D1 ON match_day');
        $this->addSql('ALTER TABLE match_day DROP season_id');
        $this->addSql('DROP INDEX IDX_98197A654EC001D1 ON player');
        $this->addSql('ALTER TABLE player DROP season_id');
    }
}
