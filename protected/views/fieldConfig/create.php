<?php
$this->breadcrumbs = array(
    'Field Configs' => array( 'index' ),
    'Create',
);

$this->menu = array(
    array( 'label' => 'List FieldConfig', 'url' => array( 'index' ) ),
    array( 'label' => 'Manage FieldConfig', 'url' => array( 'admin' ) ),
);
?>

    <h2>Create FieldConfig</h2>

<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>