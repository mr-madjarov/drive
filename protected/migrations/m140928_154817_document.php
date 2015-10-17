<?php

class m140928_154817_document extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {

        $this->createTable( '{{document}}', array(
                'id'          => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'category_id' => 'int(10) unsigned NOT NULL',
                "content"     => 'text DEFAULT NULL ',
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
        $this->addForeignKey( 'fk_document_category_id_category_id', '{{document}}', 'category_id', '{{category}}',
            'id', 'RESTRICT', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey( 'fk_document_category_id_category_id', '{{document}}' );
        $this->dropTable( '{{document}}' );
    }

}