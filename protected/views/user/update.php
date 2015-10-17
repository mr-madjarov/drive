<?php
/** @var $this UserController */
/** @var $model  User */
?>

    <div class="well well-small">
        <h2><?php echo t( DEFAULT_LANG_CATEGORY . 'Update' ) . ' ' . $model->name; ?></h2>
        <?php
        $this->breadcrumbs = array(
            'Users'      => array( 'index' ),
            $model->name => array( 'view', 'id' => $model->id ),
            'Update',
        );

        $this->menu = array(
            array( 'label' => 'List User', 'url' => array( 'index' ) ),
            array( 'label' => 'Create User', 'url' => array( 'create' ) ),
            array( 'label' => 'View User', 'url' => array( 'view', 'id' => $model->id ) ),
            array( 'label' => 'Manage User', 'url' => array( 'admin' ) ),
        );
        ?>
        <!--<h1>Update User <?php /*echo $model->id; */?></h1>-->

    </div>
<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>
