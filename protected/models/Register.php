<?php

/**
 * This is the model class for table "{{register}}".
 *
 * The followings are the available columns in table '{{register}}':
 *
 * @property string   $id
 * @property string   $first_name
 * @property string   $last_name
 * @property string   $email
 * @property string   $phone
 * @property string   $address
 * @property string   $category_id
 *
 * The followings are the available model relations:
 * @property Category $category
 */
class Register extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{register}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'first_name, last_name, email, phone, category_id', 'required' ),
            array( 'first_name, last_name', 'length', 'max' => 250 ),
            array( 'email', 'length', 'max' => 150 ),
            array( 'email', 'email' ),
            array( 'phone', 'length', 'max' => 64 ),
            array( 'phone', 'numerical' ),
            array( 'category_id', 'length', 'max' => 10 ),
            array( 'address', 'safe' ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array( 'id, first_name, last_name, email, phone, address, category_id', 'safe', 'on' => 'search' ),
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
            'category' => array( self::BELONGS_TO, 'Category', 'category_id' ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'          => t( 'ID'),
            'first_name'  => t( 'First Name'),
            'last_name'   => t( 'Last Name'),
            'email'       => t( 'Email'),
            'phone'       => t( 'Phone') ,
            'address'     => t( 'Address'),
            'category_id' => t( 'Category'),
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
        $criteria->compare( 'first_name', $this->first_name, true );
        $criteria->compare( 'last_name', $this->last_name, true );
        $criteria->compare( 'email', $this->email, true );
        $criteria->compare( 'phone', $this->phone, true );
        $criteria->compare( 'address', $this->address, true );
        $criteria->compare( 'category_id', $this->category_id, true );

        return new CActiveDataProvider( $this, array(
            'criteria' => $criteria,
        ) );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     * @return Register the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }
}
