<?php

class PriceListController extends Controller
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
                'roles'   => array( 'aPriceListIndex' ),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array( 'create', 'update' ),
                'roles'   => array( 'aPriceListIndex' ),
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
        $model = new PriceList;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( isset( $_POST[ 'PriceList' ] ) ) {
            $model->attributes = $_POST[ 'PriceList' ];
            if ( $model->save() ) {
                user()->setFlash( "success", t( "The price was successfully created." ) );
                $this->redirect( array( 'index' ) );
                app()->end();
            } else {
                /**
                 * TODO: Да извежда съобщение за грешка
                 * user()->setFlash( "error", t( "There are errors while creating the price." ) );
                 *
                 */
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

        if ( isset( $_POST[ 'PriceList' ] ) ) {
            $model->attributes = $_POST[ 'PriceList' ];
            if ( $model->save() ) {
                user()->setFlash( "success", t( "The price was successfully saved." ) );
                $this->redirect( array( 'index' ) );
                app()->end();
            } else {
                /**
                 * TODO: Да извежда съобщение за грешка
                 * user()->setFlash( "error", t( "There are errors while saving the price." ) );
                 *
                 */

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
        $dataProvider = new CActiveDataProvider( 'PriceList' );
        $this->render( 'index', array(
                'dataProvider' => $dataProvider,
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
        $model = PriceList::model()->findByPk( $id );
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
        if ( isset( $_POST[ 'ajax' ] ) && $_POST[ 'ajax' ] === 'price-list-form' ) {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }
    }
}
