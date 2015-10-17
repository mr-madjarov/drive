<?php
$this->breadcrumbs = array(
    'Invoices' => array( 'index' ),
    'Create',
);

$this->menu = array(
    array( 'label' => 'List Invoice', 'url' => array( 'index' ) ),
    array( 'label' => 'Manage Invoice', 'url' => array( 'admin' ) ),
);
?>

    <h2>Create Invoice</h2>

<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>