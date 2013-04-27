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
        if(!preg_match('/^[0-9a-zA-Z_]$', $user)){
            return false;
        }
    }
    
    //Similar checking functions for password,files, etc.
    
?>
    
    
    
    