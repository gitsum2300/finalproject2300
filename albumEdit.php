<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="albumEdit.js"></script>

<?php
    if(isset($_POST['submitAlbumNew'])){
        startMysql();
    
        //check if album name is valid
        if(isset($_POST['albumNameNew']) && $_POST['albumNameNew']!='' && $_POST['albumNameNew']!=$_POST['albumNew']){
            if(!checkName($_POST['albumNameNew'])){
                print('albumName is not valid');
            }
            else {
                $mysqli->query('UPDATE albums SET albumName="'.$_POST['albumNameNew'].'"
                               WHERE albumid="'.$_POST['albumNew'].'"');
            }
        }
        
        for($j=0;$j<count($_POST['albumSongNew']);$j++){
            if($_POST['albumSongNew'][$j]!='null'){
                $copy= $mysqli->query('SELECT songid FROM albumLink WHERE albumid="'.$_POST['albumNew'].'"AND songid="'.$_POST['albumSongNew'][$j].'"');
                if($copy->num_rows<1){
                    $mysqli->query('INSERT INTO albumLink(songId, albumid)
                                VALUES("'.$_POST['albumSongNew'][$j].'", "'.$_POST['albumNew'].'")');
                }
            }
        }
        
        if($_POST['hangoverYearNew']!='null'){
            $mysqli->query('UPDATE albums SET hangoverYear="'.$_POST['hangoverYearNew'].'"
                               WHERE albumid="'.$_POST['albumNew'].'"');
        }
        
        if(!empty($_POST['deleteFromAlbum'])){
            for($k=0;$k<count($_POST['deleteFromAlbum']);$k++){
                $mysqli->query('DELETE FROM albumLink WHERE albumid="'.$_POST['albumNew'].'" AND songid="'.$_POST['deleteFromAlbum'][$k].'"');
            }
        }
        
        if(!empty($_POST['deleteAlbum'])){
            $mysqli->query('DELETE FROM albums WHERE albumid="'.$_POST['albumNew'].'"');
            $mysqli->query('DELETE FROM albumLink WHERE albumid="'.$_POST['albumNew'].'"');
        }
        
        mysqli_close($mysqli); 
    }

?>

<form id="albumEdit" method="post">
    
    <table id="albumEditTable">   
        
        <tr><td>Select Album: </td><td><select id= "albumNew" name="albumNew">
            <option value="null"></option>
            <?php
                startMysql();
                $query= $mysqli->query('SELECT albumid, albumName, hangoverYear FROM albums ORDER BY albumName');
                for($j=1;$j<=$query->num_rows;$j++){
                    $row= $query->fetch_assoc();
                    print("<option value=\"$row[albumid]\"/> $row[albumName] -- $row[hangoverYear]</option>");
                }
                mysqli_close($mysqli);
            ?>
        </select></td></tr>
        <tr><td>Edit Album Title: </td><td><input type="text" id="albumNameNew" name="albumNameNew"></td></tr>
        <tr>
            <td>Year: </td><td><select id="hangoverYearNew" name="hangoverYearNew">
            <option value="null"></option>
            <?php
                $year= date('Y');
                for($j=$year;$j>=1960;$j--){
                    print("<option value=\"$j\"> $j</option>");
                }
            ?>
        </select></td></tr>
        <tr>  
            <td >Add Song: </td><td><select id="albumSongNew" name="albumSongNew[]">
            <option value="null"></option>
            <?php
                startMysql();
                $qu= 'SELECT songid, songName, artistName FROM songs NATURAL JOIN
                                       artistLink NATURAL JOIN artists ORDER BY songName';
                
                $query2= $mysqli->query($qu);
                for($j=1;$j<=$query2->num_rows;$j++){
                    $row= $query2->fetch_assoc();
                    print("<option value=\"$row[songid]\"/> $row[songName] -- $row[artistName]</option>");
                }
                mysqli_close($mysqli);
            ?>
        </select></td>
        <td><input type="button" id="addEditAlbumRow" name="addEditAlbumRow" value="add another song"></td>
        </tr>
        <div id="deleteCodeAlbum"></div>
        <tr id="deleteEntireAlbum"><td>Delete Entire Album: </td><td><input type="checkbox" value="" id="deleteAlbum" name="deleteAlbum[]"></td></tr>
    </table>
    <input type="submit" id="submitAlbumNew" name="submitAlbumNew" >
</form>