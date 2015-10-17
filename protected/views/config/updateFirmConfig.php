<?php
/** @var ConfigController $this */
/** @var ConfigGroup $model */
?>
    <div class="well well-small">
        <h2><?php echo t( DEFAULT_LANG_CATEGORY . 'Update firm data' ); ?></h2>
    </div>
<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>