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
    <div class="wrapper">
    <div class="left">
        <form action="searchHandler.php" method="post">

        <table>
        <tr>
            <td>
            <!-- Dropdown that will allow user to pick what parameter to search by -->
                <select id="sortBy" name="sortBy">
                <option value="songName">Song Name</option>
                <option value="artistName">Artist</option>
                <option value="arranger">Arranger</option>
                <option value="concertName">Concert</option>
                </select>
            </td>
            <td>
                <input id="search" type="text" name="searchtext" placeholder="Search by song name, artist, arranger, or concert."/>
            </td>
            <td>
                <input id="submit" type="submit" name="submit" value="SEARCH!" />
            </td>
        </tr>
        </table>
    </div>

    <div class="right">
        <h2>Advanced Search</h2>
        <!-- Add a button that will hide/show the following options -->
        <table>
        <tr>
        <td>
            <input type="checkbox" name="options[]" value="active" />Active
        </td>
        <td>
            <input type="checkbox" name="options[]" value="hasYoutube" />Youtube Link?
        </td>
        <td>
            <input type="checkbox" name="options[]" value="hasMp3" />MP3?
        </td>
        <td>
        <select name="genre">
        <option value="" />-TBD-

        <?php
        include('helperFunctions.php');
        startMysql();
        $query = "SELECT DISTINCT genre FROM songs";
        $result = $mysqli->query($query);
        while($genre = $result->fetch_row()){
            print("<option value=\"$genre[0]\" />$genre[0]");
        }
        mysqli_close($mysqli);
        ?>
        </select>
        </td>
        </tr>
        <tr>
            <td></td><td></td><td></td>
        <td>
            <input id="advsubmit" type="advsubmit" name="advsubmit" value="SEARCH!" />
        </td>
        </tr>
        </table>

        <?php //Other advanced options?? ?>
        </form>
    </div>
    </div>
    
    <?php
        //Will toggle the advanced search options
        function showAdvanced(){
            
            
        }
    ?>
</body>
</html>