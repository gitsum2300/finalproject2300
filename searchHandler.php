<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<html>
<head>
    <title> The Hangovers - Song Repertoire </title>
    <link href="main.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Boogaloo' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
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