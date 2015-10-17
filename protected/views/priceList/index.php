<?php
/** @var $this PriceListController */
/** @var $dataProvider  CActiveDataProvider */
?>
<div class="well-small well clearfix">
    <h2 style="float: left">Price Lists</h2>
    <?php
    $this->widget( 'bootstrap.widgets.TbButton', array(
            'label' => t('Create'),
            'type' => 'success',
            'buttonType' => 'link',
            'url' => array( 'priceList/create' ),
            'htmlOptions' => array(
                'style' => 'float: right; margin: 15px',
            )

        )
    );
    ?>
</div>

<div class="well well-small">
    <?php $this->widget( 'bootstrap.widgets.TbGridView', array(
            'type'         => 'bordered striped hover',
            'dataProvider' => $dataProvider,
            'columns'      => array(
                'code',
                'name',
                'price'
            ),
            'selectableRows' => true,
            'selectionChanged' => 'function(id){ location.href = "' . $this->createUrl( 'update' ) . '&id="+$.fn.yiiGridView.getSelection(id);}',

        )
    ); ?>
</div>


