<?php
/** @var TbActiveForm $form */
/** @var User $model */


$form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
        'id'                   => 'user-form',
        'enableAjaxValidation' => false,
        'type'                 => 'horizontal',
        'htmlOptions'          => array(
            'class' => 'well'
        )
    )
); ?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php
echo $form->errorSummary( $model );
echo $form->textFieldRow( $model, 'name', array( 'maxlength' => 120 ) );
echo $form->textFieldRow( $model, 'username', array( 'maxlength' => 120 ) );
echo $form->passFieldRow( $model, 'password', array(), array( 'maxlength' => 100 ) );

echo $form->passFieldRow( $model, 'password_repeat', array(
        'options' => array(
            'showGenerate' => false
        )
    ), array( 'maxlength' => 100 )
);

echo $form->textFieldRow( $model, 'phone', array( 'class' => 'span5', 'maxlength' => 64 ) );
echo $form->textFieldRow( $model, 'first_name', array( 'class' => 'span5', 'maxlength' => 64 ) );
echo $form->textFieldRow( $model, 'last_name', array( 'class' => 'span5', 'maxlength' => 64 ) );
echo $form->textAreaRow( $model, 'address', array( 'rows' => 6, 'cols' => 50, 'class' => 'span8' ) );
//echo $form->textFieldRow( $model, 'category_id', array( 'class' => 'span5', 'maxlength' => 10 ) );
echo $form->toggleButtonRow( $model, 'active', array(
        'enabledLabel'  => t( 'Yes' ),
        'disabledLabel' => t( 'No' ),
        'disabledStyle' => 'danger',
        'enabledStyle'  => 'success'
    )
);
$roles = array(
    'systemAdministrator' => t( 'Administrator' ),
    'manager'             => t( 'Manager' ),
    'operator'            => t( 'Operator' ),
);

echo $form->checkBoxListRow( $model, 'roles', $roles, array(), array( 'separator' => '' ) );

$data = Category::model()->findAll( array( 'order' => 'type' ) );
$categoryTypes = CHtml::listData( $data, 'id', 'type' );

?>
<div class="control-group">
    <label class="control-label required" for="User_category_id">
       <?php echo  "Category  "   ?>
       <span class="required">*</span>
    </label>
    <?php echo str_repeat( '&nbsp;', 5 ). $form->dropDownList( $model, 'category_id', $categoryTypes, array('prompt'=> 'Please select a category...') );?>

</div>






<div class="form-actions">
    <?php
    $this->widget( 'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'       => 'success',
            'label'      => t( 'Save' ),
        )
    );
    $this->widget( 'bootstrap.widgets.TbButton', array(
            'buttonType' => 'link',
            'type'       => 'inverse',
            'url'        => array( 'index' ),
            'label'      => t( 'Cancel' ),
        )
    );
    ?>
</div>

<?php $this->endWidget(); ?>

