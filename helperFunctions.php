<?php
    //A set of helper functions
    
    //Loads the database into $mysqli
    function startMysql(){
        include 'password.php';
        global $mysqli;
        $mysqli = new mysqli("localhost", $username, $password, $dbname);
                        
        if($mysqli -> errno){
            print($mysqli->error);
            exit();
        }
    }
    
    function getSongs(){
        print('<tr>  
            <td>Add Song: </td><td><select id="albumSongNew" name="albumSongNew[]">
            <option value="null"></option>');
            $qu= 'SELECT songid, songName, artistName FROM songs NATURAL JOIN
                                    artistLink NATURAL JOIN artists';
                
            $query2= $mysqli->query($qu);
            for($j=1;$j<=$query2->num_rows;$j++){
                $row= $query2->fetch_assoc();
                print("<option value=\"$row[songid]\"/> $row[songName] -- $row[artistName]</option>");
            }
            
        print('</select></td></tr>');
    }
    
    //Does a regular expression check on username
    function checkUsername($user){
        if(!preg_match('/^[0-9a-zA-Z_]+$/', $user)){
            return false;
        }
    }
    
    
    //Checks all for search - song name, artist, arranger, mp3, youtube
    function checkAll($songName, $artist, $arranger, $mp3, $youtube){
        if(!(checkName($songName) && checkName($artist) && checkName($arranger) && checkmp3($mp3) && checkYoutube($youtube))){
            return false;
        }
    }
    
    //Check for validity in song name, artist, arranger.
    function checkName($name){
        if(!preg_match('/^[a-zA-Z0-9.,!? -\']+$/', $name)){
            return false;
        }
        else {
            return true;
        }
    }
    
    //Check mp3 validity
    function checkmp3($link){
        if(preg_match('/.mp3$/', $link)){
            return true;
        }
        else {
            return false;
        }
    }
    
    //Check pdf validity
    function checkpdf($link){
        if(preg_match('/.pdf$/', $link)){
            return true;
        }
        else {
            return false;
        }
    }
    
    //Check youtube link validity
    function checkYoutube($link){
        if(!preg_match('/youtube.com/', $link)){
            return false;
        }
        else {
            return true;
        }
    }
    
    //Similar checking functions for password,files, etc.
    
?>
    
    
    
    