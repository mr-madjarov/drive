<?php
$this->breadcrumbs = array(
    'Invoices' => array( 'index' ),
    'Manage',
);

$this->menu = array(
    array( 'label' => 'List Invoice', 'url' => array( 'index' ) ),
    array( 'label' => 'Create Invoice', 'url' => array( 'create' ) ),
);

Yii::app()->clientScript->registerScript( 'search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('invoice-grid', {
data: $(this).serialize()
});
return false;
});
"
);
?>

<h2>Manage Invoices</h2>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link( 'Advanced Search', '#', array( 'class' => 'search-button btn' ) ); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial( '_search', array(
            'model' => $model,
        )
    ); ?>
</div><!-- search-form -->

<?php $this->widget( 'bootstrap.widgets.TbGridView', array(
        'id'           => 'invoice-grid',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => array(
            'id',
            'created_date',
            'declaration_id',
            'status',
            'created_by_user_id',
            'number',
            /*
            'payment_type',
            */
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ),
        ),
    )
); ?>
