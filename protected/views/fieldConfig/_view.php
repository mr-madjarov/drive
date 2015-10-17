<div class="view">

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'id' ) ); ?>:</b>
    <?php echo CHtml::link( CHtml::encode( $data->id ), array( 'view', 'id' => $data->id ) ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'name' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->name ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'value' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->value ); ?>
    <br/>

    <b><?php echo CHtml::encode( $data->getAttributeLabel( 'config_group_id' ) ); ?>:</b>
    <?php echo CHtml::encode( $data->config_group_id ); ?>
    <br/>


</div>