<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<html>
<head>
    <title> Admin Page </title>
    <link href="main.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Boogaloo' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <h1>the<span>HANGOVERS</span></h1>
    <?php
        include 'nav.php';
    ?>
    <h2>Administrator Tools</h2>
    
    <?php
    if(isset($_SESSION['user']) && ($_SESSION['user'] == "member" || $_SESSION['user'] == "admin")){
    ?>
        <div id = "songForm">
        <h3>Song Upload</h3>
        <?php include("songUpload.php"); ?>
            </div>
            
            <div id = "songForm">
        <h3>Create an Album</h3>
        <?php include("albumUpload.php"); ?>
            </div>
            
            <div id = "songForm">
        <h3>Create a Concert</h3>
        <?php include("concertUpload.php"); ?>
            </div>
            
            <div id = "songForm">
        <h3>Edit an Album</h3>
        <?php include("albumEdit.php"); ?>
            </div>
            
            <div id = "songForm">
        <h3>Edit a Concert</h3>
        <?php include("concertEdit.php"); ?>
            </div>
    <?php
    }else{
        print("<h3>Please log in to make changes.</h3>");
    }
    ?>
</body>
</html>
    
    