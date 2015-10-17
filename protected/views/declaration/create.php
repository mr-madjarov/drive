<?php
/** @var DeclarationController $this */
/** @var Declaration $model */
?>
    <div class="well well-small">
        <h2><?php echo t( DEFAULT_LANG_CATEGORY . 'Create Declaration' ); ?></h2>
    </div>
<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>
