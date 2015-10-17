<?php
$this->breadcrumbs = array(
    'Proforms' => array( 'index' ),
    'Create',
);

$this->menu = array(
    array( 'label' => 'List Proform', 'url' => array( 'index' ) ),
    array( 'label' => 'Manage Proform', 'url' => array( 'admin' ) ),
);
?>

    <h2>Create Proform</h2>

<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>