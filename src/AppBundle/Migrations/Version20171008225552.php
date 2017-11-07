<?php

namespace App\AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171008225552 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, seo_title VARCHAR(255) DEFAULT NULL, seo_keywords VARCHAR(255) DEFAULT NULL, seo_description VARCHAR(512) DEFAULT NULL, description VARCHAR(1024) DEFAULT NULL, content LONGTEXT DEFAULT NULL, enabled TINYINT(1) DEFAULT \'1\' NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX title (title), INDEX enabled (enabled), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, seo_title VARCHAR(255) DEFAULT NULL, seo_keywords VARCHAR(255) DEFAULT NULL, seo_description VARCHAR(512) DEFAULT NULL, description VARCHAR(1024) DEFAULT NULL, content LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_A3D51B1D2C2AC5D3 (translatable_id), INDEX title (title), UNIQUE INDEX page_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, gallery_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, seo_title VARCHAR(255) DEFAULT NULL, seo_keywords VARCHAR(255) DEFAULT NULL, seo_description VARCHAR(512) DEFAULT NULL, description VARCHAR(1024) DEFAULT NULL, content LONGTEXT DEFAULT NULL, enabled TINYINT(1) DEFAULT \'1\' NOT NULL, price NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, position INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D34A04AD3DA5256D (image_id), UNIQUE INDEX UNIQ_D34A04AD4E7AF8F (gallery_id), INDEX title (title), INDEX enabled (enabled), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_product_category (product_id INT NOT NULL, product_category_id INT NOT NULL, INDEX IDX_437017AA4584665A (product_id), INDEX IDX_437017AABE6903FD (product_category_id), PRIMARY KEY(product_id, product_category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_attr (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, type SMALLINT DEFAULT 1 NOT NULL, position INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_attr_product_category (product_attr_id INT NOT NULL, product_category_id INT NOT NULL, INDEX IDX_B8BFB034A5A3FE72 (product_attr_id), INDEX IDX_B8BFB034BE6903FD (product_category_id), PRIMARY KEY(product_attr_id, product_category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_attr_value (id INT AUTO_INCREMENT NOT NULL, attribute_id INT NOT NULL, product_id INT NOT NULL, value VARCHAR(255) DEFAULT NULL, number_value DOUBLE PRECISION DEFAULT NULL, INDEX IDX_96E781A9B6E62EFA (attribute_id), INDEX IDX_96E781A94584665A (product_id), INDEX value (value), INDEX numberValue (number_value), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, tree_root INT DEFAULT NULL, title VARCHAR(255) NOT NULL, lft INT NOT NULL, rgt INT NOT NULL, lvl INT NOT NULL, INDEX IDX_CDFC7356A977936C (tree_root), INDEX IDX_CDFC7356727ACA70 (parent_id), INDEX title (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), UNIQUE INDEX UNIQ_8D93D6493DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__gallery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, context VARCHAR(64) NOT NULL, default_format VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__gallery_media (id INT AUTO_INCREMENT NOT NULL, gallery_id INT DEFAULT NULL, media_id INT DEFAULT NULL, position INT NOT NULL, enabled TINYINT(1) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_80D4C5414E7AF8F (gallery_id), INDEX IDX_80D4C541EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, provider_name VARCHAR(255) NOT NULL, provider_status INT NOT NULL, provider_reference VARCHAR(255) NOT NULL, provider_metadata LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', width INT DEFAULT NULL, height INT DEFAULT NULL, length NUMERIC(10, 0) DEFAULT NULL, content_type VARCHAR(255) DEFAULT NULL, content_size INT DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, author_name VARCHAR(255) DEFAULT NULL, context VARCHAR(64) DEFAULT NULL, cdn_is_flushable TINYINT(1) DEFAULT NULL, cdn_flush_identifier VARCHAR(64) DEFAULT NULL, cdn_flush_at DATETIME DEFAULT NULL, cdn_status INT DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE page_translation ADD CONSTRAINT FK_A3D51B1D2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD3DA5256D FOREIGN KEY (image_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4E7AF8F FOREIGN KEY (gallery_id) REFERENCES media__gallery (id)');
        $this->addSql('ALTER TABLE product_product_category ADD CONSTRAINT FK_437017AA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_product_category ADD CONSTRAINT FK_437017AABE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_attr_product_category ADD CONSTRAINT FK_B8BFB034A5A3FE72 FOREIGN KEY (product_attr_id) REFERENCES product_attr (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_attr_product_category ADD CONSTRAINT FK_B8BFB034BE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_attr_value ADD CONSTRAINT FK_96E781A9B6E62EFA FOREIGN KEY (attribute_id) REFERENCES product_attr (id)');
        $this->addSql('ALTER TABLE product_attr_value ADD CONSTRAINT FK_96E781A94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC7356A977936C FOREIGN KEY (tree_root) REFERENCES product_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC7356727ACA70 FOREIGN KEY (parent_id) REFERENCES product_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493DA5256D FOREIGN KEY (image_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE media__gallery_media ADD CONSTRAINT FK_80D4C5414E7AF8F FOREIGN KEY (gallery_id) REFERENCES media__gallery (id)');
        $this->addSql('ALTER TABLE media__gallery_media ADD CONSTRAINT FK_80D4C541EA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE page_translation DROP FOREIGN KEY FK_A3D51B1D2C2AC5D3');
        $this->addSql('ALTER TABLE product_product_category DROP FOREIGN KEY FK_437017AA4584665A');
        $this->addSql('ALTER TABLE product_attr_value DROP FOREIGN KEY FK_96E781A94584665A');
        $this->addSql('ALTER TABLE product_attr_product_category DROP FOREIGN KEY FK_B8BFB034A5A3FE72');
        $this->addSql('ALTER TABLE product_attr_value DROP FOREIGN KEY FK_96E781A9B6E62EFA');
        $this->addSql('ALTER TABLE product_product_category DROP FOREIGN KEY FK_437017AABE6903FD');
        $this->addSql('ALTER TABLE product_attr_product_category DROP FOREIGN KEY FK_B8BFB034BE6903FD');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC7356A977936C');
        $this->addSql('ALTER TABLE product_category DROP FOREIGN KEY FK_CDFC7356727ACA70');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4E7AF8F');
        $this->addSql('ALTER TABLE media__gallery_media DROP FOREIGN KEY FK_80D4C5414E7AF8F');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD3DA5256D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493DA5256D');
        $this->addSql('ALTER TABLE media__gallery_media DROP FOREIGN KEY FK_80D4C541EA9FDD75');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_translation');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_product_category');
        $this->addSql('DROP TABLE product_attr');
        $this->addSql('DROP TABLE product_attr_product_category');
        $this->addSql('DROP TABLE product_attr_value');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE media__gallery');
        $this->addSql('DROP TABLE media__gallery_media');
        $this->addSql('DROP TABLE media__media');
    }
}
