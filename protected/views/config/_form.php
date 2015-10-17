<?php
/** @var ConfigController $this */
/** @var ConfigGroup $model */
/** @var TbActiveForm $form */
$form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
        'id'                   => 'coordinate-config-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array(
            'class' => 'well'
        )
    )
);
cs()->registerCss('form-style',<<<CSS
#config-table th{
    width: 20%;
}
#config-table td input {
    width: 98%;
}
CSS
);
$errors = array();
foreach( $model->fieldConfigs as $fieldConfig ) {
    if ( $fieldConfig->hasErrors( 'value' ) ) {
        $errors[ $fieldConfig->name ] = str_replace(
            $fieldConfig->getAttributeLabel( 'value' ), //search for
            t( $fieldConfig->label ), //replace with
            $fieldConfig->getError( 'value' ) //replace in
        );
    }
}
$model->addErrors( $errors );
echo $form->errorSummary( $model );
?>
    <table id="config-table" class="items table table-bordered table-condensed table-coordinates">
        <tbody>
            <?php
            $i = 0;
            foreach ( $model->fieldConfigs AS $fieldConfig ) {

                $class = ( $i++ % 2 == 0 ) ? 'even' : 'odd';
                //echo "<tr " . ' class = ' . $class . ">";
                echo CHtml::tag( 'tr', array( 'class' => $class, ) );
                echo CHtml::tag( 'th', array(), t( $fieldConfig->label ) );
                echo CHtml::tag( 'td', array(), $form->textField( $fieldConfig, '[' . $fieldConfig->id . ']value'));
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <div class="form-actions">
        <?php
        $this->widget( 'bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type'       => 'success',
                'label'      => t( DEFAULT_LANG_CATEGORY . 'Save' ),
            )
        );
        $this->widget( 'bootstrap.widgets.TbButton', array(
                'buttonType' => 'link',
                'url'        => array( '/adminPanel' ),
                'type'       => 'inverse',
                'label'      => t( DEFAULT_LANG_CATEGORY . 'Cancel' ),
            )
        );
        ?>
    </div>

<?php $this->endWidget(); ?>