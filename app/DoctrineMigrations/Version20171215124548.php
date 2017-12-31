<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171215124548 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE archive_product (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, user_id INT DEFAULT NULL, bought_at DATETIME NOT NULL, final_price DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_BE6AE5524584665A (product_id), INDEX IDX_BE6AE552A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auction (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, seller_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_DEE4F5934584665A (product_id), INDEX IDX_DEE4F5938DE820D9 (seller_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE awaiting_approval_product (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_926419724584665A (product_id), INDEX IDX_92641972A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id INT DEFAULT NULL, user_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B6BD307FF624B39D (sender_id), INDEX IDX_B6BD307FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pending_product (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_1825F33C4584665A (product_id), INDEX IDX_1825F33CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, category_id INT DEFAULT NULL, who_pays_id INT DEFAULT NULL, shipment_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, content VARCHAR(255) NOT NULL, min_price DOUBLE PRECISION NOT NULL, status VARCHAR(15) NOT NULL, expires_after SMALLINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_D34A04ADA76ED395 (user_id), INDEX IDX_D34A04AD12469DE2 (category_id), INDEX IDX_D34A04AD4AFA803D (who_pays_id), INDEX IDX_D34A04AD7BE036FC (shipment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase_offer (id INT AUTO_INCREMENT NOT NULL, auction_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_FD1D041457B8F0DE (auction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_purchase_offers (purchase_offer_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_BA5CF9E87A0467BC (purchase_offer_id), INDEX IDX_BA5CF9E8A76ED395 (user_id), PRIMARY KEY(purchase_offer_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipment (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(15) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE system_messages (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, tittle VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B2E8AF14A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(64) NOT NULL, company VARCHAR(50) NOT NULL, nip VARCHAR(15) NOT NULL, regon INT NOT NULL, is_active TINYINT(1) NOT NULL, credit INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE can_text_with (sender_id INT NOT NULL, recipient_id INT NOT NULL, INDEX IDX_3CE0381BF624B39D (sender_id), INDEX IDX_3CE0381BE92F8F78 (recipient_id), PRIMARY KEY(sender_id, recipient_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE who_pays_option (id INT AUTO_INCREMENT NOT NULL, `option` VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE archive_product ADD CONSTRAINT FK_BE6AE5524584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE archive_product ADD CONSTRAINT FK_BE6AE552A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE auction ADD CONSTRAINT FK_DEE4F5934584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE auction ADD CONSTRAINT FK_DEE4F5938DE820D9 FOREIGN KEY (seller_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE awaiting_approval_product ADD CONSTRAINT FK_926419724584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE awaiting_approval_product ADD CONSTRAINT FK_92641972A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pending_product ADD CONSTRAINT FK_1825F33C4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE pending_product ADD CONSTRAINT FK_1825F33CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4AFA803D FOREIGN KEY (who_pays_id) REFERENCES who_pays_option (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD7BE036FC FOREIGN KEY (shipment_id) REFERENCES shipment (id)');
        $this->addSql('ALTER TABLE purchase_offer ADD CONSTRAINT FK_FD1D041457B8F0DE FOREIGN KEY (auction_id) REFERENCES auction (id)');
        $this->addSql('ALTER TABLE users_purchase_offers ADD CONSTRAINT FK_BA5CF9E87A0467BC FOREIGN KEY (purchase_offer_id) REFERENCES purchase_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_purchase_offers ADD CONSTRAINT FK_BA5CF9E8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE system_messages ADD CONSTRAINT FK_B2E8AF14A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE can_text_with ADD CONSTRAINT FK_3CE0381BF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE can_text_with ADD CONSTRAINT FK_3CE0381BE92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase_offer DROP FOREIGN KEY FK_FD1D041457B8F0DE');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE archive_product DROP FOREIGN KEY FK_BE6AE5524584665A');
        $this->addSql('ALTER TABLE auction DROP FOREIGN KEY FK_DEE4F5934584665A');
        $this->addSql('ALTER TABLE awaiting_approval_product DROP FOREIGN KEY FK_926419724584665A');
        $this->addSql('ALTER TABLE pending_product DROP FOREIGN KEY FK_1825F33C4584665A');
        $this->addSql('ALTER TABLE users_purchase_offers DROP FOREIGN KEY FK_BA5CF9E87A0467BC');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD7BE036FC');
        $this->addSql('ALTER TABLE archive_product DROP FOREIGN KEY FK_BE6AE552A76ED395');
        $this->addSql('ALTER TABLE auction DROP FOREIGN KEY FK_DEE4F5938DE820D9');
        $this->addSql('ALTER TABLE awaiting_approval_product DROP FOREIGN KEY FK_92641972A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE pending_product DROP FOREIGN KEY FK_1825F33CA76ED395');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA76ED395');
        $this->addSql('ALTER TABLE users_purchase_offers DROP FOREIGN KEY FK_BA5CF9E8A76ED395');
        $this->addSql('ALTER TABLE system_messages DROP FOREIGN KEY FK_B2E8AF14A76ED395');
        $this->addSql('ALTER TABLE can_text_with DROP FOREIGN KEY FK_3CE0381BF624B39D');
        $this->addSql('ALTER TABLE can_text_with DROP FOREIGN KEY FK_3CE0381BE92F8F78');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4AFA803D');
        $this->addSql('DROP TABLE archive_product');
        $this->addSql('DROP TABLE auction');
        $this->addSql('DROP TABLE awaiting_approval_product');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE pending_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE purchase_offer');
        $this->addSql('DROP TABLE users_purchase_offers');
        $this->addSql('DROP TABLE shipment');
        $this->addSql('DROP TABLE system_messages');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE can_text_with');
        $this->addSql('DROP TABLE who_pays_option');
    }
}
