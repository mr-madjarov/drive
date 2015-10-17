<?php
/** @var TbActiveForm $form */
/** @var PriceList $model */


$form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
        'id'                   => 'price-list-form',
        'enableAjaxValidation' => false,
        'type' => 'horizontal',
        'htmlOptions'          => array(
            'class' => 'well'
        )
    )
); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php
echo $form->errorSummary( $model );
echo $form->textFieldRow( $model, 'code', array( 'class' => 'span5', 'maxlength' => 10 ) );
echo $form->textFieldRow( $model, 'name', array( 'class' => 'span5', 'maxlength' => 120 ) );
echo $form->textFieldRow( $model, 'price', array( 'class' => 'span5', 'maxlength' => 11 ) );
?>

<div class="form-actions">
    <?php
    $this->widget( 'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'       => 'success',
            'label'      =>  t('Save'),
        )
    );
    $this->widget( 'bootstrap.widgets.TbButton', array(
            'buttonType' => 'link',
            'type'       => 'inverse',
            'url' => array('index'),
            'label'      => t( 'Cancel' ),
        )
    );
    ?>
</div>

<?php $this->endWidget(); ?>
