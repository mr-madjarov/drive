<div class="reg-form-bg">
    <?php
    /** @var  $form TbActiveForm */
    $form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
            'id'                   => 'register-form',
            'enableAjaxValidation' => false,
        )
    ); ?>

    <p class="help-block"><?php echo t('Fields with') ?> <span class="required"> * </span><?php echo t( 'are required' ) ?>. </p> <br>

    <?php echo $form->errorSummary( $model ); ?>

    <?php echo $form->textFieldRow( $model, 'first_name',
        array( 'class' => 'span5', 'maxlength' => 250, 'placeholder' => "Вашето име" )
    ); ?>

    <?php echo $form->textFieldRow( $model, 'last_name', array(
            'class'       => 'span5',
            'maxlength'   => 250,
            'placeholder' => "Вашата фамилия"
        )
    ); ?>

    <?php echo $form->textFieldRow( $model, 'email', array(
            'class'       => 'span5',
            'maxlength'   => 150,
            'placeholder' => "example@mail.com"
        )
    ); ?>

    <?php echo $form->textFieldRow( $model, 'phone', array(
            'class'       => 'span5',
            'maxlength'   => 64,
            'placeholder' => "+359"
        )
    ); ?>

    <?php $data = Category::model()->findAll( array( 'order' => 'type' ) );
    $categoryTypes = CHtml::listData( $data, 'id', 'type' );
    echo t( 'Category' ) . '<span class="required" > *</span >' . '<br>' . $form->dropDownList( $model, 'category_id',
            $categoryTypes, array( 'prompt' => t( 'Please select a category...' ) )
        ); ?>

    <?php echo $form->textAreaRow( $model, 'address', array(
            'rows'        => 6,
            'cols'        => 20,
            'class'       => 'span5',
            'placeholder' => "Град/Село.......... Община.......... Област......."
        )
    ); ?>



    <div>
        <?php $this->widget( 'bootstrap.widgets.TbButton', array(
                'buttonType'  => 'submit',
                'type'        => 'info',
                'size'        => 'large',
                'htmlOptions' => array(
                    'class' => 'register-btn',
                ),
                'label'       => $model->isNewRecord ? t( 'Register' ) : t( 'Save' ),
            )
        ); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
