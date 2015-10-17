<?php
/** @var $this UserController */
/** @var $dataProvider  CActiveDataProvider */
?>
<div class="well my-well clearfix">
    <h2 style="float: left"><?php echo t( 'Users') ?></h2>
    <?php
    $this->widget( 'bootstrap.widgets.TbButton', array(
            'label'       => t( 'Create' ),
            'type'        => 'success',
            'buttonType'  => 'link',
            'url'         => array( 'user/create' ),
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
            'type' => 'bordered striped hover',
            'dataProvider' => $dataProvider,
            'columns' => array(
                'name',
                'username',
                'first_name',
                'last_name',
                'address',
                'categoryId.type',
                'active:boolean',
                array(
                    'name' => 'roles',
                    'type' => 'raw',
                    'value' => "implode( ',', array_map( 't', \$data->roles ) );"
                )

            ),
            'selectableRows' => true,
            'selectionChanged' => 'function(id){ location.href = "' . $this->createUrl( 'update'
                ) . '&id="+$.fn.yiiGridView.getSelection(id);}',
            /*'itemView'=>'_view',*/

        )
    ); ?>
</div>