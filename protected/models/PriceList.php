<?php

/**
 * This is the model class for table "{{price_list}}".
 *
 * The followings are the available columns in table '{{price_list}}':
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property string $price
 */
class PriceList extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{price_list}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'code, name, price', 'required' ),
            array( 'code', 'length', 'max' => 10 ),
            array( 'name', 'length', 'max' => 120 ),
            array( 'price', 'numerical', 'min' => 0 ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array( 'id, code, name, price', 'safe', 'on' => 'search' ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'    => 'Price List',
            'code'  => 'Code',
            'name'  => 'Name',
            'price' => 'Price',
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
        $criteria->compare( 'code', $this->code, true );
        $criteria->compare( 'name', $this->name, true );
        $criteria->compare( 'price', $this->price, true );

        return new CActiveDataProvider( $this, array(
            'criteria' => $criteria,
        ) );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     * @return PriceList the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }
}
