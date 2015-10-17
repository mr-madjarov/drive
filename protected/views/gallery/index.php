<?php
/* @var $this GalleryController */
?>


<div class="gallery">
    <!-- Active Content Workaround Support File -->
    <script src="resources/javascript/AC_RunActiveContent.js" type="text/javascript"></script>
    <script type="text/javascript">
        <!--
        function getQueryVariable( variable ) {
            var query = window.location.search.substring( 1 );
            var vars = query.split( "&" );
            for ( var i = 0; i < vars.length; i++ ) {
                var pair = vars[i].split( "=" );
                if ( pair[0] == variable ) {
                    return pair[1];
                }
            }
            return -1;
        }
        // -->
    </script>

    <script type="text/javascript">
        <!--
        var startImg = getQueryVariable( "startImg" );
        //alert(startImg);
        // -->
    </script>

    <!-- Flash Detection Script Block -->
    <script type="text/javascript">
        <!--
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // Globals
        // Major version of Flash required
        var requiredMajorVersion = 8;
        // Minor version of Flash required
        var requiredMinorVersion = 0;
        // Minor version of Flash required
        var requiredRevision = 0;
        // the version of javascript supported
        var jsVersion = 1.0;
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // -->
    </script>
    <script type="text/vbscript">
<!-- // Visual basic helper required to detect Flash Player ActiveX control version information
        Function VBGetSwfVer(i)
          on error resume next
          Dim swControl, swVersion
          swVersion = 0

          set swControl = CreateObject("ShockwaveFlash.ShockwaveFlash." + CStr(i))
          if (IsObject(swControl)) then
            swVersion = swControl.GetVariable("$version")
          end if
          VBGetSwfVer = swVersion
        End Function
