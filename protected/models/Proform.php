<?php

/**
 * This is the model class for table "{{proform}}".
 *
 * The followings are the available columns in table '{{proform}}':
 *
 * @property string      $id
 * @property string      $creationDate
 * @property string      $declaration_id
 * @property string      $created_by_user_id
 * @property string      $number
 *
 * The followings are the available model relations:
 * @property Declaration $declaration
 * @property User        $createdByUser
 */
class Proform extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{proform}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'creationDate, declaration_id, created_by_user_id, number', 'required' ),
            array( 'declaration_id, created_by_user_id, number', 'length', 'max' => 10 ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array( 'id, creationDate, declaration_id, created_by_user_id, number', 'safe', 'on' => 'search' ),
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
            'declaration'   => array( self::BELONGS_TO, 'Declaration', 'declaration_id' ),
            'createdByUser' => array( self::BELONGS_TO, 'User', 'created_by_user_id' ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                 => 'Proform',
            'creationDate'       => 'Creation Date',
            'declaration_id'     => 'Declaration',
            'created_by_user_id' => 'Created By User',
            'number'             => 'Number',
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
        $criteria->compare( 'creationDate', $this->creationDate, true );
        $criteria->compare( 'declaration_id', $this->declaration_id, true );
        $criteria->compare( 'created_by_user_id', $this->created_by_user_id, true );
        $criteria->compare( 'number', $this->number, true );

        return new CActiveDataProvider( $this, array(
            'criteria' => $criteria,
        ) );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     * @return Proform the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }
}
