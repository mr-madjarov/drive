<?php

class m140815_093139_create_coordinate_config extends CDbMigration
{


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable( '{{coordinate_config}}', array(
                'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'document_type' => "ENUM( 'declaration', 'invoice', 'certificate') NOT NULL ",
                'visible' => 'tinyint(1) DEFAULT 1 NOT NULL',
                'lower_left_x' => 'int(10) NOT NULL',
                'lower_left_y' => 'int(10) NOT NULL',
                'upper_right_x' => 'int(10) NOT NULL',
                'upper_right_y' => 'int(10) NOT NULL',
                'reason' => 'varchar(150)  NOT NULL',
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

        $this->createIndex( 'idx_coordinate_config_unique_document_type', '{{coordinate_config}}', 'document_type', true
        );

        $this->insert( '{{coordinate_config}}', array(
                'document_type' => 'declaration',
                'visible'       => 1,
                'lower_left_x'  => 0,
                'lower_left_y'  => 0,
                'upper_right_x' => 0,
                'upper_right_y' => 0,
                'reason'        => '',
            )
        );
        $this->insert( '{{coordinate_config}}', array(
                'document_type' => 'invoice',
                'visible'       => 1,
                'lower_left_x'  => 0,
                'lower_left_y'  => 0,
                'upper_right_x' => 0,
                'upper_right_y' => 0,
                'reason'        => '',
            )
        );
        $this->insert( '{{coordinate_config}}', array(
                'document_type' => 'certificate',
                'visible'       => 1,
                'lower_left_x'  => 0,
                'lower_left_y'  => 0,
                'upper_right_x' => 0,
                'upper_right_y' => 0,
                'reason'        => '',
            )
        );


    }

    public function safeDown()
    {
        $this->dropTable( '{{coordinate_config}}' );

    }

}