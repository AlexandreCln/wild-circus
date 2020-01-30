<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129172626 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE spectacle_town');
        $this->addSql('DROP TABLE town_town');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE spectacle_town (spectacle_id INT NOT NULL, town_id INT NOT NULL, INDEX IDX_AD96977BC682915D (spectacle_id), INDEX IDX_AD96977B75E23604 (town_id), PRIMARY KEY(spectacle_id, town_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE town_town (town_source INT NOT NULL, town_target INT NOT NULL, INDEX IDX_8E5DF44D6FE6947B (town_source), INDEX IDX_8E5DF44D7603C4F4 (town_target), PRIMARY KEY(town_source, town_target)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE spectacle_town ADD CONSTRAINT FK_AD96977B75E23604 FOREIGN KEY (town_id) REFERENCES town (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spectacle_town ADD CONSTRAINT FK_AD96977BC682915D FOREIGN KEY (spectacle_id) REFERENCES spectacle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE town_town ADD CONSTRAINT FK_8E5DF44D6FE6947B FOREIGN KEY (town_source) REFERENCES town (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE town_town ADD CONSTRAINT FK_8E5DF44D7603C4F4 FOREIGN KEY (town_target) REFERENCES town (id) ON DELETE CASCADE');
    }
}
