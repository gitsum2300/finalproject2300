<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="concertEdit.js"></script>

<?php
    if(isset($_POST['submitConcertNew'])){
        startMysql();
        
        //check if concert name is valid
        if(isset($_POST['concertNameNew']) && $_POST['concertNameNew']!=''){
            if(!checkName($_POST['concertNameNew'])){
                print('concertName is not valid');
            }
            else {
                $mysqli->query('UPDATE concerts SET concertName="'.$_POST['concertNameNew'].'"
                               WHERE concertid="'.$_POST['concertNew'].'"');
            }
        }
        
        for($j=0;$j<count($_POST['concertSongNew']);$j++){
            if($_POST['concertSongNew'][$j]!='null'){
                $copy= $mysqli->query('SELECT songid FROM concertLink WHERE concertid="'.$_POST['concertNew'].'"AND songid="'.$_POST['concertSongNew'][$j].'"');
                if($copy->num_rows<1){
                    $mysqli->query('INSERT INTO concertLink(songId, concertid)
                                VALUES("'.$_POST['concertSongNew'][$j].'", "'.$_POST['concertNew'].'")');
                }
            }
        }
        
        if($_POST['concertYearNew']!='null'){
            $mysqli->query('UPDATE concerts SET concertYear="'.$_POST['concertYearNew'].'"
                               WHERE concertid="'.$_POST['concertNew'].'"');
        }
        
        if(!empty($_POST['deleteFromConcert'])){
            for($k=0;$k<count($_POST['deleteFromConcert']);$k++){
                $mysqli->query('DELETE FROM concertLink WHERE concertid="'.$_POST['concertNew'].'" AND songid="'.$_POST['deleteFromConcert'][$k].'"');
            }
        }
        
        if(!empty($_POST['deleteConcert'])){
            $mysqli->query('DELETE FROM concerts WHERE concertid="'.$_POST['concertNew'].'"');
            $mysqli->query('DELETE FROM concertLink WHERE concertid="'.$_POST['concertNew'].'"');
        }
        
        mysqli_close($mysqli); 
    }

?>

<form id="concertEdit" method="post">
    <table id="concertEditTable">
        <tr><td>Select Concert: </td><td><select id="concertNew" name="concertNew">
            <option value="null"></option>
            <?php
                startMysql();
                $query= $mysqli->query('SELECT concertid, concertName, concertYear FROM concerts ORDER BY concertName');
                for($j=1;$j<=$query->num_rows;$j++){
                    $row= $query->fetch_assoc();
                    print("<option value=\"$row[concertid]\"/> $row[concertName] -- $row[concertYear]</option>");
                }
                mysqli_close($mysqli);
            ?>
        </select></td></tr>
        <tr><td>Edit Concert Title: </td><td><input type="text" id="concertNameNew" name="concertNameNew"></td></tr>
        <tr>
            <td>Year: </td><td><select id="concertYearNew" name="concertYearNew">
            <option value="null"></option>
            <?php
                $year= date('Y');
                for($j=$year;$j>=1960;$j--){
                    print("<option value=\"$j\"> $j</option>");
                }
            ?>
        </select></td></tr>
        <tr>  
            <td>Add Song: </td><td id="buttonNext"><select id= "concertSongNew" name="concertSongNew">
            <option value="null"></option>
            <?php
                startMysql();
                $query2= $mysqli->query('SELECT songid, songName, artistName FROM songs NATURAL JOIN
                                       artistLink NATURAL JOIN artists ORDER BY songName');
                for($j=1;$j<=$query2->num_rows;$j++){
                    $row= $query2->fetch_assoc();
                    print("<option value=\"$row[songid]\"/> $row[songName] -- $row[artistName]</option>");
                }
                mysqli_close($mysqli);
            ?>
        </select></td>
        <td><input type="button" id="addEditConcertRow" name="addEditConcertRow" value="add another song"></td></tr> 
        <div id="deleteCodeConcert"></div>
        <tr><td>Delete Entire Concert: </td><td><input type="checkbox" value="" id="deleteConcert" name="deleteConcert[]"></td></tr>
    </table>
    <input type="submit" name="submitConcertNew">
</form>