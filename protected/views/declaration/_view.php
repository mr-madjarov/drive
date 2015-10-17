<div class="view">

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'id' ) ); ?>:</b>
    <?php echo CHtml::link( CHtml::encode( $data->id ), array( 'view', 'id' => $data->id ) ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'number' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->number ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'from_date' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->from_date ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'to_date' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->to_date ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'created_date' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->created_date ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'created_by_user_id' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->created_by_user_id ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'type' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->type ); ?>
    <br/>

    <?php
    /*
	<b>
    <?php
        echo CHtml::encode($data->getAttributeLabel('signed'));
    ?>:
    </b>
	<?php
        echo CHtml::encode($data->signed);
    ?>
	<br />

	*/
    ?>

</div>