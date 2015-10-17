<?php

class m140919_093948_category extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
    {
        $this->createTable( '{{category}}', array(
                'id'            => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'type'          => "ENUM( 'A', 'B', 'C', 'C+E', 'A1', 'A2', 'AM'  ) DEFAULT 'B'",
                'price'         => 'int(10) DEFAULT NULL',
                'practise_time' => 'int(10) DEFAULT NULL',
                'theory_time'   => 'int(10) DEFAULT NULL',
                'description'   => 'text  DEFAULT NULL',
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );


    }

	public function safeDown()
	{

        $this->dropTable( '{{category}}' );
	}

}