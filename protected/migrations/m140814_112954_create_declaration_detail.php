<?php

class m140814_112954_create_declaration_detail extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable( '{{declaration_detail}}', array(
                'id'                    => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'declaration_id'        => 'int(10) unsigned NOT NULL',
                'invoice_num_and_date'  => 'varchar(50) NOT NULL',
                'customs_tariff_number' => 'varchar(30) NOT NULL',
                'prod_prom_code'        => 'varchar(30) NOT NULL',
                'price_list_id'         => 'int(10) unsigned NOT NULL',
                'price_list_code'       => 'varchar(10) NOT NULL',
                'price_list_name'       => 'varchar(120) NOT NULL',
                'total_weight'          => 'decimal(10,2) NOT NULL',
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
        $this->addForeignKey( 'fk_declaration_detail_declaration_id_declaration_id', '{{declaration_detail}}',
            'declaration_id', '{{declaration}}', 'id', 'RESTRICT', 'CASCADE'
        );
        $this->addForeignKey( 'fk_declaration_detail_price_list_id_price_list_id', '{{declaration_detail}}',
            'price_list_id', '{{price_list}}', 'id', 'RESTRICT', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable( '{{declaration_detail}}' );

    }

}