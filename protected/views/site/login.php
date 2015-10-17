<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - ' . t( 'Login' );
?>

<div class="well my-well">
<div class="form">
    <?php
    /** @var TbActiveForm $form */
    $form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
        'id'                     => 'login-form',
        'type' => 'horizontal',
        'enableClientValidation' => false,
        'htmlOptions' => array( 'class' => 'well' ),
    ));
    ?>
    <p class="note"><?php echo t( 'Please  login to proceed' ); ?></p>
    <?php
        echo $form->textFieldRow( $model, 'username' );
        echo $form->passwordFieldRow( $model, 'password' );
        //echo '<br />';
        $this->widget( 'bootstrap.widgets.TbButton', array( 'buttonType' => 'submit', 'label' => 'Login' ) );
        $this->endWidget();
    ?>
</div><!-- form -->
</div>