<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="concertUpload.js"></script>


<?php
    //if submit is clicked
    if(isset($_POST['submitConcert'])){
        startMysql();
    
        //check if album name is valid
        if(!checkName($_POST['concertName'])){
            print('<p style="color:red"> Concert Name is not valid</p>');
        }
        else {
            $mysqli->query('INSERT INTO concerts(concertName, concertYear)
                           VALUES("'.$_POST['concertName'].'", "'.$_POST['concertYear'].'")');
            $concertidquery= $mysqli->query('SELECT max(concertid) FROM concerts');
            $concertidarray= $concertidquery->fetch_row();
            $concertid= $concertidarray[0];
            for($j=0;$j<count($_POST['concertSong']);$j++){
                if($_POST['concertSong'][$j]!='null' && $_POST['concertSong'][$j]!=''){
                    $copy= $mysqli->query('SELECT songid FROM concertLink WHERE concertid="'.$concertid.'"AND songid="'.$_POST['concertSong'][$j].'"');
                    if($copy->num_rows<1){
                        $mysqli->query('INSERT INTO concertLink(songId, concertid)
                                    VALUES("'.$_POST['concertSong'][$j].'", "'.$concertid.'")');
                    }
                }
            }
        }
        mysqli_close($mysqli); 
    }
    
    
?>

<form id="concertUpload" method="post">
    <table id="concertUploadTable">
        <tr><td>Concert Title: </td><td><input type="text" name="concertName" required></td></tr>
        <tr>
            <td>Year: </td><td><select name="concertYear">
            <?php
                $year= date('Y');
                for($j=$year;$j>=1960;$j--){
                    print("<option value=\"$j\"> $j</option>");
                }
            ?>
        </select></td></tr>
        <tr>  
            <td>Add Song: </td><td id="buttonNextConcertUpload"><select name="concertSong[]" id="concertSong">
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
        </tr>
    </table>
    <input type="submit" name="submitConcert">
</form>