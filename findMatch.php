<?php
    include('helperFunctions.php');
    startMysql();
    
    //Find all instances in the songs database that match current user input
    $array = array();
    $request = "SELECT song, artist, FROM songs WHERE songName REGEXP '^".$_GET['searchterm']."'";
    
    //Store all of the search results in $array
    //Print array to json
?>