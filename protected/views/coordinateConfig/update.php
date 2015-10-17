<?php
/** @var CoordinateConfigController $this */
/** @var CoordinateConfig[] $models */
?>
   <div class="well">
    <h2><?php echo t( DEFAULT_LANG_CATEGORY . 'Update Coordinates' ); ?></h2>
   </div>
<?php echo $this->renderPartial( '_form', array( 'models' => $models ) ); ?>