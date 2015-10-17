<?php

class m140812_125346_create_declaration extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable( '{{declaration}}', array(
                'id'                 => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'number'             => 'varchar(10) NOT NULL',
                'from_date'          => 'date DEFAULT NULL',
                'to_date'            => 'date DEFAULT NULL',
                'created_date'       => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                'created_by_user_id' => 'int(10) unsigned NOT NULL',
                'type'               => "ENUM( 'normal', 'null' ) DEFAULT 'normal'",
                'signed'             => 'tinyint(1) NOT NULL DEFAULT 0',
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

        $this->addForeignKey( 'fk_declaration_created_by_user_id_user_id', '{{declaration}}', 'created_by_user_id',
            '{{user}}', 'id', 'RESTRICT', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey( 'fk_declaration_created_by_user_id_user_id', '{{declaration}}' );
        $this->dropTable( '{{declaration}}' );
    }

}