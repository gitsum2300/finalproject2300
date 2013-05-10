<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_POST['username']) && isset($_POST['password']) && preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username']) && preg_match('/^[a-zA-Z0-9_]+$/', $_POST['password'])){
        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);
        
        include('helperFunctions.php');
        startMysql();
        
        $query = "SELECT * from logins WHERE username ='".$username."' AND password ='".$password."'";
        $result = $mysqli->query($query);
        
        if($result ->num_rows == 1){
            $_SESSION['user'] = $username;
            $_SESSION['message'] = "You have successfully logged in.";
        }else{
            $_SESSION['message'] = "Username/password combination is invalid.";
        }
        
        require('index.php');
        print($_SESSION['message']);
    }else{
        $_SESSION['message'] = "Username/password combination is invalid";
        require('index.php');
        print($_SESSION['message']);
        
    }
?>