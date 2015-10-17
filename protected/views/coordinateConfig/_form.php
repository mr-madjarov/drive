<?php
/** @var CoordinateConfigController $this */
/** @var CoordinateConfig[] $models */
/** @var TbActiveForm  $form */
$form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
        'id'                   => 'coordinate-config-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'well'
        )
    )
);
?>
<table class="items table table-bordered table-condensed table-coordinates" style="background-color: #fdfdfd ">
<thead>
    <tr>
        <th><?php echo t( DEFAULT_LANG_CATEGORY . 'Document' ); ?></th>
        <th><?php echo t( DEFAULT_LANG_CATEGORY . 'Visible' ); ?></th>
        <th><?php echo t( DEFAULT_LANG_CATEGORY . 'Lower left X' ); ?></th>
        <th><?php echo t( DEFAULT_LANG_CATEGORY . 'Lower left Y' ); ?></th>
        <th><?php echo t( DEFAULT_LANG_CATEGORY . 'Upper right X' ); ?></th>
        <th><?php echo t( DEFAULT_LANG_CATEGORY . 'Upper right Y' ); ?></th>
        <th><?php echo t( DEFAULT_LANG_CATEGORY . 'Reason' ); ?></th>
    </tr>
</thead>
    <tbody>
<?php
    $i = 0;
foreach( $models AS $model ) {
    $class = ($i++ % 2 == 0) ? 'even': 'odd';
    echo "<tr ". ' class = '.$class.">";
    echo CHtml::tag( 'td', array(), t( DEFAULT_LANG_CATEGORY . ucfirst( $model->document_type ) ) );
    echo CHtml::tag( 'td', array( 'style' => 'text-align: center;' ), $form->checkBox( $model, '[' . $model->id . ']visible' ) );
    echo CHtml::tag( 'td', array(), $form->textField( $model, '[' . $model->id . ']lower_left_x', array( 'class' => 'coordinate-input' ) ) );
    echo CHtml::tag( 'td', array(), $form->textField( $model, '[' . $model->id . ']lower_left_y', array( 'class' => 'coordinate-input' ) ) );
    echo CHtml::tag( 'td', array(), $form->textField( $model, '[' . $model->id . ']upper_right_x', array( 'class' => 'coordinate-input' ) ) );
    echo CHtml::tag( 'td', array(), $form->textField( $model, '[' . $model->id . ']upper_right_y', array( 'class' => 'coordinate-input' ) ) );
    echo CHtml::tag( 'td', array( 'style' => 'width: 100%' ), $form->textField( $model, '[' . $model->id . ']reason', array( 'style' => 'width: 98%', 'maxlength' => 150 ) )  );
    echo '</tr>';
}
?>
    </tbody>
</table>
<div class="form-actions">
    <?php
    $this->widget( 'bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type'       => 'success',
        'label'      => t( DEFAULT_LANG_CATEGORY .  'Save' ),
    ) );
    $this->widget( 'bootstrap.widgets.TbButton', array(
        'buttonType' => 'link',
        'url'        => array( '/adminPanel' ),
        'type'       => 'inverse',
        'label'      => t( DEFAULT_LANG_CATEGORY . 'Cancel' ),
    ) );
    ?>
</div>

<?php $this->endWidget(); ?>
