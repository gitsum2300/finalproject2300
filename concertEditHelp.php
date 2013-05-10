<?php
    include('helperFunctions.php');
    startMysql();
    
    $concertid= $_GET['id'];
    
    $findName= $mysqli->query('SELECT concertName, concertYear FROM concerts WHERE concertid="'.$concertid.'"');
    $row= $findName->fetch_row();
    $concertName= $row[0];
    $concertYear= $row[1];

    $findSongs= $mysqli->query('SELECT songid FROM concertLink NATURAL JOIN songs WHERE concertid="'.$concertid.'" ORDER BY songName');
    $list="";
    $list = $concertName."*".$concertYear;

    
    while($row2= $findSongs->fetch_row()){
        $songid= $row2[0];
        
        $songInfo= $mysqli->query('SELECT songName, artistName FROM songs NATURAL JOIN
                                  artists NATURAL JOIN artistLink WHERE songid="'.$songid.'"
                                  ORDER BY songName');
        $song = $songInfo->fetch_assoc();
        $list = $list."*".$song['songName']."*".$song['artistName']."*".$songid;
        
    }
    
    mysqli_close($mysqli);
    
    echo($list);
?>