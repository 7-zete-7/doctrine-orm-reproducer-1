<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241106204834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initialize FooEntity table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE foo_entity (id INTEGER NOT NULL, deleted_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE foo_entity');
    }
}
