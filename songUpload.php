<form id="songUpload" method="post" enctype="multipart/form-data">
    <?php //text box for song title ?>
    Song Title: <input type="text" name="songName" required></br>
    <?php //text box for artist ?>
    Artist: <input type="text" name="artist" required></br>
    <?php //text box for arrangers ?>
    Arranger(s): <input type="text" name="arranger"> (separate multiple names by commas)</br>
    <?php //dropdowm box for genre ?>
    Genre: <select name="genre">
        <option value="null"></option>
        <option value="alternative">Alternative</option>
        <option value="country">Country</option>
        <option value="hipHop">Hip-Hop</option>
        <option value="pop">Pop</option>
        <option value="punk">Punk</option>
        <option value="rap">Rap</option>
        <option value="rock">Rock</option>
        <option value="other">Other</option>
    </select></br>
    <?php //dropdown box for release year ?>
    Release Year: <select name="releaseYear">
        <option value="null"></option>
        <?php
            $year= date('Y');
            for($j=$year;$j>=1960;$j--){
                print("<option value=\"$j\"> $j</option>");
            }
        ?>
    </select></br>
    <?php //dropdown box for quality ?>
    Quality: <select name="quality">
        <option value="null"></option>
        <option value="useable">Usable</option>
        <option value="needsWork">Needs Work</option>
        <option value="bad">Bad</option>
    </select></br>
    <?php //radio buttons for active ?>
    Active: <input type="radio" name="active" value="yes" checked>Yes
    <input type="radio" name="active" value="no">No</br>
    <?php //dropdown box for arrangement structure ?>
    Arrangement Structure: <select name="structure">
        <option value="null"></option>
        <option value="4part">4-Part</option>
        <option value="group">Group</option>
        <option value="modern">Modern</option>
        <option value="glee">Glee/Choral</option>
    </select>
    <?php //radio buttons for syllables ?>
    Syllables: <input type="radio" name="syllables" value="yes">Yes
    <input type="radio" name="syllables" value="no">No</br>
    <?php //file input for mp3 ?>
    MP3: <input type="file" name="mp3">
    <?php //text box for youtube link ?>
    Youtube Link: <input type="url" name="youtube">
    <?php //dropdown box for key ?>
    Key: <select name="key">
        <option value="null"></option>
        <option value="A">A</option>
        <option value="A#">A#</option>
        <option value="Bb">Bb</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="C#">C#</option>
        <option value="Db">Db</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="E#">E#</option>
        <option value="Ff">Ff</option>
        <option value="F">F</option>
        <option value="G">G</option>
        <option value="G#">G#</option>
    </select>
    <select name="key2">
        <option value="null"></option>
        <option value="major">Major</option>
        <option value="minor">Minor</option>
    </select>
    <?php //dropdown box for solo range ?>
    Solo Range: <select name="soloRange">
        <option value="null"></option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
    </select>
    <select name="soloRange2">
        <option value="null"></option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
    </select>

    <?php //submit button?>
    <input type="submit" name="submit">
</form>

<?php
    //if submit is clicked
    if(isset($_POST['submit'])){
        //check song name, artist, arranger(s), mp3, youtube is valid
        $allValid==true;
        if(!checkName($_POST['songName'])){
            print('Song name is invalid');
            $allValid= false;
        }
        if(!checkName($_POST['artist'])){
            print('Artist is invalid');
            $allValid= false;
        }
        if(isset($_POST['arranger']) && !checkName($_POST['arranger'])){
            print('Arranger(s) is invalid');
            $allValid= false;
        }
        if(isset($_POST['mp3'])){
            $info = pathinfo($_POST['mp3']);
            if ($info["extension"] != "mp3"){
                $allValid= false;
            }
        }
        if(isset($_POST['youtube'])){
            if(!checkYoutube($_POST['youtube'])){
                $allValid= false;
            }
        }
        //if valid, create new entry in songs with all details that were entered
        if($allValid){
            $mysqli->query('INSERT INTO songs(songName)
                           VALUES("'.$_POST['songName'].'"');
            if(isset($_POST['arranger'])){
                $mysqli->query('UPDATE songs SET arranger='.$_POST['arranger']);
            }
        }
        //also check if artist is already in database, and if not make new entry in artists
        //either way create new entry in artistLink
        //if not valid give error message
        
    }
?>
