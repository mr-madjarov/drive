<?php
$this->breadcrumbs = array(
    'Proforms',
);

$this->menu = array(
    array( 'label' => 'Create Proform', 'url' => array( 'create' ) ),
    array( 'label' => 'Manage Proform', 'url' => array( 'admin' ) ),
);
?>

<h2>Proforms</h2>

<?php $this->widget( 'bootstrap.widgets.TbListView', array(
        'dataProvider' => $dataProvider,
        'itemView'     => '_view',
    )
); ?>
