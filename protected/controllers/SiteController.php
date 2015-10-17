<?php

class SiteController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array( 'index' ),
                'users'   => array( '*' ),
            ),
            array(
                'allow',
                'actions' => array( 'login', 'logout', 'error' ),
                'users'   => array( '*' ),
            ),
            array(
                'deny', // deny all users
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/login.php'
        $this->render( 'index' );

    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ( $error = Yii::app()->errorHandler->error ) {
            if ( Yii::app()->request->isAjaxRequest ) {
                echo $error[ 'message' ];
            } else {
                $this->render( 'error', $error );
            }
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $this->layout = '//layouts/login';
        $model = new LoginForm;

        // if it is ajax validation request
        if ( isset( $_POST[ 'ajax' ] ) && $_POST[ 'ajax' ] === 'login-form' ) {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }

        // collect user input data
        if ( isset( $_POST[ 'LoginForm' ] ) ) {
            $model->attributes = $_POST[ 'LoginForm' ];
            // validate user input and redirect to the previous page if valid
            if ( $model->validate() && $model->login() ) {
                $this->redirect( Yii::app()->user->returnUrl );
            }
        }
        // display the login form
        $this->render( 'login', array( 'model' => $model ) );
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect( Yii::app()->homeUrl );
    }
}
