<?php $form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
        'id'                   => 'document-form',
        'enableAjaxValidation' => false,
    )
); ?>
<div class="well">
    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary( $model ); ?>

    <?php

    $data = Category::model()->findAll( array( 'order' => 'type' ) );
    $categoryTypes = CHtml::listData( $data, 'id', 'type' );
    echo $form->dropDownList( $model, 'category_id', $categoryTypes, array( 'prompt' => 'Please select a category...' )
    ); ?>

    <?php //echo $form->textFieldRow( $model, 'category_id', array( 'class' => 'span5', 'maxlength' => 10 ) ); ?>

    <?php //echo $form->textAreaRow( $model, 'content', array( 'rows' => 6, 'cols' => 50, 'class' => 'span8' ) );

    $this->widget( 'bootstrap.widgets.TbCKEditor', array(
            //'name' => 'Document[content]',
            'model'     => $model,
            'attribute' => 'content',
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
</div>
<?php $this->endWidget(); ?>
