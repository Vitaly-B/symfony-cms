<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170915132227 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX intValue ON product_attr_value');
        $this->addSql('DROP INDEX floatValue ON product_attr_value');
        $this->addSql('ALTER TABLE product_attr_value DROP int_value, CHANGE float_value number_value DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('CREATE INDEX numberValue ON product_attr_value (number_value)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX numberValue ON product_attr_value');
        $this->addSql('ALTER TABLE product_attr_value ADD int_value INT DEFAULT NULL, CHANGE number_value float_value DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('CREATE INDEX intValue ON product_attr_value (int_value)');
        $this->addSql('CREATE INDEX floatValue ON product_attr_value (float_value)');
    }
}
