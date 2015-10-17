<?php
/** @var $dataProvider  CActiveDataProvider */
?>
<div class="well my-well clearfix">
    <h2 style="float: left"><?php echo t( 'Registered Students' ) ?> </h2>
    <?php
    $this->widget( 'bootstrap.widgets.TbButton', array(
            'label'       => t( 'Create' ),
            'type'        => 'success',
            'buttonType'  => 'link',
            'url'         => array( 'register/create' ),
            'htmlOptions' => array(
                'style' => 'float: right; margin: 15px',
            )
        )
    );
    ?>
</div>
<div class="well my-well">
    <?php
    $this->widget( 'bootstrap.widgets.TbGridView', array(
            'type'         => 'bordered striped hover',
            'dataProvider' => $dataProvider,
            'columns'      => array(
                'first_name',
                'last_name',
                'email',
                'phone',
                'address',
                'category.type',
            ),
            'selectableRows' => true,
            'selectionChanged' => 'function(id){ location.href = "' . $this->createUrl( 'update'
                ) . '&id="+$.fn.yiiGridView.getSelection(id);}',
            /*'itemView'=>'_view',*/
            //'itemView'=>'_view',
        )
    ); ?>
</div>