<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 *
 * @property string                       $id
 * @property string                       $username
 * @property string                       $password
 * @property string                       $name
 * @property string                       $first_name
 * @property string                       $last_name
 * @property string                       $phone
 * @property string                       $address
 * @property int                          $active
 *
 *
 * The followings are the available model relations:
 * @property CAuthAssignment[]            $authAssignments
 *
 * Magic properties
 * @property string[]                     $roles
 */
class User extends ActiveRecord
{
    /**
     * The constant for indicating that the user is active (can login).
     */
    const ACTIVE = 1;

    /**
     * The constant for indicating that the user is inactive (cannot login).
     */
    const INACTIVE = 0;

    /**
     * @var string password confirmation field.
     */
    public $password_repeat;

    /**
     * @var string[] the RBAC roles of the current user.
     */
    public $roles;

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return User the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'username,roles, active, first_name, last_name', 'required' ),
            array( 'username', 'unique' ),
            array( 'username', 'email' ),
            array( 'password, password_repeat', 'required', 'except' => 'update' ),
            array( 'username, password', 'length', 'max' => 100 ),
            array( 'name', 'length', 'max' => 250 ),
            array( 'phone,first_name, last_name', 'length', 'max' => 64 ),
            array( 'phone', 'numerical' ),
            array( 'category_id', 'numerical' ),
            array( 'address', 'length', 'max' => 500),


            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, username, name,first_name, last_name, active,phone,address,category_id',
                'safe',
                'on' => 'search'
            ),
            array( 'password', 'compare' ),
            array( 'password_repeat', 'safe' ),
            array( 'active', 'in', 'range' => array( User::ACTIVE, User::INACTIVE ) ),

        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'authAssignments'    => array( self::HAS_MANY, 'AuthAssignment', 'userid' ),
            'categoryId'    => array( self::BELONGS_TO, 'Category', 'category_id' ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'              => 'User',
            'username'        => 'Username',
            'password'        => 'Password',
            'name'            => 'Name',
            'category_id'     => 'Category',
            'active'          => 'Active',
            'roles'           => 'Roles',
            'password_repeat' => 'Password Repeat',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->order = 't.`name`';

        $criteria->compare( 't.`name`', $this->name, true );
        $criteria->compare( 't.`active`', $this->active, true );

        return new CActiveDataProvider( $this, array(
            'criteria' => $criteria,
        ) );
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return array(
            'withRelated' => array(
                'class' => 'ext.behaviors.wr.WithRelatedBehavior',
            ),
        );
    }

    /**
     * Overrides the CActiveRecord save() method in order to implement saving of related models.
     *
     * @param bool  $runValidation Whether to perform validation before saving the record.
     *                             If the validation fails, the record will not be saved to database.
     * @param array $attributes
     *
     * @throws Exception
     * @return bool Whether the saving was successful.
     */
    public function save( $runValidation = true, $attributes = null )
    {
        $transaction = $this->getDbConnection()->beginTransaction();
        try {
            // Save the model with the relations
            if ( $this->withRelated->save( $runValidation, $attributes ) ) {
                $transaction->commit();
                return true;
            }
            return false;
        } catch ( Exception $ex ) {
            $transaction->rollback();
            throw $ex;
        }
    }

    /**
     * @return bool
     */
    protected function beforeSave()
    {
        // Hash the password
        if ( !empty( $this->password ) ) {
            $ph = new PasswordHash( Yii::app()->params[ 'phpass' ][ 'iteration_count_log2' ], Yii::app()->params[ 'phpass' ][ 'portable_hashes' ] );
            $this->password = $ph->HashPassword( $this->password );
        } else {
            // The password is empty
            if ( !$this->isNewRecord ) {
                // Do not save (overwrite) the password to the database when updating
                unset( $this->password );
            }
        }

        return parent::beforeSave();
    }

    protected function afterSave()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Assign roles to the user
        // -------------------------------------------------------------------------------------------------------------
        if ( $this->isNewRecord ) { // We are executing the Create action
            // Assign the selected roles to the user
            if ( !empty( $this->roles ) ) {
                foreach ( $this->roles as $role ) {
                    Yii::app()->authManager->assign( $role, $this->id );
                }
            }
        } else { // We are executing the Update action
            // Revoke the current roles before assigning the new ones
            $assignedRoles = array_keys( Yii::app()->authManager->getRoles( $this->id ) );
            foreach ( $assignedRoles as $assignedRole ) {
                Yii::app()->authManager->revoke( $assignedRole, $this->id );
            }
            // Assign the selected roles to the user
            if ( !empty( $this->roles ) ) {
                foreach ( $this->roles as $role ) {
                    Yii::app()->authManager->assign( $role, $this->id );
                }
            }
        }
        // end of Assign roles to the user -----------------------------------------------------------------------------

        parent::afterSave();
    }

    /**
     *
     */
    protected function afterFind()
    {
        // Load the currently assigned roles into the model
        $this->roles = array_keys( Yii::app()->authManager->getRoles( $this->id ) );

        parent::afterFind();
    }
}