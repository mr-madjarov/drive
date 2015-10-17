<?php
/** @var DeclarationController $this */
/** @var DeclarationDetail[] $models */
/** @var TbActiveForm $form */
?>
<table class="items table table-bordered table-condensed table-coordinates declaration-details">
    <thead>
        <tr>
            <th><?php echo DeclarationDetail::model()->getAttributeLabel( 'invoice_num_and_date' ); ?></th>
            <th><?php echo DeclarationDetail::model()->getAttributeLabel( 'customs_tariff_number' ); ?></th>
            <th><?php echo DeclarationDetail::model()->getAttributeLabel( 'prod_prom_code' ); ?></th>
            <th><?php echo DeclarationDetail::model()->getAttributeLabel( 'price_list_code' ); ?></th>
            <th><?php echo DeclarationDetail::model()->getAttributeLabel( 'price_list_name' ); ?></th>
            <th><?php echo DeclarationDetail::model()->getAttributeLabel( 'total_weight' ); ?></th>
            <th style="width: 34px"><?php
                $this->widget( 'bootstrap.widgets.TbButton', array(
                        'buttonType' => 'link',
                        'type'       => 'success',
                        'label'      => '+',
                        'htmlOptions' => array(
                            'class' => 'add-row'
                        )
                    )
                );
                ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $prises = PriceList::model()->findAll( array( 'order' => 'code' ) );
        $priseListCodes = CHtml::listData( $prises, 'id', 'code' );
        $prises = PriceList::model()->findAll( array( 'order' => 'name' ) );
        $priceListNames = CHtml::listData( $prises, 'id', 'name' );
        $deleteRow = $this->widget( 'bootstrap.widgets.TbButton', array(
                'buttonType'  => 'link',
                'type'        => 'danger',
                'label'       => '&times',
                'encodeLabel' => false,
                'htmlOptions' => array(
                    'class' => 'del-row',
                )
            ), true
        );
        ?>
        <tr class="hidden">
            <td><input type="text" name="DeclarationDetail[new_1][invoice_num_and_date]" value="" disabled="disabled" /></td>
            <td><input type="text" name="DeclarationDetail[new_1][customs_tariff_number]" value="" disabled="disabled" /></td>
            <td><input type="text" name="DeclarationDetail[new_1][prod_prom_code]" value="" disabled="disabled" /></td>
            <td><?php
                echo CHtml::dropDownList( 'DeclarationDetail[new_1][price_list_id]', '', $priseListCodes, array(
                    'prompt' => t( 'Please select...' ),
                    'class'  => 'price-code',
                    'disabled' => true
                ) );
                ?></td>
            <td><?php
                echo CHtml::dropDownList( 'DeclarationDetail[new_1][price_list_id]', '', $priceListNames, array(
                    'prompt' => t( 'Please select...' ),
                    'class'  => 'price-name',
                    'disabled' => true
                ) );
                ?>
            </td>
            <td><input type="text" name="DeclarationDetail[new_1][total_weight]" value="" disabled="disabled" class="total-weight" /></td>
            <td><?php echo $deleteRow; ?></td>
        </tr>
        <?php
        foreach ( $models AS $model ) {
            echo CHtml::tag( 'td', array(), $form->textField( $model, '[' . $model->id . ']invoice_num_and_date' ) );
            echo CHtml::tag( 'td', array(), $form->textField( $model, '[' . $model->id . ']customs_tariff_number' ) );
            echo CHtml::tag( 'td', array(), $form->textField( $model, '[' . $model->id . ']prod_prom_code' ) );
            echo CHtml::tag( 'td', array(),
                $form->dropDownList( $model, '[' . $model->id . ']price_list_id', $priseListCodes, array(
                        'prompt' => t( 'Please select...' ),
                        'class' => 'price-code'
                    ) )
            );
            echo CHtml::tag( 'td', array(),
                $form->dropDownList( $model, '[' . $model->id . ']price_list_id', $priceListNames, array(
                    'prompt' => t( 'Please select...' ),
                    'class'  => 'price-name'
                ) )
            );
            echo CHtml::tag( 'td', array(), $form->textField( $model, '[' . $model->id . ']total_weight' , array( 'class' => 'total-weight' ) ) );
            echo CHtml::tag( 'td', array(), $deleteRow );
            echo '</tr>';
        }
        ?>
    </tbody>
</table>