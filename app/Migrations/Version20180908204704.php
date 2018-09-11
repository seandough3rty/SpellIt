<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180908204704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Headers (headerID INT AUTO_INCREMENT NOT NULL, optionName VARCHAR(255) NOT NULL, className VARCHAR(255) NOT NULL, crossProduct TINYINT(1) NOT NULL, lineCount INT NOT NULL, setID INT NOT NULL, INDEX IDX_38BE7619775ADB7A (setID), PRIMARY KEY(headerID)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Rules (ruleID INT AUTO_INCREMENT NOT NULL, strippingChars VARCHAR(255) NOT NULL, affix VARCHAR(255) NOT NULL, `condition` VARCHAR(255) NOT NULL, headerID INT NOT NULL, INDEX IDX_485BB6381B3FC09D (headerID), PRIMARY KEY(ruleID)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Sets (setID INT AUTO_INCREMENT NOT NULL, languageName VARCHAR(255) NOT NULL, PRIMARY KEY(setID)) DEFAULT CHARACTER SET UTF8 COLLATE UTF8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Headers ADD CONSTRAINT FK_38BE7619775ADB7A FOREIGN KEY (setID) REFERENCES Sets (setID)');
        $this->addSql('ALTER TABLE Rules ADD CONSTRAINT FK_485BB6381B3FC09D FOREIGN KEY (headerID) REFERENCES Headers (headerID)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Rules DROP FOREIGN KEY FK_485BB6381B3FC09D');
        $this->addSql('ALTER TABLE Headers DROP FOREIGN KEY FK_38BE7619775ADB7A');
        $this->addSql('DROP TABLE Headers');
        $this->addSql('DROP TABLE Rules');
        $this->addSql('DROP TABLE Sets');
    }
}
