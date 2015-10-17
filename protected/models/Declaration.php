<?php

/**
 * This is the model class for table "{{declaration}}".
 *
 * The followings are the available columns in table '{{declaration}}':
 *
 * @property string              $id
 * @property string              $number
 * @property string              $from_date
 * @property string              $to_date
 * @property string              $created_date
 * @property string              $created_by_user_id
 * @property string              $type
 * @property integer             $signed
 *
 * The followings are the available model relations:
 * @property User                $createdByUser
 * @property DeclarationDetail[] $declarationDetails
 * @property Invoice[]           $invoices
 * @property Proform[]           $proforms
 */
class Declaration extends ActiveRecord
{
    const TYPE_NORMAL = 'normal';
    const TYPE_NULL = 'null';
    const SIGNED_YES = 'yes';
    const SIGNED_NO = 'no';

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{declaration}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'from_date, to_date, type', 'required' ),
            array( 'type', 'length', 'max' => 6 ),
            array( 'from_date, to_date', 'date', 'format' => 'dd.MM.yyyy' ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, number, from_date, to_date, created_date, created_by_user_id, type, signed',
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
            'createdByUser'      => array( self::BELONGS_TO, 'User', 'created_by_user_id' ),
            'declarationDetails' => array( self::HAS_MANY, 'DeclarationDetail', 'declaration_id' ),
            'invoices'           => array( self::HAS_MANY, 'Invoice', 'declaration_id' ),
            'proforms'           => array( self::HAS_MANY, 'Proform', 'declaration_id' ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                 => 'Declaration',
            'number'             => 'Number',
            'from_date'          => 'From Date',
            'to_date'            => 'To Date',
            'created_date'       => 'Created Date',
            'created_by_user_id' => 'Created By User',
            'type'               => 'Type',
            'signed'             => 'Signed',
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
        $criteria->compare( 'number', $this->number, true );
        $criteria->compare( 'from_date', $this->from_date, true );
        $criteria->compare( 'to_date', $this->to_date, true );
        $criteria->compare( 'created_date', $this->created_date, true );
        $criteria->compare( 'created_by_user_id', $this->created_by_user_id, true );
        $criteria->compare( 'type', $this->type, true );
        $criteria->compare( 'signed', $this->signed );

        return new CActiveDataProvider( $this, array(
            'criteria' => $criteria,
        ) );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     * @return Declaration the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }

    protected function afterValidate()
    {
        if( count( $this->declarationDetails ) == 0 ) {
            $this->addError( 'declarationDetails', t( 'Declaration must have at least one detail row' ) );
        } else {
            $detailErrors = false;
            foreach( $this->declarationDetails  AS $detail ) {
                if( !$detail->validate() ) {
                    $detail->clearErrors( 'declaration_id' );
                }
                if( $detail->hasErrors() )
                    $detailErrors = true;
            }
            if( $detailErrors )
                $this->addError( 'declarationDetails', t( 'Please check the information you have entered for declaration details.' ) );
        }

        if ( strtotime( $this->from_date ) > strtotime( $this->to_date ) && !$this->hasErrors( 'to_date' ) )
            $this->addError( 'from_date', t( '"From date" must be lower than "To Date"' ) );

        if( !$this->getIsNewRecord() && $this->signed == Declaration::SIGNED_YES )
            $this->addError( 'id', t( 'Cannot edit signed declaration' ) );

        parent::afterValidate();
    }

    protected function beforeSave()
    {
        $this->from_date = date( 'Y-m-d', strtotime( $this->from_date ) );
        $this->to_date = date( 'Y-m-d', strtotime( $this->to_date ) );

        if( empty( $this->signed ) )
            $this->signed = Declaration::SIGNED_NO;

        if( $this->getIsNewRecord() ) {
            $this->number = $this->createDeclarationNumber();
            $this->created_by_user_id = user()->id;
        }

        return parent::beforeSave();
    }

    protected function afterSave()
    {
        //At this point our details are valid (we ran validate method of every detail)

        /**
         * Delete all old details (from DB)
         */

        /** @var DeclarationDetail[] $oldDetails */
        $oldDetails = DeclarationDetail::model()->findAllByAttributes( array( 'declaration_id' => $this->id ) );

        foreach( $oldDetails as $detail )
            $detail->delete();

        /**
         * Save new details to DB
         */
        foreach( $this->declarationDetails as $detail ) {
            $detail->declaration_id = $this->id;
            $detail->save( false );
        }

        parent::afterSave();
    }

    private function createDeclarationNumber()
    {
        //we should get ConfigGroup->type == counters
        //then find declaration field config

        /** @var FieldConfig $declarationCounter */
        $declarationCounter = ConfigGroup::model()->counters()->find()->fieldConfigs[ 'declaration' ];

        $currentCounter = max( intval( $declarationCounter->value ), 1 );

        //increment with 1 and update to DB
        $newCounter = $currentCounter + 1;

        $declarationCounter->value = str_pad( $newCounter, 10, '0', STR_PAD_LEFT );
        $declarationCounter->save();

        //return the old value
        return str_pad( $currentCounter, 10, '0', STR_PAD_LEFT );
    }
}
