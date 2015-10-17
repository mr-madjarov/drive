<?php
$this->breadcrumbs = array(
    'Declarations' => array( 'index' ),
    $model->id,
);

$this->menu = array(
    array( 'label' => 'List Declaration', 'url' => array( 'index' ) ),
    array( 'label' => 'Create Declaration', 'url' => array( 'create' ) ),
    array( 'label' => 'Update Declaration', 'url' => array( 'update', 'id' => $model->id ) ),
    array(
        'label'       => 'Delete Declaration',
        'url'         => '#',
        'linkOptions' => array(
            'submit'  => array( 'delete', 'id' => $model->id ),
            'confirm' => 'Are you sure you want to delete this item?'
        )
    ),
    array( 'label' => 'Manage Declaration', 'url' => array( 'admin' ) ),
    array( 'label' => 'List Declaration', 'url' => array( 'table' ) ),
);
?>

<h2>View Declaration #<?php echo $model->id; ?></h2>

<?php $this->widget( 'bootstrap.widgets.TbDetailView', array(
        'data'       => $model,
        'attributes' => array(
            'id',
            'number',
            'from_date',
            'to_date',
            'created_date',
            'created_by_user_id',
            'type',
            'signed',
        ),
    )
); ?>
