<?php

class ConfigController extends Controller
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
                'allow', // allow all users to perform 'firm' actions
                'actions' => array( 'firm' ),
                'roles'   => array( 'aConfigFirm' ),
            ),
            array(
                'allow', // allow all users to perform  'email'  actions
                'actions' => array( 'email' ),
                'roles'   => array( 'aConfigEmail' ),
            ),
            array(
                'allow', // allow all users to perform 'count'  actions
                'actions' => array( 'count' ),
                'roles'   => array( 'aConfigCount' ),
            ),
            array(
                'deny', // deny all users
                'users' => array( '*' ),
            ),
        );
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     */
    public function actionFirm()
    {

        $model = $this->loadModel( ConfigGroup::TYPE_FIRM );


        if ( isset( $_POST[ 'FieldConfig' ] ) ) {
            $saveError = false;
            $transaction = ConfigGroup::model()->getDbConnection()->beginTransaction();
            foreach ( $model->fieldConfigs as $id => $fieldConfig ) {
                if ( isset( $_POST[ 'FieldConfig' ][ $id ] ) ) {
                    $fieldConfig->attributes = $_POST[ 'FieldConfig' ][ $id ];
                    if ( !$fieldConfig->save() ) {
                        $saveError = true;
                    }
                }
            }
            if ( !$saveError ) {
                $transaction->commit();
                user()->setFlash( "success", t( "The firm data were successfully saved." ) );
                $this->redirect( array( 'adminPanel/index' ) );
                app()->end();
            } else {
                user()->setFlash( "error", t( "There are errors while saving the firm data." ) );
                $transaction->rollback();
            }
        }
        $this->render( 'updateFirmConfig', array(
                'model' => $model,
            )
        );
    }

    public function actionEmail()
    {

        $model = $this->loadModel( ConfigGroup::TYPE_EMAIL );


        if ( isset( $_POST[ 'FieldConfig' ] ) ) {
            $saveError = false;
            $transaction = ConfigGroup::model()->getDbConnection()->beginTransaction();
            foreach ( $model->fieldConfigs as $id => $fieldConfig ) {
                if ( isset( $_POST[ 'FieldConfig' ][ $id ] ) ) {
                    $fieldConfig->attributes = $_POST[ 'FieldConfig' ][ $id ];
                    if ( !$fieldConfig->save() ) {
                        $saveError = true;
                    }
                }
            }
            if ( !$saveError ) {
                $transaction->commit();
                user()->setFlash( "success", t( "The email data were successfully saved." ) );
                $this->redirect( array( 'adminPanel/index' ) );
                app()->end();
            } else {
                user()->setFlash( "error", t( "There are errors while saving the email data." ) );
                $transaction->rollback();
            }
        }
        $this->render( 'updateEmailConfig', array(
                'model' => $model,
            )
        );
    }

    public function actionCount()
    {

        $model = $this->loadModel( ConfigGroup::TYPE_COUNT );


        if ( isset( $_POST[ 'FieldConfig' ] ) ) {
            $saveError = false;
            $transaction = ConfigGroup::model()->getDbConnection()->beginTransaction();
            foreach ( $model->fieldConfigs as $id => $fieldConfig ) {
                if ( isset( $_POST[ 'FieldConfig' ][ $id ] ) ) {
                    $fieldConfig->attributes = $_POST[ 'FieldConfig' ][ $id ];
                    if ( !$fieldConfig->save() ) {
                        $saveError = true;
                    }
                }
            }
            if ( !$saveError ) {
                $transaction->commit();
                user()->setFlash( "success", t( "The counter data were successfully saved." ) );
                $this->redirect( array( 'adminPanel/index' ) );
                app()->end();
            } else {
                user()->setFlash( "error", t( "There are errors while saving the counter data." ) );
                $transaction->rollback();
            }
        }
        $this->render( 'updateCounterConfig', array(
                'model' => $model,
            )
        );
    }



    /**
     * Lists all models.
     */
    /* public function actionIndex()
     {
         $dataProvider = new CActiveDataProvider( 'ConfigGroup' );
         $this->render( 'index', array(
                 'dataProvider' => $dataProvider,
             )
         );
     }*/


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param string $type of the model to be loaded
     * @throws CHttpException
     * @return \ConfigGroup
     */
    public function loadModel( $type )
    {
        $model = ConfigGroup::model()->findByAttributes( array( 'type' => $type ) );
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
        if ( isset( $_POST[ 'ajax' ] ) && $_POST[ 'ajax' ] === 'config-group-form' ) {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }
    }
}
