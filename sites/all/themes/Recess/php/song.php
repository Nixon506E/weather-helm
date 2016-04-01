<?php if( isset($_GET) ) { ?>
    <?php if( $_GET['debug'] == 'true' ) { ?>
        <script type="text/javascript" src="/sites/all/themes/recess/js/jquery-1.9.1.min.js"></script>

        <style> audio { display: block!important; } </style>
    <?php } ?>
<?php } ?>

<?php

    chdir($_SERVER['DOCUMENT_ROOT']);
    define('DRUPAL_ROOT', getcwd()); 
    require_once './includes/bootstrap.inc';
    drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

    $nodes = array_values( node_load_multiple(array(), array('type' => 'song')) ); 
    $song = $nodes[0];


    if( isset($_POST) )
    {
        if( isset($_POST['songArtist']) )
        {
            $song = node_load($song->nid);

            $song->title = $_POST['songTitle'];
            $song->body[LANGUAGE_NONE][0]["value"] = $_POST['songURL'];
            
            $song->field_song_artist[LANGUAGE_NONE][0]["value"] = $_POST['songArtist'];
            $song->field_song_album[LANGUAGE_NONE][0]["value"] = $_POST['songAlbum'];
            $song->field_song_album_art[LANGUAGE_NONE][0]["value"] = $_POST['songCover'];
            $song->field_song_position[LANGUAGE_NONE][0]["value"] = $_POST['songPosition'];

            node_save($song);

            echo "SUCCESS";

            exit();
        }
        else if( isset($_POST['type']) && $_POST['type'] == "GET_LATEST" )
        {
            $songUpdated = $song->changed;
            $songCurrent = $song->field_song_position[LANGUAGE_NONE][0]["value"];

            $timeDifference = (time() - $songUpdated) + 2;

            echo $song->body[LANGUAGE_NONE][0]["value"] ."|||". ($songCurrent + $timeDifference) ."|||". $song->title ."|||". $song->field_song_artist[LANGUAGE_NONE][0]["value"];
        }
        else
        {
            $songUpdated = $song->changed;
            $songCurrent = $song->field_song_position['und'][0]["value"];

            $timeDifference = (time() - $songUpdated) + 2;


            $tracktime = ($songCurrent + $timeDifference);
        }
    }

    //Detect special conditions devices
    $iPod    = (strpos($_SERVER['HTTP_USER_AGENT'],"iPod") > -1) ? 1 : 0;
    $iPhone  = (strpos($_SERVER['HTTP_USER_AGENT'],"iPhone") > -1) ? 1 : 0;
    $iPad    = (strpos($_SERVER['HTTP_USER_AGENT'],"iPad") > -1) ? 1 : 0;
    $Android = (strpos($_SERVER['HTTP_USER_AGENT'],"Android") > -1) ? 1 : 0;
    $webOS   = (strpos($_SERVER['HTTP_USER_AGENT'],"webOS") > -1) ? 1 : 0;

?>



<?php if( !isset($_POST['songArtist']) && !isset($_POST['type']) ) { ?>

    <div id="spectrum">
        <canvas width="100%" height="50" id="canvas-top"></canvas>
        <canvas width="100%" height="50" id="canvas-bot"></canvas>
    </div>


    <section class="now-playing">
        <header>
            <p>Recess Radio <em>Live</em></p>
        </header>
        <section class="track">
            <p class="track-name"><strong><?php echo $song->title; ?></strong></p>
            <p class="artist"><?php echo $song->field_song_artist[LANGUAGE_NONE][0]["value"]; ?></p>
        </section>
    </section>


    <?php if( ($iPod == 0 && $iPhone == 0 && $iPad == 0 && $Android == 0 && $webOS == 0) ) { ?>

        <script type="text/javascript" src="/sites/all/themes/recess/js/song.js"></script>
        
        <audio controls oncanplay="initAudioEvents()" style="display:none;" onstalled="audioStalled()">
            <source src="<?php echo $song->body[LANGUAGE_NONE][0]["value"] ; ?>" type="audio/mpeg">
            <source src="<?php echo $song->body[LANGUAGE_NONE][0]["value"] ; ?>" type="audio/ogg">
        </audio>

    <?php } ?>

    <input type="hidden" name="songPositionTime" id="songPositionTime" value="<?php echo $tracktime; ?>" />
    
<?php } ?>



