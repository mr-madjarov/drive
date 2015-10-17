<?php

/**
 * This is the model class for table "{{coordinate_config}}".
 *
 * The followings are the available columns in table '{{coordinate_config}}':
 * @property string $id
 * @property string $document_type
 * @property integer $visible
 * @property integer $lower_left_x
 * @property integer $lower_left_y
 * @property integer $upper_right_x
 * @property integer $upper_right_y
 * @property string $reason
 */
class CoordinateConfig extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{coordinate_config}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('document_type, lower_left_x, lower_left_y, upper_right_x, upper_right_y, reason', 'required'),
			array('visible, lower_left_x, lower_left_y, upper_right_x, upper_right_y', 'numerical', 'integerOnly'=>true),
			array('document_type', 'length', 'max'=>11),
			array('reason', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, document_type, visible, lower_left_x, lower_left_y, upper_right_x, upper_right_y, reason', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'document_type' => 'Document Type',
			'visible' => 'Visible',
			'lower_left_x' => 'Lower Left X',
			'lower_left_y' => 'Lower Left Y',
			'upper_right_x' => 'Upper Right X',
			'upper_right_y' => 'Upper Right Y',
			'reason' => 'Reason',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('document_type',$this->document_type,true);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('lower_left_x',$this->lower_left_x);
		$criteria->compare('lower_left_y',$this->lower_left_y);
		$criteria->compare('upper_right_x',$this->upper_right_x);
		$criteria->compare('upper_right_y',$this->upper_right_y);
		$criteria->compare('reason',$this->reason,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CoordinateConfig the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
