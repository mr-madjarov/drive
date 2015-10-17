<?php

class PNotify extends CWidget
{
    // Alert types.
    const TYPE_SUCCESS = 'success';
    const TYPE_INFO = 'info';
    const TYPE_NOTICE = 'notice';
    const TYPE_ERROR = 'error';

    // The notice's title.
    public $title = false;
    // The notice's text.
    public $text = false;
    // Type of the notice. "notice", "info", "success", or "error".
    public $type = self::TYPE_NOTICE;
    // Delay in milliseconds before the notice is removed.
    public $delay = 7000;
    // Display a pull down menu to redisplay previous notices, and place the notice in the history.
    public $history = false;
    // Those will be send to the script
    public $options = array();
    // Array of items which wil be displayed
    public $items = array();

    // Those options will be used in combination with items
    public $errorOptions = array(
        'type'    => self::TYPE_ERROR,
        'history' => true,
        'hide'    => false
    );
    // Those options will be used in combination with items
    public $noticeOptions = array(
        'type'    => self::TYPE_NOTICE,
        'delay'   => 6000,
        'history' => false,
        'hide'    => true
    );
    // Those options will be used in combination with items
    public $infoOptions = array(
        'type'    => self::TYPE_INFO,
        'delay'   => 5000,
        'history' => false,
        'hide'    => true
    );
    // Those options will be used in combination with items
    public $successOptions = array(
        'type'    => self::TYPE_SUCCESS,
        'delay'   => 4000,
        'history' => false,
        'hide'    => true
    );

    private $_execute;

    private $_assetsUrl;

    public function getAssetsUrl()
    {
        if ( $this->_assetsUrl === null )
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish( Yii::getPathOfAlias( 'PNotify.assets' ) );
        return $this->_assetsUrl;
    }

    public function init()
    {
        if ( Yii::getPathOfAlias( 'PNotify' ) === false ) {
            Yii::setPathOfAlias( 'PNotify', realpath( dirname( __FILE__ ) . '/..' ) );
        }
        if ( empty( $this->items ) ) {
            $defaults = array(
                'title'   => $this->title,
                'text'    => $this->text,
                'type'    => $this->type,
                'delay'   => $this->delay,
                'history' => $this->history,
            );
            $this->_execute = $this->getCommand( $defaults, $this->options );
        } else {
            $allowedTypes = array_flip( array(
                    self::TYPE_ERROR,
                    self::TYPE_INFO,
                    self::TYPE_SUCCESS,
                    self::TYPE_NOTICE
                )
            );
            $allowedItems = array_filter( array_intersect_key( $this->items, $allowedTypes ) );
            foreach ( $allowedItems AS $type => $items ) {
                $defaults = $this->{$type . 'Options'};
                $defaults[ 'title' ] = empty( $defaults[ 'title' ] ) ? t( ucfirst( $type ) ) : $defaults[ 'title' ];
                if ( is_string( $items ) ) {
                    // 'type' => 'text that will be shown'
                    if ( !empty( $items ) ) {
                        $items = array( 'text' => $items );
                        $this->_execute .= $this->getCommand( $defaults, $items );
                    }
                } elseif ( isset( $items[ 'text' ] ) ) {
                    // 'type' => array('text' => 'that will be shown', 'other options' => '')
                    $this->_execute .= $this->getCommand( $defaults, $items );
                } else {
                    foreach ( $items AS $item ) {
                        /*
                         * 'type' => array(
                         *       array('text' => 'that will be shown', 'other options' => ''),
                         *       array('text' => 'that will be shown', 'other options' => '')
                         *   )
                         */
                        $this->_execute .= $this->getCommand( $defaults, $item );
                    }
                }
            }
        }
    }

    private function getCommand( $defaults, $options )
    {
        $options = array_merge( $defaults, $options );
        return strtr( "\$.pnotify(:options);", array( ':options' => CJavaScript::encode( $options ) ) );
    }

    public function run()
    {
        if ( null !== $this->_execute ) {
            Yii::app()->getClientScript()->registerCoreScript( 'jquery' )
                ->registerScriptFile( $this->getAssetsUrl() . '/js/jquery.pnotify.min.js')
                ->registerCssFile( $this->getAssetsUrl() . '/css/jquery.pnotify.default.css' )
                ->registerScript( __CLASS__ . '#' . $this->getId(), $this->_execute );
        }
    }
}