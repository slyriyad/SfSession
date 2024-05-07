<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507093714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program ADD session_id INT DEFAULT NULL, ADD module_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('CREATE INDEX IDX_92ED7784613FECDF ON program (session_id)');
        $this->addSql('CREATE INDEX IDX_92ED7784AFC2B591 ON program (module_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784613FECDF');
        $this->addSql('ALTER TABLE program DROP FOREIGN KEY FK_92ED7784AFC2B591');
        $this->addSql('DROP INDEX IDX_92ED7784613FECDF ON program');
        $this->addSql('DROP INDEX IDX_92ED7784AFC2B591 ON program');
        $this->addSql('ALTER TABLE program DROP session_id, DROP module_id');
    }
}
