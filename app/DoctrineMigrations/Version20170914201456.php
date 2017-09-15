<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170914201456 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product_attr_value_product');
        $this->addSql('ALTER TABLE product_attr_value ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_attr_value ADD CONSTRAINT FK_96E781A94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_96E781A94584665A ON product_attr_value (product_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_attr_value_product (product_attr_value_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_696601BBAC1E7D98 (product_attr_value_id), INDEX IDX_696601BB4584665A (product_id), PRIMARY KEY(product_attr_value_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_attr_value_product ADD CONSTRAINT FK_696601BB4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_attr_value_product ADD CONSTRAINT FK_696601BBAC1E7D98 FOREIGN KEY (product_attr_value_id) REFERENCES product_attr_value (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_attr_value DROP FOREIGN KEY FK_96E781A94584665A');
        $this->addSql('DROP INDEX IDX_96E781A94584665A ON product_attr_value');
        $this->addSql('ALTER TABLE product_attr_value DROP product_id');
    }
}
