<?php
    session_start();
?>

<html>
<head>
    <title>Songs</title>
    <link type= "text/css" rel="stylesheet" href="css/style.css" />
</head>
<body>
    <?php
        include('helperFunctions.php');
        
        //This page will be called with songid as a GET variable
        startMysql();
        
        //Prepared MySQL query to obtain all of the song's information
        $query = "SELECT * FROM songs WHERE songid = ?";
        $stmt = $mysqli->stmt_init();
        if($stmt->prepare($query)){
            $stmt->bind_param('i', $_GET['songid']);
            $stmt->execute();
        }
        
        $song = $stmt->fetch_assoc();  //Turn the database result into an array
        
        //Print out the song name
        //Print out album(s) the song was in
        //Print out the artist(s)
        //Print out the structure
        //Print out the syllables
        //Print out the arranger
        //Print out the genre
        //Print out the quality
        //Print out whether the song is active or not
        //Print the youtube link (if it exists)
        //Print out the key
        //Print out the solo range
        
        //Embed the mp3 (if it exists)
        //Embed the Finale/PDF file (if it exists)
        
        close($mysqli);
    ?>
</body>
</html>