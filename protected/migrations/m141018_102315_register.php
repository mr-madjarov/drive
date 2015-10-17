<?php

class m141018_102315_register extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable( '{{register}}', array(
                'id'          => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'first_name'  => 'varchar(250) NOT NULL',
                'last_name'   => 'varchar(250) NOT NULL',
                'email'       => 'varchar(150) NOT NULL',
                'phone'       => 'varchar(64)  NOT NULL',
                'address'     => 'text DEFAULT NULL',
                'category_id' => 'int(10) unsigned',
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
        $this->addForeignKey( 'fk_register_category_id_category_id', '{{register}}', 'category_id', '{{category}}',
            'id', 'RESTRICT', 'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropForeignKey( 'fk_register_category_id_category_id', '{{register}}' );


        $this->dropTable('{{register}}');

    }

}