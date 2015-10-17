<?php
/**
 * Created by PhpStorm.
 * User: mrmad_000
 * Date: 9/19/14
 * Time: 8:32 PM
 *
 * This file  is for enumDropDown listing data
 *
 */
class ZHtml extends CHtml
{
    public static function enumDropDownList( $model, $attribute, $htmlOptions = array() )
    {
        return CHtml::activeDropDownList( $model, $attribute, self::enumItem( $model, $attribute ), $htmlOptions );
    }

    public static function enumItem( $model, $attribute )
    {
        $attr = $attribute;
        self::resolveName( $model, $attr );
        preg_match( '/\((.*)\)/', $model->tableSchema->columns[ $attr ]->dbType, $matches );
        foreach ( explode( "','", $matches[ 1 ] ) as $value ) {
            $value = str_replace( "'", null, $value );
            $values[ $value ] = Yii::t( 'enumItem', $value );
        }
        return $values;
    }
}
