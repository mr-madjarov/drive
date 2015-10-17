<?php
$this->breadcrumbs = array(
    'Field Configs' => array( 'index' ),
    $model->name    => array( 'view', 'id' => $model->id ),
    'Update',
);

$this->menu = array(
    array( 'label' => 'List FieldConfig', 'url' => array( 'index' ) ),
    array( 'label' => 'Create FieldConfig', 'url' => array( 'create' ) ),
    array( 'label' => 'View FieldConfig', 'url' => array( 'view', 'id' => $model->id ) ),
    array( 'label' => 'Manage FieldConfig', 'url' => array( 'admin' ) ),
);
?>

    <h2>Update FieldConfig <?php echo $model->id; ?></h2>

<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>