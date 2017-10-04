<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170928142800 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE media__gallery_media CHANGE gallery_id gallery_id INT DEFAULT NULL, CHANGE media_id media_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media__media CHANGE provider_metadata provider_metadata LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', CHANGE width width INT DEFAULT NULL, CHANGE height height INT DEFAULT NULL, CHANGE length length NUMERIC(10, 0) DEFAULT NULL, CHANGE content_type content_type VARCHAR(255) DEFAULT NULL, CHANGE content_size content_size INT DEFAULT NULL, CHANGE copyright copyright VARCHAR(255) DEFAULT NULL, CHANGE author_name author_name VARCHAR(255) DEFAULT NULL, CHANGE context context VARCHAR(64) DEFAULT NULL, CHANGE cdn_is_flushable cdn_is_flushable TINYINT(1) DEFAULT NULL, CHANGE cdn_flush_identifier cdn_flush_identifier VARCHAR(64) DEFAULT NULL, CHANGE cdn_flush_at cdn_flush_at DATETIME DEFAULT NULL, CHANGE cdn_status cdn_status INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page CHANGE seo_title seo_title VARCHAR(255) DEFAULT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) DEFAULT NULL, CHANGE seo_description seo_description VARCHAR(512) DEFAULT NULL, CHANGE description description VARCHAR(1024) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE page_translation CHANGE translatable_id translatable_id INT DEFAULT NULL, CHANGE seo_title seo_title VARCHAR(255) DEFAULT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) DEFAULT NULL, CHANGE seo_description seo_description VARCHAR(512) DEFAULT NULL, CHANGE description description VARCHAR(1024) DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE image_id image_id INT DEFAULT NULL, CHANGE gallery_id gallery_id INT DEFAULT NULL, CHANGE seo_title seo_title VARCHAR(255) DEFAULT NULL, CHANGE seo_keywords seo_keywords VARCHAR(255) DEFAULT NULL, CHANGE seo_description seo_description VARCHAR(512) DEFAULT NULL, CHANGE description description VARCHAR(1024) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE position position INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_attr CHANGE position position INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_attr_value CHANGE value value VARCHAR(255) DEFAULT NULL, CHANGE number_value number_value DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE product_category CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE tree_root tree_root INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE image_id image_id INT DEFAULT NULL, CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE media__gallery_media CHANGE gallery_id gallery_id INT DEFAULT NULL, CHANGE media_id media_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media__media CHANGE provider_metadata provider_metadata LONGTEXT DEFAULT \'NULL\' COLLATE utf8_unicode_ci COMMENT \'(DC2Type:json)\', CHANGE width width INT DEFAULT NULL, CHANGE height height INT DEFAULT NULL, CHANGE length length NUMERIC(10, 0) DEFAULT \'NULL\', CHANGE content_type content_type VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE content_size content_size INT DEFAULT NULL, CHANGE copyright copyright VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE author_name author_name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE context context VARCHAR(64) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE cdn_is_flushable cdn_is_flushable TINYINT(1) DEFAULT \'NULL\', CHANGE cdn_flush_identifier cdn_flush_identifier VARCHAR(64) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE cdn_flush_at cdn_flush_at DATETIME DEFAULT \'NULL\', CHANGE cdn_status cdn_status INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page CHANGE seo_title seo_title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE seo_keywords seo_keywords VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE seo_description seo_description VARCHAR(512) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE description description VARCHAR(1024) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE page_translation CHANGE translatable_id translatable_id INT DEFAULT NULL, CHANGE seo_title seo_title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE seo_keywords seo_keywords VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE seo_description seo_description VARCHAR(512) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE description description VARCHAR(1024) DEFAULT \'NULL\' COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE product CHANGE image_id image_id INT DEFAULT NULL, CHANGE gallery_id gallery_id INT DEFAULT NULL, CHANGE seo_title seo_title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE seo_keywords seo_keywords VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE seo_description seo_description VARCHAR(512) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE description description VARCHAR(1024) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE position position INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE product_attr CHANGE position position INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_attr_value CHANGE value value VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE number_value number_value DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE product_category CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE tree_root tree_root INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE image_id image_id INT DEFAULT NULL, CHANGE salt salt VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}
