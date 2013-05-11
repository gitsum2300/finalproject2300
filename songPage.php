<?php

?>

<html>
<head>
	<link href="main.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Boogaloo' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Gentium+Basic:400,700' rel='stylesheet' type='text/css'>
	<title>Song Information</title>
</head>

<body>
<h1>the<span>HANGOVERS</span></h1>
<?php
	include 'nav.php';
?>

<div id = "main">
	<div class = "mainBox">
		<!--<img src = "http://www.hangovers.com/albums/files/cover-lg.jpg" alt = "Album Cover" width = "200px">-->
		Title:	<br/>
		Artist: <br/>
		Other pertinant song information <br/>
	</div>

	<div class = "youTubeBox">
		<?php
		//php to call song information from database?
		//include('displaySong.php');
		?>
		youTube video
	</div>

	<div class = "infoBox">
		<?php
		//include('displaySong.php');
		?>
		another info box
	</div>

	<div class = "infoBox">
		<?php
		//include('displaySong.php');
		?>
		mp3 probs
	</div>

	<div class = "infoBox">
		<?php
		//include('displaySong.php');
		?>
		more song info
	</div>
</div>

</body>
</html>