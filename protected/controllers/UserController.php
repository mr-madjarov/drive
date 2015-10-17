<?php

class UserController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array( 'index' ),
                'roles'   => array( 'aUserView' ),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array( 'create', 'update' ),
                'roles'   => array( 'aUserEditProfile' ),
            ),
            array(
                'deny', // deny all users
                'users' => array( '*' ),
            ),
        );
    }


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( isset( $_POST[ 'User' ] ) ) {
            $model->attributes = $_POST[ 'User' ];
            if ( $model->save() ) {
                $this->redirect( array( 'index' ) );
            }
        }

        $this->render( 'create', array(
                'model' => $model,
            )
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate( $id )
    {
        $model = $this->loadModel( $id );

        unset( $model->password );

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( isset( $_POST[ 'User' ] ) ) {
            $model->attributes = $_POST[ 'User' ];
            if ( $model->save() ) {
                $this->redirect( array( 'index' ) );
            }
        }

        $this->render( 'update', array(
                'model' => $model,
            )
        );
    }



    /**
     * Lists all models.
     */
    public function actionIndex()
    {

        $dataProvider = new CActiveDataProvider( 'User' );
        $this->render( 'index', array(
                'dataProvider' => $dataProvider,
            )
        );
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param $id
     * @throws CHttpException
     * @param $id integer the $integer ID of the model to be loaded
     * @return User
     */
    public function loadModel( $id )
    {
        $model = User::model()->findByPk( $id );
        if ( $model === null ) {
            throw new CHttpException( 404, 'The requested page does not exist.' );
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     *
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation( $model )
    {
        if ( isset( $_POST[ 'ajax' ] ) && $_POST[ 'ajax' ] === 'user-form' ) {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }
    }
}
