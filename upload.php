<form id="songUpload" method="post" enctype="multipart/form-data">
    Song Title: <input type="text" name="songName"></br>
    Artist: <input type="text" name="artist"></br>
    Arranger(s): <input type="text" name="arranger"> (separate multiple names by commas)</br>
    Genre: <select name="genre">
        <option value="alternative">Alternative</option>
        <option value="country">Country</option>
        <option value="hipHop">Hip-Hop</option>
        <option value="pop">Pop</option>
        <option value="punk">Punk</option>
        <option value="rap">Rap</option>
        <option value="rock">Rock</option>
        <option value="other">Other</option>
    </select></br>
    Release Year: <select name="releaseYear">
        <?php
            $year= date('Y');
            for($j=$year;$j>=1960;$j++){
                print("<option value=\"$j\"> $j</option>");
            }
        ?>
    </select></br>
    Quality: <select name="quality">
        <option value="useable">Usable</option>
        <option value="needsWork">Needs Work</option>
        <option value="bad">Bad</option>
    </select></br>
    Concerts Performed At: <select name="concert">
        for($j=1;$j<=$albums->num_rows;$j++){
            $concerts= $mysqli->query('SELECT * FROM concerts');
            $row= $concerts->fetch_assoc();
            print("<option value=\"$row[concertid]\"> $row[concertName]</option>");
        }
    </select></br>
    Active: <input type="radio" name="active" value="yes" checked>Yes</br>
    <input type="radio" name="active" value="no" checked>No</br>
    Arrangement Structure: <select name="structure">
        <option value="4part">4-Part</option>
        <option value="group">Group</option>
        <option value="modern">Modern</option>
        <option value="glee">Glee/Choral</option>
    </select>
    Syllables: <input type="text" name="syllables">
    Finale: <input type="file" name="finale">
    MP3: <input type="file" name="mp3">
    Youtube Link: <input type="text" name="youtube">
    Key: <select name="key">
        <option value=""></option>
    </select>
    Solo Range: <select name="soloRange">
        <option value=""></option>
    </select>
    Album: <select name="album">
        for($j=1;$j<=$albums->num_rows;$j++){
            $albums= $mysqli->query('SELECT * FROM albums');
            $row= $albums->fetch_assoc();
            print("<option value=\"$row[albumid]\"> $row[albumName]</option>");
        }
    </select>
</form>
