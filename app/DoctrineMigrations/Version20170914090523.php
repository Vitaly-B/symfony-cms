<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170914090523 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_attr (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_attr_product_category (product_attr_id INT NOT NULL, product_category_id INT NOT NULL, INDEX IDX_B8BFB034A5A3FE72 (product_attr_id), INDEX IDX_B8BFB034BE6903FD (product_category_id), PRIMARY KEY(product_attr_id, product_category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_attr_product_category ADD CONSTRAINT FK_B8BFB034A5A3FE72 FOREIGN KEY (product_attr_id) REFERENCES product_attr (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_attr_product_category ADD CONSTRAINT FK_B8BFB034BE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_attr_product_category DROP FOREIGN KEY FK_B8BFB034A5A3FE72');
        $this->addSql('DROP TABLE product_attr');
        $this->addSql('DROP TABLE product_attr_product_category');
    }
}
