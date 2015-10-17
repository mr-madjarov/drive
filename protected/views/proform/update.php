<?php
$this->breadcrumbs = array(
    'Proforms' => array( 'index' ),
    $model->id => array( 'view', 'id' => $model->id ),
    'Update',
);

$this->menu = array(
    array( 'label' => 'List Proform', 'url' => array( 'index' ) ),
    array( 'label' => 'Create Proform', 'url' => array( 'create' ) ),
    array( 'label' => 'View Proform', 'url' => array( 'view', 'id' => $model->id ) ),
    array( 'label' => 'Manage Proform', 'url' => array( 'admin' ) ),
);
?>

    <h2>Update Proform <?php echo $model->id; ?></h2>

<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>