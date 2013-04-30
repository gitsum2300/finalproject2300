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
	
	<div id = "songForm">
    <h3>Change Password</h3>
	<table>
    <tr>
	<td>Username: </td>
	<td><input type="text" name="username" required></td>
	</tr>
	<tr>
	<td>Current Password: </td>
	<td><input type="text" name="password" required></td>
	</tr>
	<tr>
	<td>New Password: </td>
	<td><input type="text" name="newpassword" required></td>
	</tr>
	<tr>
	<td>Reenter Password: </td>
	<td><input type="text" name="newpasswordcheck" required></td>
	</tr>
	</table>
	
	</div>
    	    
</body>
</html>
    
    