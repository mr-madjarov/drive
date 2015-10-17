<?php

class m140814_093738_alter_invoice_remove_type extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->dropColumn( '{{invoice}}', 'type' );
    }

    public function safeDown()
    {
        $this->addColumn( '{{invoice}}', 'type', "ENUM('normal','null') DEFAULT 'normal'" );
    }

}