<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260908105820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C84955D77469A ON reservation (numero_reservation)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4E977E5CF55AE19E ON salle (numero)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97A0ADA3E826F501 ON ticket (code_ticket)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_42C84955D77469A ON reservation');
        $this->addSql('DROP INDEX UNIQ_4E977E5CF55AE19E ON salle');
        $this->addSql('DROP INDEX UNIQ_97A0ADA3E826F501 ON ticket');
    }
}
