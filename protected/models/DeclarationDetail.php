<?php

/**
 * This is the model class for table "{{declaration_detail}}".
 *
 * The followings are the available columns in table '{{declaration_detail}}':
 *
 * @property string      $id
 * @property string      $declaration_id
 * @property string      $invoice_num_and_date
 * @property string      $customs_tariff_number
 * @property string      $prod_prom_code
 * @property string      $price_list_id
 * @property string      $price_list_code
 * @property string      $price_list_name
 * @property string      $total_weight
 *
 * The followings are the available model relations:
 * @property PriceList   $priceList
 * @property Declaration $declaration
 */
class DeclarationDetail extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{declaration_detail}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'declaration_id, invoice_num_and_date, customs_tariff_number, prod_prom_code, price_list_id, price_list_code, price_list_name, total_weight',
                'required'
            ),
            array( 'total_weight', 'numerical' ),
            array( 'declaration_id, price_list_id, price_list_code', 'length', 'max' => 10 ),
            array( 'invoice_num_and_date', 'length', 'max' => 50 ),
            array( 'customs_tariff_number, prod_prom_code', 'length', 'max' => 30 ),
            array( 'price_list_name', 'length', 'max' => 120 ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, declaration_id, invoice_num_and_date, customs_tariff_number, prod_prom_code, price_list_id, price_list_code, price_list_name, total_weight',
                'safe',
                'on' => 'search'
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'priceList'   => array( self::BELONGS_TO, 'PriceList', 'price_list_id' ),
            'declaration' => array( self::BELONGS_TO, 'Declaration', 'declaration_id' ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                    => 'Declaration Details',
            'declaration_id'        => 'Declaration ID',
            'invoice_num_and_date'  => 'Invoice Number And Date',
            'customs_tariff_number' => 'Customs Tariff Number',
            'prod_prom_code'        => 'ProdProm Code',
            'price_list_id'         => 'Price List',
            'price_list_code'       => 'Price List Code',
            'price_list_name'       => 'Price List Name',
            'total_weight'          => 'Total Weight',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare( 'id', $this->id, true );
        $criteria->compare( 'declaration_id', $this->declaration_id, true );
        $criteria->compare( 'invoice_num_and_date', $this->invoice_num_and_date, true );
        $criteria->compare( 'customs_tariff_number', $this->customs_tariff_number, true );
        $criteria->compare( 'prod_prom_code', $this->prod_prom_code, true );
        $criteria->compare( 'price_list_id', $this->price_list_id, true );
        $criteria->compare( 'price_list_code', $this->price_list_code, true );
        $criteria->compare( 'price_list_name', $this->price_list_name, true );
        $criteria->compare( 'total_weight', $this->total_weight, true );

        return new CActiveDataProvider( $this, array(
            'criteria' => $criteria,
        ) );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     * @return DeclarationDetail the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }

    protected function beforeValidate()
    {
        if( !empty( $this->priceList ) ) {
            $this->price_list_code = $this->priceList->code;
            $this->price_list_name = $this->priceList->name;
        } else {
            $this->price_list_code = null;
            $this->price_list_name = null;
        }
        return parent::beforeValidate();
    }
}
