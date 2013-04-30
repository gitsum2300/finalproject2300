<?php

?>

<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Quicksand:700|Titillium+Web|Merriweather+Sans:800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Gentium+Basic:400,700' rel='stylesheet' type='text/css'>
	<title>Song Information</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
<h1>the<span>HANGOVERS</span></h1>
<?php
	include 'nav.php';
?>

<div id = "main">
<div id = "albumCover">
	<img src = "http://www.hangovers.com/albums/files/cover-lg.jpg" alt = "Album Cover" width = "200px">
</div>

<div id = "basicSongInfo">
	<?php
	//php to call song information from database?
	//include('displaySong.php');
	?>
	Title:	<br/>
	Artist: <br/>
	Other pertinant song information <br/>
</div>

<div id = "additionalSongInfo">
	<?php
	//include('displaySong.php');
	?>
	Other song info
</div>
</div>

</body>
</html>