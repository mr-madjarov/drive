<?php
$this->breadcrumbs = array(
    'Field Configs',
);

$this->menu = array(
    array( 'label' => 'Create FieldConfig', 'url' => array( 'create' ) ),
    array( 'label' => 'Manage FieldConfig', 'url' => array( 'admin' ) ),
);
?>

<h2>Field Configs</h2>

<?php $this->widget( 'bootstrap.widgets.TbListView', array(
        'dataProvider' => $dataProvider,
        'itemView'     => '_view',
    )
); ?>
