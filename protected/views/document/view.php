
<?php
/** @var  $model Document */

/*$this->menu = array(
    array( 'label' => 'List Document', 'url' => array( 'index' ) ),
    array( 'label' => 'Create Document', 'url' => array( 'create' ) ),
    array( 'label' => 'Update Document', 'url' => array( 'update', 'id' => $model->id ) ),
    array( 'label'       => 'Delete Document',
           'url'         => '#',
           'linkOptions' => array( 'submit'  => array( 'delete', 'id' => $model->id ),
                                   'confirm' => 'Are you sure you want to delete this item?'
           )
    ),
    array( 'label' => 'Manage Document', 'url' => array( 'admin' ) ),
);*/
?>
<div class="document-all" >
    <div class="doc-text">
    <?php   echo $model->content; ?>
    </div>
</div>

