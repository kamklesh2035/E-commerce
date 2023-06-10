<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609095737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, parent_id INTEGER DEFAULT NULL, name VARCHAR(100) NOT NULL, CONSTRAINT FK_3AF34668727ACA70 FOREIGN KEY (parent_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_3AF34668727ACA70 ON categories (parent_id)');
        $this->addSql('CREATE TABLE coupons (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, coupons_types_id INTEGER NOT NULL, code VARCHAR(100) NOT NULL, description CLOB NOT NULL, remise INTEGER NOT NULL, max_usage INTEGER NOT NULL, validité DATETIME NOT NULL, is_valid BOOLEAN NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_F56411183DDD47B7 FOREIGN KEY (coupons_types_id) REFERENCES coupons_types (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F564111877153098 ON coupons (code)');
        $this->addSql('CREATE INDEX IDX_F56411183DDD47B7 ON coupons (coupons_types_id)');
        $this->addSql('CREATE TABLE coupons_types (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE TABLE images (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, products_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, CONSTRAINT FK_E01FBE6A6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A6C8A81A9 ON images (products_id)');
        $this->addSql('CREATE TABLE orders (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, coupons_id INTEGER DEFAULT NULL, users_id INTEGER NOT NULL, reference VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_E52FFDEE6D72B15C FOREIGN KEY (coupons_id) REFERENCES coupons (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E52FFDEE67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E52FFDEEAEA34913 ON orders (reference)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE6D72B15C ON orders (coupons_id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE67B3B43D ON orders (users_id)');
        $this->addSql('CREATE TABLE orders_details (orders_id INTEGER NOT NULL, products_id INTEGER NOT NULL, quantité INTEGER NOT NULL, prix INTEGER NOT NULL, PRIMARY KEY(orders_id, products_id), CONSTRAINT FK_835379F1CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_835379F16C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_835379F1CFFE9AD6 ON orders_details (orders_id)');
        $this->addSql('CREATE INDEX IDX_835379F16C8A81A9 ON orders_details (products_id)');
        $this->addSql('CREATE TABLE products (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categories_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, description CLOB NOT NULL, stock INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_B3BA5A5AA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AA21214B7 ON products (categories_id)');
        $this->addSql('CREATE TABLE users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, last_name VARCHAR(100) NOT NULL, first_name VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, zipcode VARCHAR(6) NOT NULL, city VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE coupons');
        $this->addSql('DROP TABLE coupons_types');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_details');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
