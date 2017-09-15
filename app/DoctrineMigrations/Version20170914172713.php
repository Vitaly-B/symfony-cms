<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170914172713 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_attr_value ADD attribute_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product_attr_value ADD CONSTRAINT FK_96E781A9B6E62EFA FOREIGN KEY (attribute_id) REFERENCES product_attr (id)');
        $this->addSql('CREATE INDEX IDX_96E781A9B6E62EFA ON product_attr_value (attribute_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_attr_value DROP FOREIGN KEY FK_96E781A9B6E62EFA');
        $this->addSql('DROP INDEX IDX_96E781A9B6E62EFA ON product_attr_value');
        $this->addSql('ALTER TABLE product_attr_value DROP attribute_id');
    }
}
