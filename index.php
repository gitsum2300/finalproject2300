<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<html>
<head>
    <title> The Hangovers - Song Repertoire </title>
    <link href="main.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Boogaloo' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <?php
    $_SESSION['user'] = "admin";  //REMOVE THIS - DEMO ONLY
    ?>
    <h1>the<span>HANGOVERS</span></h1>
    <?php include 'nav.php'; ?>
    <?php

        if(!isset($_SESSION['user'])){
           // include("login.php"); //Login form for the user - create this page
        }else{
            include("search.php"); //Search page for the database - create this page
        }
        
        //If user is an admin, show links for the upload pages
        if($_SESSION['user'] == "admin"){
            
        }
        //include("footer.php"); //Website footer - create this page
    ?>

</body>
</html>