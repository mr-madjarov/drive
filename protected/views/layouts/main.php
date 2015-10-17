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

    <title><?php $title = CHtml::encode( $this->pageTitle );
        echo t( $title ); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/app.css"/>
    
</head>

<body>

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function( d, s, id ) {
        var js, fjs = d.getElementsByTagName( s )[0];
        if ( d.getElementById( id ) ) return;
        js = d.createElement( s );
        js.id = id;
        js.src = "//connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v2.4";
        fjs.parentNode.insertBefore( js, fjs );
    }( document, 'script', 'facebook-jssdk' ));</script>
<!-- End  Facebook SDK for JavaScript -->

<div class="container" id="content">
    <div class="navbar">
        <div class="bottom-header">
            <img src="images/logo-left.jpg"/>
            <img onmouseout=" this.src='images/logo-right.jpg'"
                 onmouseover=" this.src='images/logo-right2.jpg'"
                 src="images/logo-right.jpg"
                 onclick="location.href='index.php?r=site/index'"
                 style="cursor:pointer;"
                 alt="ToyotaHover"/>
        </div>
        <div class="navbar-inner">
            <div class="container">
                <!-- <a class="brand" href="/"><?php // echo CHtml::encode( Yii::app()->name ); ?></a> -->
                <?php
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
                            array( 'label' => t( 'Home' ), 'url' => array( '/site/index' ) ),
                            array( 'label' => t( 'Categories' ), 'url' => array( 'category/index' ) ),
                            array( 'label' => t( 'Gallery' ), 'url' => array( '/gallery/index' ) ),
                            array( 'label' => t( 'Contacts' ), 'url' => array( '/contacts/index' ) ),
                            array( 'label' => t( 'Leaflets' ), 'url' => array( '/listovki/index' ) ),
                            array(
                                'label'   => t( 'Administration' ),
                                'url'     => array( 'adminPanel/index' ),
                                'visible' => allow( 'aAdminPanelIndex' )
                            ),
                            /* array(
                                 'label'   => t( 'Login' ),
                                 'url'     => array( '/site/login' ),
                                 'visible' => Yii::app()->user->isGuest
                             ),*/
                            array(
                                'label'   => t( 'Logout' ),
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
            <li>
                <a> <?php
                    if ( !user()->isGuest ) {
                        echo t( 'User' ) . ": " . Yii::app()->user->name;
                    } else {
                        echo t( 'Education Center "Rushan Zeinev"' );
                        echo "  &copy; " . date( "Y" );
                        echo '<a href=/>начало</a>';
                        echo '<a href="http://zeinev.com/index.php?r=register/create">запиши се</a>';
                        echo '<a href="http://zeinev.com/index.php?r=contacts/index">контакти</a>';
                        echo '<a href="mailto:mr.madjarov@gmail.com?Subject=zeinev.com" target="_top">разработен от: Маджаров</a>';
                    }
                    ?>
                </a>
            </li>
            <li>
                <span>
                        <?php
                        if ( !user()->isGuest ) {
                            $access = RbacHelper::getRoleDescriptions( user()->id );
                            echo t( 'Access' ) . ": " . implode( $access, "," );
                        }
                        ?>
                </span>
            </li>
        </ul>

    </div>
</div>
<!-- page -->
</body>
</html>
