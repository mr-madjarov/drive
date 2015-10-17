<?php
$this->breadcrumbs = array(
    'Field Configs' => array( 'index' ),
    $model->name,
);

$this->menu = array(
    array( 'label' => 'List FieldConfig', 'url' => array( 'index' ) ),
    array( 'label' => 'Create FieldConfig', 'url' => array( 'create' ) ),
    array( 'label' => 'Update FieldConfig', 'url' => array( 'update', 'id' => $model->id ) ),
    array( 'label'       => 'Delete FieldConfig',
           'url'         => '#',
           'linkOptions' => array( 'submit'  => array( 'delete', 'id' => $model->id ),
                                   'confirm' => 'Are you sure you want to delete this item?'
           )
    ),
    array( 'label' => 'Manage FieldConfig', 'url' => array( 'admin' ) ),
);
?>

<h2>View FieldConfig #<?php echo $model->id; ?></h2>

<?php $this->widget( 'bootstrap.widgets.TbDetailView', array(
        'data'       => $model,
        'attributes' => array(
            'id',
            'name',
            'value',
            'config_group_id',
        ),
    )
); ?>
