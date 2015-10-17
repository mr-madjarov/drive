<?php

class m140813_125306_create_price_list extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable( '{{price_list}}', array(
                'id'    => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'code'  => 'varchar(10) NOT NULL',
                'name'  => 'varchar(120) NOT NULL ',
                'price' => 'decimal(11,4) NOT NULL',
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

    }

    public function safeDown()
    {
        $this->dropTable( '{{price_list}}' );
    }

}