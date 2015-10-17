<div class="view">

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'id' ) ); ?>:</b>
    <?php echo CHtml::link( CHtml::encode( $data->id ), array( 'view', 'id' => $data->id ) ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'creationDate' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->creationDate ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'declaration_id' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->declaration_id ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'created_by_user_id' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->created_by_user_id ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'number' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->number ); ?>
    <br/>


</div>