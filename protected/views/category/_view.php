<div class="cat-btn">

    <?php
    $text = t( 'Category' ) . " " . CHtml::encode( $data->type );
    echo CHtml::link( $text, array( 'view', 'id' => $data->id ), array( 'class' => 'button-view' ) );
    ?>

</div>