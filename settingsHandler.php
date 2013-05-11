<?php

    if(!isset($_SESSION)){
        session_start();
    }
    
    if(isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['newpasswordcheck'])
        && preg_match('/^[a-zA-Z0-9_]+$/', $_POST['oldpassword']) && preg_match('/^[a-zA-Z0-9_]+$/', $_POST['newpassword'])
        && preg_match('/^[a-zA-Z0-9_]+$/', $_POST['newpasswordcheck'])){
        
        $oldp = strip_tags($_POST['oldpassword']);
        $newp = strip_tags($_POST['newpassword']);
        $newpc = strip_tags($_POST['newpasswordcheck']);
        
        include('helperFunctions.php');
        startMysql();
        
        $query = "SELECT * FROM logins WHERE username ='". $_POST['username']."'AND password ='".$oldp."'";
        $result = $mysqli->query($query);
        
        if($result->num_rows == 1){
            if($newp == $newpc){
                $query2 = "UPDATE logins SET password ='".$newp."' WHERE username ='".$_POST['username']."'";
                $results2 = $mysqli->query($query2);
                $_SESSION['settingsMessage'] = "Password successfully changed.";
                require('settings.php');
            }else{
                $_SESSION['settingsMessage'] = "Passwords must match";
                require('settings.php');
            }
        }else{
            $_SESSION['settingsMessage'] = "Current password entered incorrectly.";
            require('settings.php');
        }
        mysqli_close($mysqli);
    }else{
        $_SESSION['settingsMessage'] = "Please enter the current password and the desired password.";
        require('settings.php');
    }
    
    
?>