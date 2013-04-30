<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<html>
<head>
    <title> Log In </title>
	<link href="main.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Boogaloo' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
	</head>

<body>
    <h1>the<span>HANGOVERS</span></h1>
	
	<?php include 'nav.php'; ?>
	<div id = "slick-login">
		<label for="username">username</label><input type="text" name="username" class="placeholder" placeholder="username">
		<label for="password">password</label><input type="password" name="password" class="placeholder" placeholder="password">
		<input type="submit" value="Log In">
	</div>
</body>
</html>