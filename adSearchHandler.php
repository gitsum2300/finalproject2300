<?php
    if(isset($_GET['advSubmit'])){
        include('helperFunctions.php');
        startMysql();
        
        $finalArray = array();
        
        //Get all songid's initally and store them in an array
        $query = 'SELECT songid FROM songs ORDER BY songName';
        
        $results = $mysqli->query($query);
        while($song = $results -> fetch_row()){
            array_push($finalArray, $song[0]);
        }
        
        
        //check the title of the song
        if(!empty($_GET['adsongTitle'])){
            $search = $_GET['adsongTitle'];
            foreach($finalArray as $id => $value){
                $query = "SELECT songid FROM songs WHERE songName LIKE '%".$search."%' AND songid='".$value."'";
                $result = $mysqli->query($query);
                if(($result->num_rows) < 1){
                    unset($finalArray[$id]);
                }
            }
        }
        $finalArray = array_values($finalArray); 
        
        
        //check the arranger of the song
        if(!empty($_GET['adarranger'])){
            $search = $_GET['adarranger'];
            foreach($finalArray as $id => $value){
                $query = "SELECT songid FROM songs WHERE arranger LIKE '%".$search."%' AND songid='".$value."'";
                $result = $mysqli->query($query);
                if(($result->num_rows) < 1){
                    unset($finalArray[$id]);
                }
            }
        }
        $finalArray = array_values($finalArray);
        
        //check the artist of the song
        if(!empty($_GET['adartist'])){
            $search = $_GET['adartist'];
            foreach($finalArray as $id => $value){
                $query = "SELECT songid FROM songs NATURAL JOIN artistLink NATURAL JOIN artists WHERE artistName LIKE '%".$search."%' AND songid='".$value."'";
                $result = $mysqli->query($query);
                if(($result->num_rows) < 1){
                    unset($finalArray[$id]);
                }
            }
        }
        $finalArray = array_values($finalArray);
        
        //check the genre of the song
        if($_GET['adgenre'] != ""){
            $search = $_GET['adgenre'];
            foreach($finalArray as $id => $value){
                $query = "SELECT songid FROM songs WHERE genre='".$search."' AND songid='".$value."'";
                $result = $mysqli->query($query);
                if(($result->num_rows) < 1){
                    unset($finalArray[$id]);
                }
            }
        }
        $finalArray = array_values($finalArray);
        
        //check the album of the song
        if(!empty($_GET['adalbum'])){
            $search = $_GET['adalbum'];
            foreach($finalArray as $id => $value){
                $query = "SELECT songid FROM songs NATURAL JOIN albumLink NATURAL JOIN albums WHERE albumName  LIKE '%".$search."%' AND songid='".$value."'";
                $result = $mysqli->query($query);
                if(($result->num_rows) < 1){
                    unset($finalArray[$id]);
                }
            }
        }
        $finalArray = array_values($finalArray);

        //check the concert of the song
        if(!empty($_GET['adconcert'])){
            $search = $_GET['adconcert'];
            foreach($finalArray as $id => $value){
                $query = "SELECT songid FROM songs NATURAL JOIN concertLink NATURAL JOIN concerts WHERE concertName LIKE '%".$search."%' AND songid='".$value."'";
                $result = $mysqli->query($query);
                if(($result->num_rows) < 1){
                    unset($finalArray[$id]);
                }
            }
        }
        $finalArray = array_values($finalArray);
        
        //check the youtube link of the song
        if(isset($_GET['adyoutube'])){
            foreach($finalArray as $id => $value){
                $query = "SELECT songid FROM songs WHERE youtube <> '' AND songid='".$value."'";
                $result = $mysqli->query($query);
                if(($result->num_rows) < 1){
                    unset($finalArray[$id]);
                }
            }
        }
        $finalArray = array_values($finalArray);
        
        //check active or not
        if(!empty($_GET['adactive'])){
            foreach($finalArray as $id => $value){
                $query = "SELECT songid FROM songs WHERE active='yes' AND songid='".$value."'";
                $result = $mysqli->query($query);
                if(($result->num_rows) < 1){
                    unset($finalArray[$id]);
                }
            }
        }
        $finalArray = array_values($finalArray);
        
        
        //check if there is an mp3
        if(!empty($_GET['admp3'])){
            foreach($finalArray as $id => $value){
                $query = "SELECT songid FROM songs WHERE mp3='yes' AND songid='".$value."'";
                $result = $mysqli->query($query);
                if(($result->num_rows) < 1){
                    unset($finalArray[$id]);
                }
            }
        }
        $finalArray = array_values($finalArray);
        
        //check the key of the song
        if(($_GET['adkey'] != 'null') && ($_GET['adkey2'] != 'null')){
            $search = $_GET['adkey']." ".$_GET['adkey2'];
            print($search);
            foreach($finalArray as $id => $value){
                $query = "SELECT songid FROM songs WHERE keykey='".$search."' AND songid='".$value."'";
                $result = $mysqli->query($query);
                if(($result->num_rows) < 1){
                    unset($finalArray[$id]);
                }
            }
        }
        $finalArray = array_values($finalArray);
        
        
        //check the range of the song
        if(($_GET['adsoloRange'] != 'null') && ($_GET['adsoloRange2'] != 'null')){
            $search = $_GET['adsoloRange']." ".$_GET['adsoloRange2'];
            foreach($finalArray as $id => $value){
                $query = "SELECT songid FROM songs WHERE solorange='".$search."' AND songid='".$value."'";
                $result = $mysqli->query($query);
                if(($result->num_rows) < 1){
                    unset($finalArray[$id]);
                }
            }
        }
        $finalArray = array_values($finalArray);
        
        
        //Add everything to the session variable
        $results = array();
        for($i=0; $i<count($finalArray); $i++){
        $resultArray = array();
            $id = $finalArray[$i];
            $query = 'SELECT * FROM songs NATURAL JOIN artists NATURAL JOIN artistLink WHERE songid="'.$id.'"';
            $songinfo = $mysqli->query($query);
            
            $albumText= '';
            $concertText= '';
            $query2= 'SELECT albumName FROM songs NATURAL JOIN albumLink NATURAL JOIN albums
                    WHERE songid="'.$id.'"';
            $result2= $mysqli->query($query2);
            $query3= 'SELECT * FROM songs NATURAL JOIN concertLink NATURAL JOIN concerts
                    WHERE songid="'.$id.'"';
            $result3= $mysqli->query($query3);
            
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
            
            $data = $songinfo -> fetch_assoc();
            
                $resultArray['songid'] = $data['songid'];
                $resultArray['songName'] = $data['songName'];
                $resultArray['artistName'] = $data['artistName'];
                $resultArray['genre'] = $data['genre'];
                $resultArray['keykey'] = $data['keykey'];
                $resultArray['soloRange'] = $data['soloRange'];       
            
            $resultArray['albumName'] = $albumText;
            $resultArray['concertName'] = $concertText;
            
            
            $results[$i] = $resultArray;
    
       }
       
       //push the array to a session variable
            $_SESSION['sresults'] = array();
            $_SESSION['sresults'] = $results;
            
        
        mysqli_close($mysqli);
        require('index.php');
    }
    
   
 
    
    function checkArranger(){}
    function checkAlbum() {};
    function checkArtist() {};
    function checkConcert() {};
    function checkActive() {};
    function checkYoutubeLink() {};
    function checkMP3File() {};
    function checkGenre() {};
    function checkKey() {};
    function checkSolo() {};
?>