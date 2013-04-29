<form id="songEdit" method="post" enctype="multipart/form-data">
    <?php //text box for song title ?>
    Edit Song Title: <input type="text" name="songNameNew"></br>
    <?php //text box for artist ?>
    Edit Artist: <input type="text" name="artistNew"></br>
    <?php //text box for arrangers ?>
    Edit Arranger(s): <input type="text" name="arrangerNew"> (separate multiple names by commas)</br>
    <?php //dropdowm box for genre ?>
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
    <?php //dropdown box for release year ?>
    Edit Release Year: <select name="releaseYearNew">
        <?php
            $year= date('Y');
            for($j=$year;$j>=1960;$j--){
                print("<option value=\"$j\"> $j</option>");
            }
        ?>
    </select></br>
    <?php //dropdown box for quality ?>
    Edit Quality: <select name="qualityNew">
        <option value="useable">Usable</option>
        <option value="needsWork">Needs Work</option>
        <option value="bad">Bad</option>
    </select></br>
    <?php //radio buttons for active ?>
    Edit Active: <input type="radio" name="activeNew" value="yes" checked>Yes</br>
    <input type="radio" name="activeNew" value="no" checked>No</br>
    <?php //dropdown box for arrangement structure ?>
    Edit Arrangement Structure: <select name="structureNew">
        <option value="4part">4-Part</option>
        <option value="group">Group</option>
        <option value="modern">Modern</option>
        <option value="glee">Glee/Choral</option>
    </select>
    <?php //radio buttons for syllables for artist ?>
    Edit Syllables: <input type="radio" name="syllablesNew" value="yes">Yes
    <input type="radio" name="syllablesNew" value="no">No</br>
    <?php //file input for finale ?>
    Edit MP3: <input type="file" name="mp3New">
    <?php //text box for youtube link ?>
    Edit Youtube Link: <input type="text" name="youtubeNew">
    <?php //dropdown box for key ?>
    Edit Key: <select name="keyNew">
        <option value=""></option>
    </select>
    <?php //dropdown box for solo range ?>
    Edit Solo Range: <select name="soloRangeNew">
        <option value=""></option>
    </select>
    <?php //submit button?>
    <input type="submit" name="submitNew">
</form>

<?php
    //if submit is clicked
    //for each entry that has changed, check song name, artist, arranger(s), finale, mp3, youtube is valid
    //also check if artist is already in database, and if not make new entry in artists
    //if all is valid, for each entry that has changed, edit the entry in songs
    //if not valid give error message
?>
