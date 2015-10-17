<?php

class RegisterController extends Controller
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
                'actions' => array( 'create' ),
                'users'   => array( '*' ),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array( 'index', 'update', 'view' ),
                'users'   => array( 'admin' ),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array( 'admin', 'delete' ),
                'users'   => array( 'admin' ),
            ),
            array(
                'deny', // deny all users
                'users' => array( '*' ),
            ),
        );
    }

    /**
     * Displays a particular model.
     *
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView( $id )
    {
        $this->render( 'view', array(
                'model' => $this->loadModel( $id ),
            )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Register;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( isset( $_POST[ 'Register' ] ) ) {
            $model->attributes = $_POST[ 'Register' ];

            $field_name = $model->first_name . " " . $model->last_name;
            $field_email = $model->email;
            $field_message = "\nThis is the following info: \n" . "phone:" . $model->phone . "\n" . "category: ". "\n" . $model->category_id . "\n" .

            $mail_to = 'mr.madjarov@gmail.com';
            $subject = 'There is registered User:  ' . $field_name;

			$body_message  = 'From: ' . $field_name . "\n". 'E-mail: ' . $field_email . "\n" . 'Message: ' . $field_message;


            $headers = 'From: ' . $field_email . "\r\n";
            $headers .= 'Reply-To: ' . $field_email . "\r\n";


            if ( $model->save() ) {
                $mail_status = mail( $mail_to, $subject, $body_message, $headers );
                if ( $mail_status ) {
                    user()->setFlash( "success",
                        t( "Thank you for contacting us. We will respond to you as soon as possible." )
                    );
                    $this->redirect( array( 'site/index' ) );
                    app()->end();
                } else if ( !$mail_status ) {
                    user()->setFlash( "error", t( "Error while sending email" ) );
                }

            } else {
                user()->setFlash( "error", t( "Error while saving data" ) );
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( isset( $_POST[ 'Register' ] ) ) {
            $model->attributes = $_POST[ 'Register' ];
            if ( $model->save() ) {
                $this->redirect( array( 'register/index' ) );
            }
        }

        $this->render( 'update', array(
                'model' => $model,
            )
        );
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete( $id )
    {
        if ( Yii::app()->request->isPostRequest ) {
            // we only allow deletion via POST request
            $this->loadModel( $id )->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if ( !isset( $_GET[ 'ajax' ] ) ) {
                $this->redirect( isset( $_POST[ 'returnUrl' ] ) ? $_POST[ 'returnUrl' ] : array( 'admin' ) );
            }
        } else {
            throw new CHttpException( 400, 'Invalid request. Please do not repeat this request again.' );
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider( 'Register' );
        $this->render( 'index', array(
                'dataProvider' => $dataProvider,
            )
        );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Register( 'search' );
        $model->unsetAttributes(); // clear any default values
        if ( isset( $_GET[ 'Register' ] ) ) {
            $model->attributes = $_GET[ 'Register' ];
        }

        $this->render( 'admin', array(
                'model' => $model,
            )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer the ID of the model to be loaded
     */
    public function loadModel( $id )
    {
        $model = Register::model()->findByPk( $id );
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
        if ( isset( $_POST[ 'ajax' ] ) && $_POST[ 'ajax' ] === 'register-form' ) {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }
    }
}
