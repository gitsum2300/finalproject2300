<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="searchTable.js"></script>


<table border="1" id="searchTable">
    <tr bgcolor="#FFFFFF" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
        <th>Song ID</th>
        <th>Song</th>
        <th>Artist</th>
        <th>Genre</th>
        <th>Albums</th>
        <th>Concerts</th>
        <th>Key</th>
        <th>Solo Range</th>
    </tr>
    
    <?php
        include_once('helperFunctions.php');
        startMysql();
        
        //Get all songs from the database
        
        /*$query = "SELECT *, GROUP_CONCAT(DISTINCT albumName), GROUP_CONCAT(DISTINCT artistName),
        GROUP_CONCAT(DISTINCT concertName) FROM songs NATURAL JOIN artistLink NATURAL JOIN artists
        NATURAL JOIN albums NATURAL JOIN albumLink NATURAL JOIN concerts NATURAL JOIN concertLink GROUP BY songid";*/
        
        $query = "SELECT * FROM songs NATURAL JOIN artistLink NATURAL JOIN artists ORDER BY songName";
        $result = $mysqli->query($query);
        //Add some sort of method to restrict the number of rows on screen at any time
        
        //Print table
        if(isset($_SESSION['sresults'])){
            $sresults = $_SESSION['sresults'];            
            
            for($i = 0; $i<count($sresults); $i++){
                print("<tr bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='gold';\" onMouseOut=\"this.bgColor='#FFFFFF';\">");
                //Add the info from fow for song, artist, album, genre, etc.
                    print("<td>".$sresults[$i]['songid']. "</td>");
                    print("<td><a href=\"songPage.php?songid=".$sresults[$i]['songid']."\"</a>".$sresults[$i]['songName']. "</td>");
                    print("<td>".$sresults[$i]['artistName']. "</td>");
                    print("<td>".$sresults[$i]['genre']. "</td>");
                    print("<td>".$sresults[$i]['albumName']."</td>");
                    print("<td>".$sresults[$i]['concertName']."</td>");
                    print("<td>".$sresults[$i]['keykey']. "</td>");
                    print("<td>".$sresults[$i]['soloRange']. "</td>");
                print("</tr>");
            }
            unset($_SESSION['sresults']);
        }else{
            while($row = $result->fetch_assoc()){
                print("<tr bgcolor=\"#FFFFFF\" onMouseOver=\"this.bgColor='gold';\" onMouseOut=\"this.bgColor='#FFFFFF';\">");
                $query2= 'SELECT albumName FROM songs NATURAL JOIN albumLink NATURAL JOIN albums
                WHERE songid="'.$row['songid'].'"';
                $result2= $mysqli->query($query2);
                $query3= 'SELECT * FROM songs NATURAL JOIN concertLink NATURAL JOIN concerts
                WHERE songid="'.$row['songid'].'"';
                $result3= $mysqli->query($query3);
                //Add the info from row for song, artist, album, genre, etc.
                $albumText= '';
                $concertText= '';
                    if($result2->num_rows>=1){
                        while($row2 = $result2->fetch_assoc()){
                            $albumText= $albumText.$row2['albumName'].', ';
                        }
                        $albumTextLength= strlen($albumText); 
                        $albumText= substr($albumText,0,$albumTextLength-2);
                    }
                    if($result3->num_rows>=1){
                        while($row3 = $result3->fetch_assoc()){
                            $concertText= $concertText.$row3['concertName'].', ';
                        }
                        $concertTextLength= strlen($concertText); 
                        $concertText= substr($concertText,0,$concertTextLength-2);
                    }
                    print("<td>".$row['songid']. "</td>");
                    print("<td><a href=\"songPage.php?songid=".$row['songid']."\"</a>".$row['songName']."</td>");
                    print("<td>".$row['artistName']. "</td>");
                    print("<td>".$row['genre']. "</td>");
                    print("<td>".$albumText."</td>");
                    print("<td>".$concertText."</td>");
                    print("<td>".$row['keykey']. "</td>");
                    print("<td>".$row['soloRange']. "</td>");
                print("</tr>");
            }
        }
        
        mysqli_close($mysqli);
    ?>
</table>