<form id="songEdit" method="post" enctype="multipart/form-data">
    <?php //form to choose song?>
    Edit Song Title: <input type="text" name="songNameNew"></br>
    Edit Artist: <input type="text" name="artistNew"></br>
    Edit Arranger(s): <input type="text" name="arrangerNew"> (separate multiple names by commas)</br>
    Edit Genre: <select name="genreNew">
        <option value="alternative">Alternative</option>
        <option value="country">Country</option>
        <option value="hipHop">Hip-Hop</option>
        <option value="pop">Pop</option>
        <option value="punk">Punk</option>
        <option value="rap">Rap</option>
        <option value="rock">Rock</option>
        <option value="other">Other</option>
    </select></br>
    Edit Release Year: <select name="releaseYearNew">
        <?php
            $year= date('Y');
            for($j=$year;$j>=1960;$j++){
                print("<option value=\"$j\"> $j</option>");
            }
        ?>
    </select></br>
    Edit Quality: <select name="qualityNew">
        <option value="useable">Usable</option>
        <option value="needsWork">Needs Work</option>
        <option value="bad">Bad</option>
    </select></br>
    Edit Concerts Performed At: <select name="concertNew">
        <option value="null">None</option>
        <?php
            for($j=1;$j<=$albums->num_rows;$j++){
                $concerts= $mysqli->query('SELECT * FROM concerts');
                $row= $concerts->fetch_assoc();
                print("<option value=\"$row[concertid]\"> $row[concertName]</option>");
            }
        ?>
    </select></br>
    Edit Active: <input type="radio" name="activeNew" value="yes" checked>Yes</br>
    <input type="radio" name="activeNew" value="no" checked>No</br>
    Edit Arrangement Structure: <select name="structureNew">
        <option value="4part">4-Part</option>
        <option value="group">Group</option>
        <option value="modern">Modern</option>
        <option value="glee">Glee/Choral</option>
    </select>
    Edit Syllables: <input type="radio" name="syllablesNew" value="yes">Yes
    <input type="radio" name="syllablesNew" value="no">No</br>
    Edit Finale: <input type="file" name="finale">
    Edit MP3: <input type="file" name="mp3New">
    Edit Youtube Link: <input type="text" name="youtubeNew">
    Edit Key: <select name="keyNew">
        <option value=""></option>
    </select>
    Edit Solo Range: <select name="soloRangeNew">
        <option value=""></option>
    </select>
    Edit Album: <select name="albumNew">
        <option value="null">None</option>
        <?php
            for($j=1;$j<=$albums->num_rows;$j++){
                $albums= $mysqli->query('SELECT * FROM albums');
                $row= $albums->fetch_assoc();
                print("<option value=\"$row[albumid]\"> $row[albumName]</option>");
            }
        ?>
    </select>
</form>
