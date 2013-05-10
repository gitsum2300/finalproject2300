<?php
    include('helperFunctions.php');
    startMysql();
    $qu= 'SELECT songid, songName, artistName FROM songs NATURAL JOIN
                            artistLink NATURAL JOIN artists ORDER BY songName';
                
    $query2= $mysqli->query($qu);
    $list='';
    for($j=1;$j<=$query2->num_rows;$j++){
        $row= $query2->fetch_assoc();
        $list= $list.'*'.$row['songid'].'*'.$row['songName'].'*'.$row['artistName'];
    }
    mysqli_close($mysqli);
    echo($list);
?>