<?php

class m140814_222303_create_config_group extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable( '{{config_group}}', array(
                'id'   => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'type' => "ENUM( 'firm', 'email', 'counter' )",
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

        $this->createIndex( 'idx_config_group_unique_type', '{{config_group}}', 'type', true );

        $this->insert( '{{config_group}}', array( 'type' => 'firm' ) );
        $this->insert( '{{config_group}}', array( 'type' => 'email' ) );
        $this->insert( '{{config_group}}', array( 'type' => 'counter' ) );
    }

    public function safeDown()
    {
        $this->dropTable( '{{config_group}}' );
    }

}