<?php
/**
 * @var $model Category
 */
?>
<div <?php
if ( $model->type == 'B' ) {
    echo 'class="category-b"';
} elseif ( $model->type == 'A' ) {
    echo 'class="category-a"';
} elseif ( $model->type == 'C+E' ) {
    echo 'class="category-c-e"';
} elseif ( $model->type == 'A1' ) {
    echo 'class="category-a1"';
} elseif ( $model->type == 'A2' ) {
    echo 'class="category-a2"';
} elseif ( $model->type == 'AM' ) {
    echo 'class="category-am"';
} elseif ( $model->type == 'C' ) {
    echo 'class="category-c"';
}
?>>
    <div class="inner-cat">
        <h2><?php echo t( 'Category' ) . ' ' . $model->type; ?></h2>
        <?php
        echo $model->description;
        $document = Document::model()->findAll( array( 'order' => 'category_id' ) );
        $docID = CHtml::listData( $document, 'id', 'category_id' );
        foreach ( $docID as $id => $value ) {
            if ( $value == $model->id ) {
                $text = t( 'Documents you need' );
                echo CHtml::link( $text, array( 'document/view', 'id' => $id ), array( 'class' => 'doc-btn' )
                );
            }
        }
        ?>
    </div>
</div>
<div class="inner-cat2">
    <ul>
        <li><?php echo t( 'Theory time is' ) . "&nbsp" . $model->theory_time . "&nbsp" . t( 'hours' ) ?> </li>
        <li><?php echo t( 'Practise time is' ) . "&nbsp" . $model->practise_time . "&nbsp" . t( 'hours' ) ?></li>
        <li><?php echo t( 'Price of course is' ) . "&nbsp" . $model->price . "&nbsp" . t( 'BGN' ) ?>      </li>
    </ul>
    <?php $text = t( 'Take course' );
    echo CHtml::link( $text, array( 'register/create' ), array( 'class' => 'reg-btn' ) ); ?>
</div>