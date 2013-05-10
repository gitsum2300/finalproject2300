<?php
    include('helperFunctions.php');
    startMysql();
    
    $albumid= $_GET['id'];
    
    $findName= $mysqli->query('SELECT albumName, hangoverYear FROM albums WHERE albumid="'.$albumid.'"');
    $row= $findName->fetch_row();
    $albumName= $row[0];
    $albumYear= $row[1];

    $findSongs= $mysqli->query('SELECT songid FROM albumLink NATURAL JOIN songs WHERE albumid="'.$albumid.'" ORDER BY songName');
    $list="";
    $list = $albumName."*".$albumYear;

    
    while($row2= $findSongs->fetch_row()){
        $songid= $row2[0];
        
        $songInfo= $mysqli->query('SELECT songName, artistName FROM songs NATURAL JOIN
                                  artists NATURAL JOIN artistLink WHERE songid="'.$songid.'"');
        $song = $songInfo->fetch_assoc();
        $list = $list."*".$song['songName']."*".$song['artistName']."*".$songid;
        
    }
    
    mysqli_close($mysqli);
    
    echo($list);
?>