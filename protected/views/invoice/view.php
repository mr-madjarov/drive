<?php
$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Invoice','url'=>array('index')),
array('label'=>'Create Invoice','url'=>array('create')),
array('label'=>'Update Invoice','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Invoice','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Invoice','url'=>array('admin')),
);
?>

<h2>View Invoice #<?php echo $model->id; ?></h2>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'created_date',
		'declaration_id',
		'status',
		'created_by_user_id',
		'number',
		'payment_type',
),
)); ?>
