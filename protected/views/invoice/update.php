<?php
$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Invoice','url'=>array('index')),
	array('label'=>'Create Invoice','url'=>array('create')),
	array('label'=>'View Invoice','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Invoice','url'=>array('admin')),
	);
	?>

	<h2>Update Invoice <?php echo $model->id; ?></h2>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>