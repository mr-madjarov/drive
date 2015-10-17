<?php

class m140813_220233_proform extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable( '{{proform}}', array(
                'id'                 => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'creationDate'       => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                'declaration_id'     => 'int(10) unsigned NOT NULL ',
                'created_by_user_id' => 'int(10) unsigned NOT NULL',
                'number'             => 'varchar(10) NOT NULL ',
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
        $this->addForeignKey( 'fk_proform_created_by_user_id_user_id', '{{proform}}', 'created_by_user_id', '{{user}}',
            'id', 'RESTRICT', 'CASCADE'
        );
        $this->addForeignKey( 'fk_proform_declaration_id_declaration_id', '{{proform}}', 'declaration_id', '{{declaration}}',
            'id', 'RESTRICT', 'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropTable( '{{proform}}' );
    }

}