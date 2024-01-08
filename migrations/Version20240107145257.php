<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240107145257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE categories_to_images (category_id UUID NOT NULL, image_id UUID NOT NULL, PRIMARY KEY(category_id, image_id))');
        $this->addSql('CREATE INDEX IDX_991EC45612469DE2 ON categories_to_images (category_id)');
        $this->addSql('CREATE INDEX IDX_991EC4563DA5256D ON categories_to_images (image_id)');
        $this->addSql('COMMENT ON COLUMN categories_to_images.category_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN categories_to_images.image_id IS \'(DC2Type:ulid)\'');
        $this->addSql('CREATE TABLE images (id UUID NOT NULL, src VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN images.id IS \'(DC2Type:ulid)\'');
        $this->addSql('CREATE TABLE products (id UUID NOT NULL, title VARCHAR(255) NOT NULL, sku VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3BA5A5AF9038C4 ON products (sku)');
        $this->addSql('COMMENT ON COLUMN products.id IS \'(DC2Type:ulid)\'');
        $this->addSql('CREATE TABLE products_to_images (product_id UUID NOT NULL, image_id UUID NOT NULL, PRIMARY KEY(product_id, image_id))');
        $this->addSql('CREATE INDEX IDX_94B051D14584665A ON products_to_images (product_id)');
        $this->addSql('CREATE INDEX IDX_94B051D13DA5256D ON products_to_images (image_id)');
        $this->addSql('COMMENT ON COLUMN products_to_images.product_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN products_to_images.image_id IS \'(DC2Type:ulid)\'');
        $this->addSql('CREATE TABLE products_to_categories (product_id UUID NOT NULL, category_id UUID NOT NULL, PRIMARY KEY(product_id, category_id))');
        $this->addSql('CREATE INDEX IDX_2CC90D6D4584665A ON products_to_categories (product_id)');
        $this->addSql('CREATE INDEX IDX_2CC90D6D12469DE2 ON products_to_categories (category_id)');
        $this->addSql('COMMENT ON COLUMN products_to_categories.product_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN products_to_categories.category_id IS \'(DC2Type:ulid)\'');
        $this->addSql('ALTER TABLE categories_to_images ADD CONSTRAINT FK_991EC45612469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories_to_images ADD CONSTRAINT FK_991EC4563DA5256D FOREIGN KEY (image_id) REFERENCES images (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products_to_images ADD CONSTRAINT FK_94B051D14584665A FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products_to_images ADD CONSTRAINT FK_94B051D13DA5256D FOREIGN KEY (image_id) REFERENCES images (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products_to_categories ADD CONSTRAINT FK_2CC90D6D4584665A FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products_to_categories ADD CONSTRAINT FK_2CC90D6D12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE categories_to_images DROP CONSTRAINT FK_991EC45612469DE2');
        $this->addSql('ALTER TABLE categories_to_images DROP CONSTRAINT FK_991EC4563DA5256D');
        $this->addSql('ALTER TABLE products_to_images DROP CONSTRAINT FK_94B051D14584665A');
        $this->addSql('ALTER TABLE products_to_images DROP CONSTRAINT FK_94B051D13DA5256D');
        $this->addSql('ALTER TABLE products_to_categories DROP CONSTRAINT FK_2CC90D6D4584665A');
        $this->addSql('ALTER TABLE products_to_categories DROP CONSTRAINT FK_2CC90D6D12469DE2');
        $this->addSql('DROP TABLE categories_to_images');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE products_to_images');
        $this->addSql('DROP TABLE products_to_categories');
    }
}
