<?php $form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl( $this->route ),
        'method' => 'get',
    )
); ?>

<?php echo $form->textFieldRow( $model, 'id', array( 'class' => 'span5', 'maxlength' => 10 ) ); ?>

<?php echo $form->textFieldRow( $model, 'creationDate', array( 'class' => 'span5' ) ); ?>

<?php echo $form->textFieldRow( $model, 'declaration_id', array( 'class' => 'span5', 'maxlength' => 10 ) ); ?>

<?php echo $form->textFieldRow( $model, 'created_by_user_id', array( 'class' => 'span5', 'maxlength' => 10 ) ); ?>

<?php echo $form->textFieldRow( $model, 'number', array( 'class' => 'span5', 'maxlength' => 10 ) ); ?>

<div class="form-actions">
    <?php $this->widget( 'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'       => 'primary',
            'label'      => 'Search',
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>
