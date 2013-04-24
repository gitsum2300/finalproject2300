<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<html>
<head>
    <title> The Hangovers - Song Repertoire </title>
    <link /> <!-- link to css pge here -->
</head>
<body>
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
   