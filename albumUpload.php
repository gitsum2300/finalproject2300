<form id="albumUpload" method="post">
    
    Album Title: <input type="text" name="albumName">
    <?php
    //search for songs
        startMysql();
        
        $query = "SELECT * FROM songs";
        $result = $mysqli->query($query);
        $songs = $result->fetch_assoc();
        
        close($mysqli);
    ?>
    
    <form>
        <input type="text" name="albumName" placeholder="Album Name..." />
        
        <label>Release Year: </label><select name="releaseYear">
        <?php
            $year= date('Y');
            for($j=$year;$j>=1960;$j--){
                print("<option value=\"$j\"> $j</option>");
            }
        ?>
        </select></br>
        
        <input type="text" name="songSearch" placeholder="Find a song..." onKeyUp="checkMatch(this.text);"/> 
        <input type="submit" name="submit" value="submit" />
    </form>
    
    <?php
        //Checks for a match with local array
        function checkMatch($searchtext){
            $matched = array();
            
            //check each song for a match in one of its fields - highlight matching part w/ javascript?
            foreach($songs as $song){
                foreach($song as $attr){
                    if(pos($attr, $searchtext) != FALSE){
                        array_push($matched, $song);
                    }
                }
            }
            
            //results frame - populate it with javascript, then make it visible
            
            
            generateResults($matched); //a javascript function
        }
        
    ?>  

    ?>
</form>