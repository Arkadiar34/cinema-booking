<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260915084738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD nb_places INT NOT NULL, ADD email_client VARCHAR(255) NOT NULL, ADD film_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955567F5183 FOREIGN KEY (film_id) REFERENCES film (id)');
        $this->addSql('CREATE INDEX IDX_42C84955567F5183 ON reservation (film_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955567F5183');
        $this->addSql('DROP INDEX IDX_42C84955567F5183 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP nb_places, DROP email_client, DROP film_id');
    }
}
