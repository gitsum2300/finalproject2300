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
    
    //Does a regular expression check on username
    function checkUsername($user){
        if(!preg_match('/^[0-9a-zA-Z_]$/', $user)){
            return false;
        }
    }
    
    //Check for validity in song name, artist, arranger.
    function checkName($name){
        if(!preg_match('/^[a-zA-Z.!? -]$/', $name)){
            return false;
        }
        else {
            return true;
        }
    }
    
    //Check youtube link validity
    function checkYoutube($link){
        if(!preg_match('/[youtube.com]/', $link)){
            return false;
        }
        else {
            return true;
        }
    }
    
    //Similar checking functions for password,files, etc.
    
?>
    
    
    
    