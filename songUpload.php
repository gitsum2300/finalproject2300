<?php
    include('helperFunctions.php');
    //if submit is clicked
    if(isset($_POST['submitSong'])){
        //check song name, artist, arranger(s), mp3, youtube is valid
        $allValid=true;
        $songartistValid=true;
        if(!checkName($_POST['songName'])){
            print('<p style="color:red"> Song Name is not valid</p>');
            $allValid= false;
            $songartistValid=false;
        }
        if(!checkName($_POST['artist'])){
            print('<p style="color:red"> Artist is not valid</p>');
            $allValid= false;
            $songartistValid=false;
        }
        if(isset($_POST['arranger']) && $_POST['arranger']!='' && !checkName($_POST['arranger'])){
            print('<p style="color:red"> Arranger(s) is not valid</p>');
            $allValid= false;
        }
        if(isset($_FILES['mp3']) && $_FILES['mp3']['error']==0 && !checkmp3($_FILES['mp3']['name'])){
            $allValid= false;
            print('<p style="color:red"> Mp3 is not the correct file type</p>');
        }
        if(isset($_FILES['pdf']) && $_FILES['pdf']['error']==0 && !checkpdf($_FILES['pdf']['name'])){
            $allValid= false;
            print('<p style="color:red"> Pdf is not the correct file type</p>');
        }
        if(isset($_POST['youtube']) && $_POST['youtube']!='' && !checkYoutube($_POST['youtube'])){
            $allValid= false;
            print('<p style="color:red"> Youtube link is not valid</p>');
        }
        if(($_POST['soloRange']!='null' && $_POST['soloRange2']=='null') || ($_POST['soloRange2']!='null' && $_POST['soloRange']=='null')){
            $allValid= false;
            print('<p style="color:red"> Solo Range must have both values</p>');
        }
        if($songartistValid){
            startMysql();
            $all= $mysqli->query('SELECT * FROM songs NATURAL JOIN artistLink NATURAL JOIN artists
                                 WHERE songName="'.$_POST['songName'].'" AND artistName="'.$_POST['artist'].'"');
            if($all->num_rows>0){
                $allValid=false;
                print('<p style="color:red"> This song by this artist is already in the database </p>');
            }
            mysqli_close($mysqli);
        }
        
        
        //if valid, create new entry in songs with all details that were entered
        if($allValid){
            startMysql();
            
            $songName= strip_tags($_POST['songName']);
            $mysqli->query('INSERT INTO songs(songName, mp3, pdf) VALUES("'.$songName.'", "no", "no")');
            $songidquery= $mysqli->query('SELECT max(songid) FROM songs');
            $songidarray= $songidquery->fetch_row();
            $songid= $songidarray[0];
            
            $artistName= strip_tags($_POST['artist']);
            $artistQuery= $mysqli->query('SELECT artistid FROM artists WHERE artistName="'.$artistName.'"');
        
            if($artistQuery->num_rows<1){ //artist not yet in DB
                $mysqli->query('INSERT INTO artists(artistName) VALUES("'.$artistName.'")');
                $artistidquery= $mysqli->query('SELECT max(artistid) FROM artists');
                $artistidarray= $artistidquery->fetch_row();
                $artistid= $artistidarray[0];
                $mysqli->query('INSERT INTO artistLink(songid, artistid, releaseYear)
                              VALUES("'.$songid.'", "'.$artistid.'", "'.$_POST['releaseYear'].'")');
            }
            else { //artist already in DB
                $artistArray= $artistQuery->fetch_row();
                $artistid= $artistArray[0];
                $mysqli->query('INSERT INTO artistLink(songid, artistid, releaseYear)
                              VALUES("'.$songid.'", "'.$artistid.'", "'.$_POST['releaseYear'].'")');
            }
            
            if(isset($_POST['arranger'])){
                $mysqli->query('UPDATE songs SET arranger="'.strip_tags($_POST['arranger']).'"
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['genre']!='null') {
                $mysqli->query('UPDATE songs SET genre="'.$_POST['genre'].'"
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['quality']!='null') {
                $mysqli->query('UPDATE songs SET quality="'.$_POST['quality'].'"
                               WHERE songid="'.$songid.'"');
            }
            
            $mysqli->query('UPDATE songs SET active="'.$_POST['active'].'"
                               WHERE songid="'.$songid.'"');
            
            if($_POST['structure']!='null') {
                $mysqli->query('UPDATE songs SET structure="'.$_POST['structure'].'"
                               WHERE songid="'.$songid.'"');
            }
            
            if(isset($_POST['syllables'])) {
                $mysqli->query('UPDATE songs SET syllables="'.$_POST['syllables'].'"
                               WHERE songid="'.$songid.'"');
            }

            if(file_exists($_FILES['mp3']['tmp_name'])){
                move_uploaded_file($_FILES['mp3']['tmp_name'],"mp3/".$songid);
                $mysqli->query('UPDATE songs SET mp3="yes"
                               WHERE songid="'.$songid.'"');
            }
            
            if(file_exists($_FILES['pdf']['tmp_name'])){
                move_uploaded_file($_FILES['pdf']['tmp_name'],"pdf/".$songid);
                $mysqli->query('UPDATE songs SET pdf="yes"
                               WHERE songid="'.$songid.'"');
            }
            
            if(isset($_POST['youtube'])) {
                $mysqli->query('UPDATE songs SET youtube="'.$_POST['youtube'].'"
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['key']!='null' && $_POST['key2']!='null') {
                $mysqli->query('UPDATE songs SET keykey="'.$_POST['key'].' '.$_POST['key2'].'"
                               WHERE songid="'.$songid.'"');
            }
            
            if($_POST['soloRange']!='null' && $_POST['soloRange2']!='null') {
                $mysqli->query('UPDATE songs SET soloRange="'.$_POST['soloRange'].'-'.$_POST['soloRange2'].'"
                               WHERE songid="'.$songid.'"');
            }
            
            mysqli_close($mysqli);
        }
        else {
            
        }
    }
?>



<form id="songUpload" method="post" enctype="multipart/form-data">
    <table>
	<?php //text box for song title ?>
    <tr>
	<td>Song Title:	</td>
	<td><input type="text" name="songName" required></td>
    </tr>
    <?php //text box for artist ?>
    <tr>
	<td>Artist: </td>
	<td><input type="text" name="artist" required></td>
    </tr>
    <?php //dropdown box for release year ?>
    <tr>
	<td>Release Year: </td><td><select name="releaseYear">
        <?php
            $year= date('Y');
            for($j=$year;$j>=1960;$j--){
                print("<option value=\"$j\"> $j</option>");
            }
        ?>
    </select></td>
    </tr>
    <?php //radio buttons for active ?>
    <tr>
	<td>Active: </td><td><input type="radio" name="active" value="yes" checked>Yes
        <input type="radio" name="active" value="no">No</td>
    </tr>
    <?php //file input for pdf ?>
	<tr>
	<td>PDF: </td><td><input type="file" name="pdf"></td>
        </tr>
    <?php //text box for arrangers ?>
    <tr>
	<td>Arranger(s): </td>
	<td><input type="text" name="arranger"> (separate multiple names by commas)</td>
    </tr>
    <?php //dropdowm box for genre ?>
    <tr>
	<td>Genre: </td><td><select name="genre">
        <option value="null"></option>
        <option value="Alternative">Alternative</option>
        <option value="Country">Country</option>
        <option value="Hip-Hop">Hip-Hop</option>
        <option value="Pop">Pop</option>
        <option value="Punk">Punk</option>
        <option value="Rap">Rap</option>
        <option value="Rock">Rock</option>
        <option value="Other">Other</option>
    </select></td>
    </tr>
    <?php //dropdown box for quality ?>
    <tr>
	<td>Quality: </td><td><select name="quality">
        <option value="null"></option>
        <option value="Usable">Usable</option>
        <option value="Needs Work">Needs Work</option>
        <option value="Bad">Bad</option>
    </select></td>
    </tr>
    <?php //dropdown box for arrangement structure ?>
    <tr>
	<td>Arrangement Structure: </td><td><select name="structure">
        <option value="null"></option>
        <option value="4-Part">4-Part</option>
        <option value="Group">Group</option>
        <option value="Modern">Modern</option>
        <option value="Glee/Choral">Glee/Choral</option>
    </select></td>
    </tr>
    <?php //radio buttons for syllables ?>
    <tr>
	<td>Syllables: </td><td><input type="radio" name="syllables" value="yes">Yes
    <input type="radio" name="syllables" value="no">No</td>
	</tr>
    <?php //file input for mp3 ?>
	<tr>
	<td>MP3: </td><td><input type="file" name="mp3"></td>
        </tr>
    <?php //text box for youtube link ?>
	<tr>
    <td>Youtube Link: </td><td><input type="text" name="youtube"></td>
	</tr>
    <?php //dropdown box for key ?>
    <tr>
	<td>Key: </td><td><select name="key">
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
        <option value="Major">Major</option>
        <option value="Minor">Minor</option>
    </select></td>
    </tr>
    <?php //dropdown box for solo range ?>
    <tr>
	<td>Solo Range: </td><td><select name="soloRange">
        <option value="null"></option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
    </select>
    to
    <select name="soloRange2">
        <option value="null"></option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
    </select></td>
    </tr>
    </table>
    <?php //submit button?>
    <input type="submit" name="submitSong">
</form>