<?php
$this->breadcrumbs=array(
	'Invoices',
);

$this->menu=array(
array('label'=>'Create Invoice','url'=>array('create')),
array('label'=>'Manage Invoice','url'=>array('admin')),
);
?>

<h2>Invoices</h2>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
