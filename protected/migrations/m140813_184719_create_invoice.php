<?php

class m140813_184719_create_invoice extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable( '{{invoice}}', array(
                'id'                 => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'created_date'       => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                'declaration_id'     => 'int(10) unsigned NOT NULL',
                'status'             => "ENUM( 'unpaid', 'paid' , 'signed' ) DEFAULT 'unpaid'",
                'created_by_user_id' => 'int(10) unsigned NOT NULL',
                'type'               => "ENUM( 'normal', 'null' ) DEFAULT 'normal'",
                'number'             => 'varchar(10) NOT NULL',
                'payment_type'       => "ENUM( 'cash', 'bank' ) DEFAULT 'cash'",
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
        $this->addForeignKey( 'fk_invoice_declaration_id_declaration_id', '{{invoice}}', 'declaration_id', '{{declaration}}',
            'id', 'RESTRICT', 'CASCADE'
        );
        $this->addForeignKey( 'fk_invoice_created_by_user_id_user_id', '{{invoice}}', 'created_by_user_id', '{{user}}',
            'id', 'RESTRICT', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey( 'fk_invoice_declaration_id_declaration_id', '{{invoice}}' );
        $this->dropForeignKey( 'fk_invoice_created_by_user_id_user_id', '{{invoice}}' );
        $this->dropTable( '{{invoice}}' );
    }

}