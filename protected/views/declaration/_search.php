<?php $form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl( $this->route ),
        'method' => 'get',
    )
); ?>

<?php echo $form->textFieldRow( $model, 'id', array( 'class' => 'span5', 'maxlength' => 10 ) ); ?>

<?php echo $form->textFieldRow( $model, 'number', array( 'class' => 'span5', 'maxlength' => 10 ) ); ?>

<?php echo $form->textFieldRow( $model, 'from_date', array( 'class' => 'span5' ) ); ?>

<?php echo $form->textFieldRow( $model, 'to_date', array( 'class' => 'span5' ) ); ?>

<?php echo $form->textFieldRow( $model, 'created_date', array( 'class' => 'span5' ) ); ?>

<?php echo $form->textFieldRow( $model, 'created_by_user_id', array( 'class' => 'span5', 'maxlength' => 10 ) ); ?>

<?php echo $form->textFieldRow( $model, 'type', array( 'class' => 'span5', 'maxlength' => 6 ) ); ?>

<?php echo $form->textFieldRow( $model, 'signed', array( 'class' => 'span5' ) ); ?>

<div class="form-actions">
    <?php $this->widget( 'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'       => 'primary',
            'label'      => 'Search',
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>
