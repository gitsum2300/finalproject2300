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
    <?php //text box for arrangers ?>
    <tr>
	<td>Arranger(s): </td>
	<td><input type="text" name="arranger"> (separate multiple names by commas)</td>
	</tr>
    <?php //dropdowm box for genre ?>
    <tr>
	<td>Genre: </td><td><select name="genre">
        <option value="null"></option>
        <option value="alternative">Alternative</option>
        <option value="country">Country</option>
        <option value="hipHop">Hip-Hop</option>
        <option value="pop">Pop</option>
        <option value="punk">Punk</option>
        <option value="rap">Rap</option>
        <option value="rock">Rock</option>
        <option value="other">Other</option>
    </select></td>
	</tr>
    <?php //dropdown box for release year ?>
    <tr>
	<td>Release Year: </td><td><select name="releaseYear">
        <option value="null"></option>
        <?php
            $year= date('Y');
            for($j=$year;$j>=1960;$j--){
                print("<option value=\"$j\"> $j</option>");
            }
        ?>
    </select></td>
	</tr>
    <?php //dropdown box for quality ?>
    <tr>
	<td>Quality: </td><td><select name="quality">
        <option value="null"></option>
        <option value="useable">Usable</option>
        <option value="needsWork">Needs Work</option>
        <option value="bad">Bad</option>
    </select></td>
	</tr>
    <?php //radio buttons for active ?>
    <tr>
	<td>Active: </td><td><input type="radio" name="active" value="yes" checked>Yes
    <input type="radio" name="active" value="no">No</td>
	</tr>
    <?php //dropdown box for arrangement structure ?>
    <tr>
	<td>Arrangement Structure: </td><td><select name="structure">
        <option value="null"></option>
        <option value="4part">4-Part</option>
        <option value="group">Group</option>
        <option value="modern">Modern</option>
        <option value="glee">Glee/Choral</option>
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
    <td>Youtube Link: </td><td><input type="url" name="youtube"></td>
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
        <option value="major">Major</option>
        <option value="minor">Minor</option>
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
