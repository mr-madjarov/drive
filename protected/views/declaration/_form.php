<?php
/** @var DeclarationController $this */
/** @var TbActiveForm $form */
/** @var Declaration $model */
$form = $this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
    'id'                   => 'declaration-form',
    'enableAjaxValidation' => false,
    'type'                 => 'inline',
    'htmlOptions'          => array(
        'class' => 'well well-small'
    )
) );
cs()->registerCss( 'form-style', <<<CSS
#declaration-table th{
    width: 20%;
}
input[readonly] {
    cursor: pointer;
}
table.declaration-details input, select {
    width: 185px;
}
.add-row, .del-row {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.del-row {
    padding: 5px 9px;
    margin-left: 3px;
    font-weight: 900;
    font-size: 18px;
}
.help-block {
    display: none;
}
CSS
)
->registerScript( 'ui-js', <<<JS
$( '.declaration-details' ).on( 'change', '.price-code,.price-name', function(){
    var className = $( this ).hasClass( 'price-code' ) ? 'price-name' : 'price-code';
    $( this )
        .parents( 'tr' )
        .first()
        .find( 'select.' + className + ' option[value="' + $( this ).val() + '"]' )
        .prop( 'selected', true );
} ).on( 'click', 'a.del-row', function(){
    if( $( this ).parents( 'tbody:first' ).find( 'tr:not(.hidden)' ).length > 1 )
        $( this ).parents( 'tr:first' ).remove();
} ).on( 'keydown', '.total-weight', function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if (
        ($.inArray( e.keyCode, [188,190,110] ) !== -1 && $( this ).val().indexOf( '.' ) === -1 ) ||
        $.inArray( e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
         // Allow: home, end, left, right
        ( e.keyCode >= 35 && e.keyCode <= 39) ||
        // F1-F12
        ( e.keyCode >= 112 && e.keyCode <= 123 ) ){
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
} ).on( 'keypress', '.total-weight', function(evt){
    if(evt.which == 44){
        $(this).val($(this).val()+".");
        evt.preventDefault();
    }
} );
$( '.declaration-details a.add-row' ).on( 'click', function(){
    var randStamp = Math.round( (new Date()).getTime()/ 1000 ) + Math.floor( ( Math.random() * 1000 ) + 1 );
    var table = $( this ).parents( 'table:first' );
    var row = table.find( 'tr.hidden:first' ).clone();

    row.find( 'input,select,textarea' ).each( function( key, element ){
        element.name = element.name.replace( 'new_1', 'new_' + randStamp );
        $( element ).prop( 'disabled', false );
    } );

    table.find( 'tbody:first' ).prepend( row );
    row.removeClass( 'hidden' );
    row = table = null;
} );
JS
);
if( $model->hasErrors() ) {
    $errors = array();
    foreach( $model->getErrors() as $fieldErrors )
        $errors[] = implode( "\n", $fieldErrors );
    user()->setFlash( "error", implode( "\n", $errors ) );
}
?>
    <table id="declaration-table" class="items table table-bordered table-coordinates">
        <tbody>
            <tr class="even">
                <th><?php echo CHtml::activeLabelEx( $model, 'from_date' ); ?></th>
                <td>
                    <?php
                    echo $form->datePickerRow( $model, 'from_date', array(
                            'options'     => array(
                                'format'    => 'dd.mm.yyyy',
                                'autoclose' => true
                            ),
                            'htmlOptions' => array(
                                'readonly' => true,
                                'value' => empty( $model->from_date ) ? '' : date( 'd.m.Y', strtotime( $model->from_date ) )
                            ),
                        ), array(
                            'label' => array()
                        )
                    );
                    ?>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo CHtml::activeLabelEx( $model, 'to_date' ); ?> </th>
                <td><?php echo $form->datePickerRow( $model, 'to_date', array(
                            'options'     => array(
                                'format'    => 'dd.mm.yyyy',
                                'autoclose' => true
                            ),
                            'htmlOptions' => array(
                                'readonly' => true,
                                'value'    => empty( $model->to_date ) ? '' : date( 'd.m.Y', strtotime( $model->to_date ) )
                            ),
                        ), array(
                            'label' => array()
                        )
                    );
                    ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo CHtml::activeLabelEx( $model, 'type', array( 'label' => t( 'Is Null Declaration' ) ) ); ?> </th>
                <td><?php echo $form->checkBox( $model, 'type', array(
                            'value'        => Declaration::TYPE_NULL,
                            'uncheckValue' => Declaration::TYPE_NORMAL
                        ) );
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
        $this->renderPartial( '_declarationDetails', array(
            'models' => $model->declarationDetails,
            'form' => $form
        ) );
    ?>
    <div class="form-actions">
        <?php
        $this->widget( 'bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'       => 'success',
            'label'      => t( 'Save' ),
        ) );
        $this->widget( 'bootstrap.widgets.TbButton', array(
            'buttonType' => 'link',
            'type'       => 'inverse',
            'url'        => array( 'index' ),
            'label'      => t( 'Cancel' ),
        ) );
        ?>
    </div>
<?php $this->endWidget(); ?>
