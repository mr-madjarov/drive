<?php
$this->breadcrumbs = array(
    'Proforms' => array( 'index' ),
    $model->id,
);

$this->menu = array(
    array( 'label' => 'List Proform', 'url' => array( 'index' ) ),
    array( 'label' => 'Create Proform', 'url' => array( 'create' ) ),
    array( 'label' => 'Update Proform', 'url' => array( 'update', 'id' => $model->id ) ),
    array(
        'label'       => 'Delete Proform',
        'url'         => '#',
        'linkOptions' => array(
            'submit'  => array( 'delete', 'id' => $model->id ),
            'confirm' => 'Are you sure you want to delete this item?'
        )
    ),
    array( 'label' => 'Manage Proform', 'url' => array( 'admin' ) ),
);
?>

<h2>View Proform #<?php echo $model->id; ?></h2>

<?php $this->widget( 'bootstrap.widgets.TbDetailView', array(
        'data'       => $model,
        'attributes' => array(
            'id',
            'creationDate',
            'declaration_id',
            'created_by_user_id',
            'number',
        ),
    )
); ?>
