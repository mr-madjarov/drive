<?php
/** @var $this DeclarationController */
/** @var $dataProvider  CActiveDataProvider */
?>
<div class="well-small well clearfix">
    <h2 style="float: left">Declarations</h2>

    <?php $this->widget( 'bootstrap.widgets.TbButtonGroup', array(
            'type'        => 'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'buttons'     => array(
                array(
                    'label' => t( 'Declaration' ),
                    'items' => array(
                        array( 'label' => t( 'New Declaration' ), 'icon' => 'plus', 'url' => array( 'create' ) ),
                        array( 'label' => t( 'New line' ), 'icon' => 'search', 'url' => '#' ),
                        array( 'label' => t( 'Create temporary' ), 'icon' => 'search', 'url' => '#' ),
                        array( 'label' => t( 'Import' ), 'icon' => 'file', 'url' => '#' ),
                    ),
                ),

            ),
            'htmlOptions' => array( 'class' => 'pull-right', 'style' => 'margin: 15px;' )
        )

    );

    ?>
</div>
<?php
$this->widget( 'bootstrap.widgets.TbGridView', array(
        'type'             => 'bordered striped hover',
        'dataProvider'     => $dataProvider,
        'columns'          => array(
            'number',
            array(
                'name' => 'from_date',
                'type' => 'raw',
                'value' => "date( 'd.m.Y', strtotime( \$data->from_date ) )"
            ),
            array(
                'name'  => 'to_date',
                'type'  => 'raw',
                'value' => "date( 'd.m.Y', strtotime( \$data->to_date ) )"
            ),
            'created_date',
        ),
        'htmlOptions'      => array(
            'class' => 'well well-small'
        ),
        'selectableRows'   => true,
        'selectionChanged' => 'function(id){ location.href = "' . $this->createUrl( 'update'
            ) . '&id="+$.fn.yiiGridView.getSelection(id);}',
        /*'itemView'=>'_view',*/

    )
); ?>
