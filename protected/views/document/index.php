<div class="well my-well clearfix">
<?php
$this->menu = array(
    array( 'label' => 'Create Document', 'url' => array( 'create' ) ),
    array( 'label' => 'Manage Document', 'url' => array( 'admin' ) ),
);
?>

<h1>Documents</h1>

<?php $this->widget( 'bootstrap.widgets.TbGridView', array(
        'dataProvider' => $dataProvider,
        //'itemView'     => '_view',
        'columns' => array(
            'category.type',
            'content',)
    )
); ?>
</div>
