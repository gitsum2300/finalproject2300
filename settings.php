<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<html>
<head>
    <title> Settings Page </title>
    <link href="main.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Boogaloo' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
    <h1>the<span>HANGOVERS</span></h1>
    <?php
        include 'nav.php';
    ?>
    <h2>Settings</h2>
    
    <?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == "admin"){
    ?>
	<div id = "songForm">
    <h3>Change Password</h3>
	<form action="settingsHandler.php" method="post">
        <table>
        <tr>
	<td>Account: </td>
	<td><select name="username" required>
            <option value="admin"/>Admin
            <option value="member" />Member
        </td>
        
	</tr>
	<tr>
	<td>Current Password: </td>
	<td><input name="oldpassword" type="password" required></td>
	</tr>
	<tr>
	<td>New Password: </td>
	<td><input name="newpassword" type="password" required></td>
	</tr>
	<tr>
	<td>Reenter Password: </td>
	<td><input name="newpasswordcheck" type="password" required></td>
	</tr>
        <tr>
            <td><input type="submit" name="settingsSubmit" value="Submit" /></td>
        </tr>
	</table>
	</form>
        
	</div>
        <div id="settingsMessage">
            <?php
                if(isset($_SESSION['settingsMessage'])){
                    print($_SESSION['settingsMessage']);
                    unset($_SESSION['settingsMessage']);
                }
            ?>
        </div>
    <?php
    }
    else{
        print("<h3>Sorry, but you must be an admin to change account information.</h3>");
    }
    ?>
</body>
</html>
    
    