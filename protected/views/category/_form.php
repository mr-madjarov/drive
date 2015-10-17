<?php $form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
        'id'                   => 'category-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'well')


    )
); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary( $model ); ?>

<?php //echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>3)); ?>

<?php echo ZHtml::enumDropDownList( $model, 'type', array( 'class' => 'span5' ) ); ?>

<?php echo $form->textFieldRow( $model, 'price', array( 'class' => 'span5' ) ); ?>

<?php echo $form->textFieldRow( $model, 'practise_time', array( 'class' => 'span5' ) ); ?>

<?php echo $form->textFieldRow( $model, 'theory_time', array( 'class' => 'span5' ) ); ?>

<?php $this->widget( 'bootstrap.widgets.TbCKEditor', array(
        'model'     => $model,
        'attribute' => 'description',
    )
);
?>

<div class="form-actions">
    <?php $this->widget( 'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'       => 'primary',
            'label'      => $model->isNewRecord ? 'Create' : 'Save',
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>
