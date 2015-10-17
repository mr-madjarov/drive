<?php
/** @var $this PriceListController */
/** @var $model  PriceList */
?>
<div class="well well-small">
    <h2><?php echo t( DEFAULT_LANG_CATEGORY . 'Update' ) . ' ' . $model->name; ?></h2>
</div>
<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>
