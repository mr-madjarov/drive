<?php

class CoordinateConfigController extends Controller
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
                'allow', // allow authenticated user to perform  'update' actions
                'actions' => array( 'update' ),
                'roles'   => array( 'aCoordinateConfigUpdate' ),
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
    public function actionUpdate()
    {
        /** @var CoordinateConfig[] $models */
        $models = CoordinateConfig::model()->findAll( array(
                'index' => 'id'
            )
        );

        if ( isset( $_POST[ 'CoordinateConfig' ] ) ) {
            $saveError = false;
            $transaction = CoordinateConfig::model()->getDbConnection()->beginTransaction();
            foreach ( $models as $id => $model ) {
                if ( isset( $_POST[ 'CoordinateConfig' ][ $id ] ) ) {
                    $model->attributes = $_POST[ 'CoordinateConfig' ][ $id ];
                    if( !$model->save() )
                        $saveError = true;
                }
            }
            if( !$saveError ) {
                $transaction->commit();
                user()->setFlash( "success", t( "The coordinates were successfully saved." ) );
                $this->redirect( array( 'adminPanel/index' ) );
                app()->end();
            } else {
                user()->setFlash( "error", t( "There are errors while saving the coordinates." ) );
                $transaction->rollback();
            }
        }

        /*if ( isset( $_POST[ 'CoordinateConfig' ] ) ) {
            $model->attributes = $_POST[ 'CoordinateConfig' ];
            if ( $model->save() ) {
                $this->redirect( array( 'view', 'id' => $model->id ) );
            }
        }*/

        $this->render( 'update', array(
                'models' => $models,
            )
        );
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param $id
     * @throws CHttpException
     * @internal param \the $integer ID of the model to be loaded
     * @return \CActiveRecord
     */
    public function loadModel( $id )
    {
        $model = CoordinateConfig::model()->findByPk( $id );
        if ( $model === null ) {
            throw new CHttpException( 404, 'The requested page does not exist.' );
        }
        return $model;
    }
}

