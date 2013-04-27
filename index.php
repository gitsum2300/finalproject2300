<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<html>
<head>
    <title> The Hangovers - Song Repertoire </title>
    <link type= "text/css" rel="stylesheet" href="css/style.css" />
</head>
<body>
    <?php

        if(!isset($_SESSION['user'])){
            include("userlogin.php"); //Login form for the user - create this page
        }else{
            include("searchpage.php"); //Search page for the database - create this page
        }
        
        //If user is an admin, show links for the upload pages
        if($_SESSION['user'] == admin){
    ?>
            <a href="songUpload.php">Upload a Song</a>
            <a href="albumUpload.php">Upload an Album</a>
            <a href="concertUpload.php">Upload a Concert</a>
        }
        
    <?php
        include("footer.php"); //Website footer - create this page
    ?>

</body>
</html>
   