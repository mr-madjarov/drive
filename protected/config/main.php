<?php

// Setup local configuration file
$localConfigFile = __DIR__ . DIRECTORY_SEPARATOR . 'main-local.php';
$localConfig = file_exists( $localConfigFile ) ? require( $localConfigFile ) : array();

// Define default language category
define( 'DEFAULT_LANG_CATEGORY', 'app|' );

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray( array(
        'basePath'       => dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..',
        'name'           => t('Education Center'),
        'sourceLanguage' => 'en_US',
        'language'       => 'bg_BG',
        // preloading 'log' component
        'preload'        => array(
            'log', 'bootstrap'
        ),
        // autoloading model and component classes
        'import'         => array(
            'application.models.*',
            'application.components.*',
            'application.controllers.*',
            'application.extensions.*',
            'application.extensions.PNotify.widgets.*',
            'application.vendor.phpass.PasswordHash',
        ),
        'modules'        => array(
        ),
        // application components
        'components'     => array(
            'bootstrap' => array(
                'class'         => 'ext.yiibooster.components.Bootstrap',
                'responsiveCss' => true,
            ),
            'coreMessages' => array(
                'basePath' => null,
            ),
            'user'         => array(
                // enable cookie-based authentication
                'allowAutoLogin' => true,
            ),
            // uncomment the following to enable URLs in path-format
            /*
            'urlManager'=>array(
                'urlFormat'=>'path',
                'rules'=>array(
                    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                ),
            ),
            */
            'db'           => array(
                'connectionString' => 'mysql:host=localhost;dbname=drive_db;unix_socket=/tmp/mysql.sock',
                'emulatePrepare'   => true,
                'username'         => 'root',
                'password'         => '',
                'charset'          => 'utf8',
                'tablePrefix'      => 'tbl_',
            ),
            // uncomment the following to use a MySQL database
            /*
            'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=testdrive',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ),
            */
            'errorHandler' => array(
                // use 'site/error' action to display errors
                'errorAction' => 'site/error',
            ),
            'log'          => array(
                'class'  => 'CLogRouter',
                'routes' => array(
                    array(
                        'class'  => 'CFileLogRoute',
                        'levels' => 'error, warning',
                    ),
                    // uncomment the following to show log messages on web pages
                    /*
                    array(
                        'class'=>'CWebLogRoute',
                    ),
                    */
                ),
            ),
            'authManager'  => array(
                'class'           => 'DbAuthManager',
                'connectionID'    => 'db',
                'itemTable'       => '{{auth_item}}',
                'assignmentTable' => '{{auth_assignment}}',
                'itemChildTable'  => '{{auth_item_child}}',
            ),
        ),
        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params'         => array(
            // this is used in contact page
            'adminEmail' => 'yusm@abv.bg',
            'phpass' => array(
                'iteration_count_log2' => 8,
                'portable_hashes'      => false,
            ),
        ),
    ), $localConfig
);