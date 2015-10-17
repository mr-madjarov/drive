<?php
$this->breadcrumbs = array(
    'Documents' => array( 'index' ),
    'Manage',
);

$this->menu = array(
    array( 'label' => 'List Document', 'url' => array( 'index' ) ),
    array( 'label' => 'Create Document', 'url' => array( 'create' ) ),
);

Yii::app()->clientScript->registerScript( 'search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('document-grid', {
data: $(this).serialize()
});
return false;
});
"
);
?>
<div class="well my-well clearfix">
<h1><?php echo t( 'Manage Documents' ) ?></h1>
</div>
<div class="well my-well clearfix">


<?php echo CHtml::link( t('Advanced Search'), '#', array( 'class' => 'search-button btn' ) ); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial( '_search', array(
            'model' => $model,
        )
    ); ?>
</div><!-- search-form -->

<?php $this->widget( 'bootstrap.widgets.TbGridView', array(
        'id'           => 'document-grid',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => array(
            'id',
            'category.type',
            'content',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ),
        ),
    )
); ?>
</div>