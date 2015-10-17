<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app(
    )->request->baseUrl; ?>/css/screen.css" media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app(
    )->request->baseUrl; ?>/css/print.css" media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>

    <title><?php echo CHtml::encode( $this->pageTitle ); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/app.css"/>
</head>
<body>
<div class="container" id="content">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="/"><?php echo CHtml::encode( Yii::app()->name ); ?></a>
                <?php
                cs()->registerCss( 'contentWidth', <<<CSS
                    #content {
                        width: 380px;
                    }
                    .form-horizontal .control-label {
                        width: 80px;
                    }
                    .form-horizontal .controls {
                        margin-left: 100px;
                    }
                    .form-horizontal .control-group {
                    margin-bottom: 5px;
                    }
CSS
                );

                if ( user()->hasFlash( 'success' ) || user()->hasFlash( 'info' ) || user()->hasFlash( 'error' ) || user(
                    )->hasFlash( 'notice' )
                ) {
                    $this->widget( 'PNotify', array(
                            'items' => array(
                                'info'    => user()->getFlash( 'info' ),
                                'success' => user()->getFlash( 'success' ),
                                'error'   => user()->getFlash( 'error' ),
                                'notice'  => user()->getFlash( 'notice' ),
                            )
                        )
                    );
                }
                $this->widget( 'zii.widgets.CMenu', array(
                        'items'       => array(
                            array( 'label' => 'Home', 'url' => array( '/site/index' ) ),
                            array(
                                'label'   => 'Login',
                                'url'     => array( '/site/login' ),
                                'visible' => Yii::app()->user->isGuest
                            ),
                            array(
                                'label'   => 'Logout',
                                'url'     => array( '/site/logout' ),
                                'visible' => !Yii::app()->user->isGuest
                            )
                        ),
                        'htmlOptions' => array( 'class' => 'nav' )
                    )
                ); ?>
            </div>
        </div>
    </div>
    <?php echo $content; ?>
    <div class="clear"></div>

    <!-- footer -->
</div>
<div class="footer">
    <div class="wrapper">
        <ul class="extrafoot">
            <li style="float: right">
               <a> Copyright &copy; Madjarov - 2014 </a>
            </li>
        </ul>
    </div>
</div>
<!-- page -->
</body>
</html>
