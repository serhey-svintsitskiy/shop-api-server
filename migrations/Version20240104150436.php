<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240104150436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE categories (id UUID NOT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('COMMENT ON COLUMN categories.id IS \'(DC2Type:ulid)\'');
        $this->addSql(
            'CREATE TABLE users (id UUID NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:ulid)\'');
        $this->addSql('ALTER INDEX uniq_c74f2195c74f2195 RENAME TO UNIQ_9BACE7E1C74F2195');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER INDEX uniq_9bace7e1c74f2195 RENAME TO uniq_c74f2195c74f2195');
    }
}
