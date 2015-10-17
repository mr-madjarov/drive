<?php

class m140919_095012_alter_user_fields extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn( '{{user}}', 'phone', 'varchar(64) DEFAULT NULL' );
        $this->addColumn( '{{user}}', 'first_name', 'varchar(64) DEFAULT NULL' );
        $this->addColumn( '{{user}}', 'last_name', 'varchar(64) DEFAULT NULL' );
        $this->addColumn( '{{user}}', 'address', 'text DEFAULT NULL' );
        $this->addColumn( '{{user}}', 'category_id', 'int(10) unsigned' );

        $this->addForeignKey( 'fk_user_category_id_category_id', '{{user}}', 'category_id', '{{category}}', 'id',
            'RESTRICT', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey( 'fk_user_category_id_category_id', '{{user}}' );


        $this->dropColumn( '{{user}}', 'phone' );
        $this->dropColumn( '{{user}}', 'first_name' );
        $this->dropColumn( '{{user}}', 'last_name' );
        $this->dropColumn( '{{user}}', 'address' );
        $this->dropColumn( '{{user}}', 'category_id' );
    }
}