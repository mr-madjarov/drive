<div class="well my-well">
    <?php
    $this->menu = array(
        array( 'label' => 'List Document', 'url' => array( 'index' ) ),
        array( 'label' => 'Manage Document', 'url' => array( 'admin' ) ),
    );
    ?>

    <h1>Create Document</h1>

    <?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>
</div>