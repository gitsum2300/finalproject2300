<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<html>
<head>
    <title> The Hangovers - Song Repertoire </title>
    <link href="main.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Gentium+Basic:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <h1>the<span>HANGOVERS</span></h1>
    <?php
        include('upload.php');
    
    /*
        if(!isset($_SESSION['user'])){
            include("userlogin.php"); //create this page
        }else{
            include("searchpage.php"); //create this page
        }
        
        include("footer.php"); //create this page
        */
    ?>
</body>
</html>
   