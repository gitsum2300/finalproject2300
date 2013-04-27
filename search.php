<?php
    session_start();
?>

<html>
<head>
    <title>Search for a Song!</title>
    <link type= "text/css" rel="stylesheet" href="css/style.css" />
</head>
<body>
    <form action="searchHandler.php" method="post">
        <input type="text" name="searchtext" placeholder="Enter Search"/>
        
        <!-- Dropdown that will allow user to pick what parameter to search by -->
        <select name="sortBy">
            <option value="songName">Song Name</option>
            <option value="artistName">Artist</option>
            <option value="arranger">Arranger</option>
            <option value="concertName">Concert</option>
        </select>
        
        <!-- Add a button that will hide/show the following options -->
        <input type="checkbox" name="options[]" value="active" />Active
        <input type="checkbox" name="options[]" value="hasYoutube" />Has Youtube Link?
        <input type="checkbox" name="options[]" value="hasMp3" />Has MP3?
        <select name="genre">
            <option value="" />-
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
        <?php //Other advanced options?? ?>
    </form>
    
    <?php
        //Will toggle the advanced search options
        function showAdvanced(){
            
            
        }
    ?>
</body>
</html>