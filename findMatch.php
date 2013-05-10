<?php
    include('helperFunctions.php');
    startMysql();
    
    //Find all instances in the songs database in song, artist, or album that match current user input
    $entities = array("song", "artist", "album", "concert");
    
    for($i=0; $i<count($entities); $i++){
        //If there is an album match, return the id and name of the album - ditto for song and artist
        $request = "SELECT ".$entities[$i]."id, ".$entities[$i]."name FROM songs NATURAL JOIN albums NATURAL JOIN artists WHERE ".$entities[$i]."Name REGEXP '^".$_GET['searchterm']."'";
        $result = $mysqli->query($request);
        
        //Add results to an array
        if ($result->num_rows > 0) {
            while($res = $result->fetch_row()){
                $res = array_push($res, $i); //Pushes a category identifier onto each row (song, artist, or album)
                array_push($array, $res);		
            }
        }
    }
    
    
    //Print array to json
    print(json_encode($array));
?>