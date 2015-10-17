<?php

class m140814_223622_create_field_config extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable( '{{field_config}}', array(
                'id'              => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
                'name'            => 'varchar(120) NOT NULL ',
                'value'           => 'varchar(120) NOT NULL ',
                'label'           => 'varchar(120) NOT NULL ',
                'config_group_id' => 'int(10) unsigned NOT NULL',
                'PRIMARY KEY (id)',
            ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );
        $this->addForeignKey( 'fk_field_config_group_id_config_group_id', '{{field_config}}', 'config_group_id',
            '{{config_group}}', 'id', 'RESTRICT', 'CASCADE'
        );

        $this->createIndex( 'idx_field_config_unique_name', '{{field_config}}', 'name, config_group_id', true );

        $firmGroupId = $this->dbConnection->createCommand()->select( 'id' )->from( '{{config_group}}' )
            ->where( 'type=:type', array( ':type' => 'firm' ) )->queryScalar();


        $records = array(
            array( 'name' => 'name', 'value' => '', 'label' => 'Name', 'config_group_id' => $firmGroupId ),
            array( 'name' => 'id_number', 'value' => '', 'label' => 'Id Number', 'config_group_id' => $firmGroupId ),
            array( 'name' => 'address', 'value' => '', 'label' => 'Address', 'config_group_id' => $firmGroupId ),
            array( 'name'            => 'correspondence_address',
                   'value'           => '',
                   'label'           => 'Correspondence Address',
                   'config_group_id' => $firmGroupId
            ),
            array( 'name' => 'vat_number', 'value' => '', 'label' => 'Vat Number', 'config_group_id' => $firmGroupId ),
            array( 'name' => 'mol', 'value' => '', 'label' => 'MOL', 'config_group_id' => $firmGroupId ),
            array( 'name' => 'bank', 'value' => '', 'label' => 'Bank', 'config_group_id' => $firmGroupId ),
            array( 'name' => 'iban', 'value' => '', 'label' => 'IBAN', 'config_group_id' => $firmGroupId ),
            array( 'name' => 'bic', 'value' => '', 'label' => 'BIC', 'config_group_id' => $firmGroupId ),
        );

        foreach ( $records as $row ) {
            $this->insert( '{{field_config}}', $row );
        }
        $emailGroupId = $this->dbConnection->createCommand()->select( 'id' )->from( '{{config_group}}' )
            ->where( 'type=:type', array( ':type' => 'email' ) )->queryScalar();

        $records = array(
            array( 'name' => 'server', 'value' => '', 'label' => 'Server', 'config_group_id' => $emailGroupId ),
            array( 'name' => 'port', 'value' => '', 'label' => 'Port', 'config_group_id' => $emailGroupId ),
            array( 'name' => 'user_name', 'value' => '', 'label' => 'User Name', 'config_group_id' => $emailGroupId ),
            array( 'name' => 'password', 'value' => '', 'label' => 'Password', 'config_group_id' => $emailGroupId ),
            array( 'name' => 'cc', 'value' => '', 'label' => 'CC', 'config_group_id' => $emailGroupId ),
            array( 'name' => 'from', 'value' => '', 'label' => 'From', 'config_group_id' => $emailGroupId ),

        );
        foreach ( $records as $row ) {
            $this->insert( '{{field_config}}', $row );
        }
        $counterGroupId = $this->dbConnection->createCommand()->select( 'id' )->from( '{{config_group}}' )
            ->where( 'type=:type', array( ':type' => 'counter' ) )->queryScalar();

        $records = array(
            array( 'name'            => 'declaration',
                   'value'           => '',
                   'label'           => 'Declaration Current Number ',
                   'config_group_id' => $counterGroupId
            ),
            array( 'name'            => 'proform',
                   'value'           => '',
                   'label'           => 'Proform Current Number',
                   'config_group_id' => $counterGroupId
            ),
            array( 'name'                   => 'invoice',
                   'value'                  => '',
                   'label'                  => 'Invoice Current Number',
                   'config_group_id' => $counterGroupId
            ),
            array( 'name'                       => 'certificate',
                   'value'                      => '',
                   'label'                      => 'Certificate Current Number',
                   'config_group_id' => $counterGroupId
            ),

        );
        foreach ( $records as $row ) {
            $this->insert( '{{field_config}}', $row );
        }

    }

    public function safeDown()
    {
        $this->dropTable( '{{field_config}}' );

    }

}