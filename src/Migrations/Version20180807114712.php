<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180807114712 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activity_log (id INT AUTO_INCREMENT NOT NULL, published_at DATETIME NOT NULL, intern TINYINT(1) NOT NULL, log VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL, details VARCHAR(255) NOT NULL, lunch_break VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_log_staff (activity_log_id INT NOT NULL, staff_id INT NOT NULL, INDEX IDX_85083F78B811BD86 (activity_log_id), INDEX IDX_85083F78D4D57CD (staff_id), PRIMARY KEY(activity_log_id, staff_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_log_owner (activity_log_id INT NOT NULL, owner_id INT NOT NULL, INDEX IDX_8062A96B811BD86 (activity_log_id), INDEX IDX_8062A967E3C61F9 (owner_id), PRIMARY KEY(activity_log_id, owner_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity_log_staff ADD CONSTRAINT FK_85083F78B811BD86 FOREIGN KEY (activity_log_id) REFERENCES activity_log (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_log_staff ADD CONSTRAINT FK_85083F78D4D57CD FOREIGN KEY (staff_id) REFERENCES staff (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_log_owner ADD CONSTRAINT FK_8062A96B811BD86 FOREIGN KEY (activity_log_id) REFERENCES activity_log (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_log_owner ADD CONSTRAINT FK_8062A967E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activity_log_staff DROP FOREIGN KEY FK_85083F78B811BD86');
        $this->addSql('ALTER TABLE activity_log_owner DROP FOREIGN KEY FK_8062A96B811BD86');
        $this->addSql('DROP TABLE activity_log');
        $this->addSql('DROP TABLE activity_log_staff');
        $this->addSql('DROP TABLE activity_log_owner');
    }
}
