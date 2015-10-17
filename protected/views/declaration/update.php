<?php
/** @var $this DeclarationController */
/** @var $model Declaration */
?>
<div class="well well-small">
    <h2><?php echo t( DEFAULT_LANG_CATEGORY . 'Update declaration' ) . ': ' . $model->number; ?></h2>
</div>
<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>