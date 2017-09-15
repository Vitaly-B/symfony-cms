<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170914192456 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_attr_value_product (product_attr_value_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_696601BBAC1E7D98 (product_attr_value_id), INDEX IDX_696601BB4584665A (product_id), PRIMARY KEY(product_attr_value_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_attr_value_product ADD CONSTRAINT FK_696601BBAC1E7D98 FOREIGN KEY (product_attr_value_id) REFERENCES product_attr_value (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_attr_value_product ADD CONSTRAINT FK_696601BB4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_product_attr_value');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_product_attr_value (product_id INT NOT NULL, product_attr_value_id INT NOT NULL, INDEX IDX_643104D54584665A (product_id), INDEX IDX_643104D5AC1E7D98 (product_attr_value_id), PRIMARY KEY(product_id, product_attr_value_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_product_attr_value ADD CONSTRAINT FK_643104D54584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_product_attr_value ADD CONSTRAINT FK_643104D5AC1E7D98 FOREIGN KEY (product_attr_value_id) REFERENCES product_attr_value (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_attr_value_product');
    }
}
