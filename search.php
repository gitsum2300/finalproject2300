<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<html>
<head>
    <title>Search for a Song!</title>
    <link type= "text/css" rel="stylesheet" href="css/style.css" />
    <link type= "text/css" rel="stylesheet" href="css/slidestyle.css" />
    <script type="text/javascript" src="jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="searchscript.js"></script>
</head>
<body>
    <div class="wrapperleft">
    <div class="qsearch">
    <h2>Quick Search</h2>
    <form action="searchHandler.php" method="post">

        <table>
        <tr>
            
            <td>
                <input id="search" type="text" name="searchtext" placeholder="Search by song name, artist, arranger, or concert."/>
            </td>
            <td>
                <input class="submit" type="submit" name="submit" value="SEARCH!" />
            </td>
        </tr>
        
        </table>
    </form>
    </div>
    
    <div class="stable">
    <?php
        include('searchTable.php');
    ?>
    </div>
    </div>
    
    <div class="wrapperright">
    <?php
        include('adSearchForm.php');
//        include('slide/slideshow.html');
    ?>
    </div>
</body>
</html>