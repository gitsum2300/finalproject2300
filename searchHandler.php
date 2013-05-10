<?php
    session_start();
    
    if(!empty($_POST['searchtext'])){
        $search = strip_tags($_POST['searchtext']);
        
        include('helperFunctions.php');
        startMysql();
        
        /*$query = "SELECT * FROM songs WHERE songName LIKE %'".$search."'% OR albumName LIKE %'".$search."'% OR concertName LIKE %'".$search."'%'";*/
       
       /*
        $stmt = $mysqli -> stmt_init();
        if($stmt -> prepare($query)){
            $stmt -> bind_param('sss', $search, $search, $search);
            $stmt -> execute();
        }
        */
       
       $searchArray = array();
       
       $query = "SELECT songid FROM songs NATURAL JOIN artistLink NATURAL JOIN artists WHERE songName LIKE '%".$search."%' OR artistName LIKE '%".$search."%' OR genre LIKE '%".$search."%' OR keykey LIKE '%".$search."%' OR soloRange LIKE '%".$search."%' ";
       $query2 = "SELECT songid FROM albumLink NATURAL JOIN albums WHERE albumName LIKE '%".$search."%'";
       $query3 = "SELECT songid FROM concertLink NATURAL JOIN concerts WHERE concertName LIKE '%".$search."%'";
       
       $result = $mysqli->query($query);
       $result2 = $mysqli->query($query2);
       $result3 = $mysqli->query($query3);
       

       while($id = $result-> fetch_row()){
            array_push($searchArray, $id[0]); 
       }
       while($id = $result2-> fetch_row()){
            array_push($searchArray, $id[0]); 
       }
       while($id = $result3-> fetch_row()){
            array_push($searchArray, $id[0]); 
       }
       
       $sArray = array_unique($searchArray);
       
       $results = array();
       for($i=0; $i<count($sArray); $i++){
        $resultArray = array();
            $id = $sArray[$i];
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
       
       
       /*
       $query = "SELECT * FROM songs NATURAL JOIN artistLink NATURAL JOIN artists WHERE preg songname ORDER BY songName";
       
        
       $result = $mysqli->query($query);
        for($i = 0; $i<$result->num_rows; $i++){
            $row = $result->fetch_assoc();
            
            //get the albums and the concerts for each song (if applicable)
            $albumText= '';
            $concertText= '';
            $query2= 'SELECT albumName FROM songs NATURAL JOIN albumLink NATURAL JOIN albums
                    WHERE songid="'.$row['songid'].'"';
            $result2= $mysqli->query($query2);
            $query3= 'SELECT * FROM songs NATURAL JOIN concertLink NATURAL JOIN concerts
                    WHERE songid="'.$row['songid'].'"';
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
        
        
            $_SESSION['sresults'][$i] = $row;
            array_push($_SESSION['sresults'][$i], $albumText);
            array_push($_SESSION['sresults'][$i], $concertText);
        }
       
       
        */
        mysqli_close($mysqli); 
        require('index.php');
    }
        ?>
        <a href="index.php">New Search</a>
        <?php
    
?>

