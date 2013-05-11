<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="albumUpload.js"></script>

<?php
    //if submit is clicked
    if(isset($_POST['submitAlbum'])){
        startMysql();
    
        //check if album name is valid
        if(!checkName($_POST['albumName'])){
             print('<p style="color:red"> Album Name is not valid</p>');
        }
        else {
            $mysqli->query('INSERT INTO albums(albumName, hangoverYear)
                           VALUES("'.$_POST['albumName'].'", "'.$_POST['hangoverYear'].'")');
            $albumidquery= $mysqli->query('SELECT max(albumid) FROM albums');
            $albumidarray= $albumidquery->fetch_row();
            $albumid= $albumidarray[0];
            for($j=0;$j<count($_POST['albumSong']);$j++){
                if($_POST['albumSong'][$j]!='null'){
                    $copy= $mysqli->query('SELECT songid FROM albumLink WHERE albumid="'.$albumid.'"AND songid="'.$_POST['albumSong'][$j].'"');
                    if($copy->num_rows<1){
                        $mysqli->query('INSERT INTO albumLink(songId, albumid)
                                    VALUES("'.$_POST['albumSong'][$j].'", "'.$albumid.'")');
                    }
                }
            }
        }
        mysqli_close($mysqli); 
    }
    
    
?>

<form id="albumUpload" method="post">
    <table id="albumUploadTable">
        <tr><td>Album Title: </td><td><input type="text" id="hangoverYear" name="albumName" required></td></tr>
        <tr>
            <td>Year: </td><td><select name="hangoverYear">
            <?php
                $year= date('Y');
                for($j=$year;$j>=1960;$j--){
                    print("<option value=\"$j\"> $j</option>");
                }
            ?>
        </select></td></tr>
        <tr>  
            <td>Add Song: </td><td id="buttonNext"><select name="albumSong[]" id="albumSong">
            <option value="null"></option>
            <?php
                startMysql();
                $query= $mysqli->query('SELECT songid, songName, artistName FROM songs NATURAL JOIN
                                       artistLink NATURAL JOIN artists ORDER BY songName');
                for($j=1;$j<=$query->num_rows;$j++){
                    $row= $query->fetch_assoc();
                    print("<option value=\"$row[songid]\"/> $row[songName] -- $row[artistName]</option>");
                }
                mysqli_close($mysqli);
            ?>
        </select></td>
        <?php //<td><input type="button" id="addUploadAlbumRow" name="addUploadAlbumRow" value="add another song"></td>*/ ?>
        </tr>
    </table>
    <input type="submit" name="submitAlbum">
</form>