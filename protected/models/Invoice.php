<?php

/**
 * This is the model class for table "{{invoice}}".
 *
 * The followings are the available columns in table '{{invoice}}':
 *
 * @property string      $id
 * @property string      $created_date
 * @property string      $declaration_id
 * @property string      $status
 * @property string      $created_by_user_id
 * @property string      $number
 * @property string      $payment_type
 *
 * The followings are the available model relations:
 * @property User        $createdByUser
 * @property Declaration $declaration
 */
class Invoice extends ActiveRecord
{
    const STATUS_UNPAID = 'unpaid';

    const STATUS_PAID = 'paid';

    const STATUS_SIGNED = 'signed';

    const PAYMENT_TYPE_CASH = 'cash';

    const PAYMENT_TYPE_BANK = 'bank';


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{invoice}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'created_date, declaration_id, created_by_user_id, number', 'required' ),
            array( 'declaration_id, created_by_user_id, number', 'length', 'max' => 10 ),
            array( 'status', 'length', 'max' => 6 ),
            array( 'payment_type', 'length', 'max' => 4 ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, created_date, declaration_id, status, created_by_user_id, number, payment_type',
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
            'createdByUser' => array( self::BELONGS_TO, 'User', 'created_by_user_id' ),
            'declaration'   => array( self::BELONGS_TO, 'Declaration', 'declaration_id' ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                 => 'Invoice',
            'created_date'       => 'Created Date',
            'declaration_id'     => 'Declaration',
            'status'             => 'Status',
            'created_by_user_id' => 'Created By User',
            'number'             => 'Number',
            'payment_type'       => 'Payment Type',
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
        $criteria->compare( 'created_date', $this->created_date, true );
        $criteria->compare( 'declaration_id', $this->declaration_id, true );
        $criteria->compare( 'status', $this->status, true );
        $criteria->compare( 'created_by_user_id', $this->created_by_user_id, true );
        $criteria->compare( 'number', $this->number, true );
        $criteria->compare( 'payment_type', $this->payment_type, true );

        return new CActiveDataProvider( $this, array(
            'criteria' => $criteria,
        ) );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     * @return Invoice the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }
}
