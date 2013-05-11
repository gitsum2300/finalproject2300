
<?php
    if(!isset($_SESSION)){
        session_start();
    }
    
    session_destroy();
    session_start();
    $_SESSION{'message'} = "You have successfully logged out.";
    //Also unset all of the session variables
    header( 'Location: index.php' ) ;
?>