// -->


    </script>
    <script type="text/javascript">
        <!-- // Detect Client Browser type
        var isIE = (navigator.appVersion.indexOf( "MSIE" ) != -1) ? true : false;
        var isWin = (navigator.appVersion.toLowerCase().indexOf( "win" ) != -1) ? true : false;
        var isOpera = (navigator.userAgent.indexOf( "Opera" ) != -1) ? true : false;
        jsVersion = 1.1;
        // JavaScript helper required to detect Flash Player PlugIn version information
        function JSGetSwfVer( i ) {
            // NS/Opera version >= 3 check for Flash plugin in plugin array
            if ( navigator.plugins != null && navigator.plugins.length > 0 ) {
                if ( navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"] ) {
                    var swVer2 = navigator.plugins["Shockwave Flash 2.0"] ? " 2.0" : "";
                    var flashDescription = navigator.plugins["Shockwave Flash" + swVer2].description;
                    descArray = flashDescription.split( " " );
                    tempArrayMajor = descArray[2].split( "." );
                    versionMajor = tempArrayMajor[0];
                    versionMinor = tempArrayMajor[1];
                    if ( descArray[3] != "" ) {
                        tempArrayMinor = descArray[3].split( "r" );
                    } else {
                        tempArrayMinor = descArray[4].split( "r" );
                    }
                    versionRevision = tempArrayMinor[1] > 0 ? tempArrayMinor[1] : 0;
                    flashVer = versionMajor + "." + versionMinor + "." + versionRevision;
                } else {
                    flashVer = -1;
                }
            }
            // MSN/WebTV 2.6 supports Flash 4
            else if ( navigator.userAgent.toLowerCase().indexOf( "webtv/2.6" ) != -1 ) {
                flashVer = 4;
            }
            // WebTV 2.5 supports Flash 3
            else if ( navigator.userAgent.toLowerCase().indexOf( "webtv/2.5" ) != -1 ) {
                flashVer = 3;
            }
            // older WebTV supports Flash 2
            else if ( navigator.userAgent.toLowerCase().indexOf( "webtv" ) != -1 ) {
                flashVer = 2;
            }
            // Can't detect in all other cases
            else {

                flashVer = -1;
            }
            return flashVer;
        }
        // When called with reqMajorVer, reqMinorVer, reqRevision returns true if that version or greater is available
        function DetectFlashVer( reqMajorVer, reqMinorVer, reqRevision ) {
            reqVer = parseFloat( reqMajorVer + "." + reqRevision );
            // loop backwards through the versions until we find the newest version
            for ( i = 25; i > 0; i = i - 1 ) {
                if ( isIE && isWin && !isOpera ) {
                    versionStr = VBGetSwfVer( i );
                } else {
                    versionStr = JSGetSwfVer( i );
                }
                if ( versionStr == -1 ) {
                    return false;
                } else if ( versionStr != 0 ) {
                    if ( isIE && isWin && !isOpera ) {
                        tempArray = versionStr.split( " " );
                        tempString = tempArray[1];
                        versionArray = tempString.split( "," );
                    } else {
                        versionArray = versionStr.split( "." );
                    }
                    versionMajor = versionArray[0];
                    versionMinor = versionArray[1];
                    versionRevision = versionArray[2];

                    versionString = versionMajor + "." + versionRevision;   // 7.0r24 == 7.24
                    versionNum = parseFloat( versionString );
                    // is the major.revision >= requested major.revision AND the minor version >= requested minor
                    if ( (versionMajor > reqMajorVer) && (versionNum >= reqVer) ) {
                        return true;
                    } else {
                        return ((versionNum >= reqVer && versionMinor >= reqMinorVer) ? true : false );
                    }
                }
            }
        }
        // -->
    </script>


    <script type="text/javascript">
        <!--
        // Version check for the Flash Player that has the ability to start Player Product Install (6.0r65)
        var hasProductInstall = DetectFlashVer( 6, 0, 65 );

        // Version check based upon the values entered above in "Globals"
        var hasReqestedVersion = DetectFlashVer( requiredMajorVersion, requiredMinorVersion, requiredRevision );

        // Location visited after installation is complete if installation is required
        var MMredirectURL = window.location;

        // Stored value of document title used by the installation process to close the window that started the installation process
        // This is necessary to remove browser windows that will still be utilizing the older version of the player after installation is complete
        // DO NOT MODIFY THE FOLLOWING TWO LINES
        //document.title = document.title.slice(0, 47) + " - Flash Player Installation";
        document.title = document.title.slice( 0, 47 );
        var MMdoctitle = document.title;

        // Check to see if a player with Flash Product Install is available and the version does not meet the requirements for playback
        if ( hasProductInstall && !hasReqestedVersion ) {
            var productInstallOETags = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"' + 'width="550" height="200"' + 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">' + '<param name="movie" value="resources/playerProductInstall.swf?MMredirectURL=' + MMredirectURL + '&MMplayerType=ActiveX&MMdoctitle=' + MMdoctitle + '" />' + '<param name="quality" value="best" /><param name="bgcolor" value="#3A6EA5" />' + '<embed src="resources/playerProductInstall.swf?MMredirectURL=' + MMredirectURL + '&MMplayerType=PlugIn" quality="high" bgcolor="#3A6EA5" ' + 'width="550" height="300" name="detectiontest" aligh="middle"' + 'play="true"' + 'loop="false"' + 'quality="best"' + 'allowScriptAccess="sameDomain"' + 'type="application/x-shockwave-flash"' + 'pluginspage="http://www.adobe.com/go/getflashplayer">' + '<\/embed>' + '<\/object>';
            document.write( productInstallOETags );   // embed the Flash Product Installation SWF
        } else if ( hasReqestedVersion ) {  // if we've detected an acceptable version
            AC_FL_RunContent( 'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0', 'flashvars', 'livePreview=false&baseRefUrl=&groupxml=resources/mediaGroupData/group.xml&stylexml=resources/styles/style.xml&localText=resources/localization/localText.xml&startImg=' + startImg, 'width', '100%', 'height', '100%', 'src', 'resources/gallery', 'quality', 'high', 'pluginspage', 'http://www.adobe.com/go/getflashplayer', 'align', 'middle', 'play', 'true', 'loop', 'true', 'scale', 'showall', 'wmode', 'window', 'devicefont', 'false', 'id', 'gallery', 'bgcolor', '#f7f7f7', 'name', 'gallery', 'menu', 'true', 'allowScriptAccess', 'sameDomain', 'movie', 'resources/gallery', 'salign', '' );
        } else {  // flash is too old or we can't detect the plugin
            var alternateContent = 'This photo gallery requires the Adobe Flash Player.' + '<a href=http://www.adobe.com/go/getflash/>Get the free Flash Player here</a>';
            document.write( alternateContent );  // insert non-flash content
        }
        // -->
    </script>
    <noscript>
        <!-- Provide alternate content for browsers that do not support scripting
             or for those that have scripting disabled. -->
        <p>
            Sorry, this photo gallery requires that scripting be enabled on your web browser and that the Adobe Flash Player be installed.
            <a href="http://www.adobe.com/go/getflash/">Download the Adobe Flash Player</a>
        </p>
    </noscript>

</div>
