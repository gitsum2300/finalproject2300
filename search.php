<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<html>
<head>
    <title>Search for a Song!</title>
    <link type= "text/css" rel="stylesheet" href="css/style.css" />
    <script type="text/javascript" src="jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="searchscript.js"></script>
</head>
<body>
    <div class="left">
    <form action="searchHandler.php" method="post">

        <table>
        <tr>
            
            <td>
                <input id="search" type="text" name="searchtext" placeholder="Search by song name, artist, arranger, or concert."/>
            </td>
            <td>
                <input id="submit" type="submit" name="submit" value="SEARCH!" />
            </td>
        </tr>
        
        </table>
    </form>
    </div>    
    
    <?php
        include('adSearchForm.php');
        include('searchTable.php');
        include('slide/slideshow.html');
    ?>
    
</body>
</html>