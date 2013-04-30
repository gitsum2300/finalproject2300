<?php
if(!isset($_SESSION['user'])){
	?>
	<div id="nav">
	<ul>
		<li><a href="index.php"><span>Home</span></a></li>
		<li><a href="uploader.php"><span>Admin</span></a><li>
		<li><a href="settings.php"><span>Settings</span></a><li>
		<li><a href="logout.php"><span>Logout</span></a><li>
	<ul>
	</div>
	<?php
} else{
	?>
	<div id="nav">
	<ul>
		<li><a href="index.php"><span>Home</span></a></li>
		<li><a href="uploader.php"><span>Admin</span></a><li>
		<li><a href="settings.php"><span>Settings</span></a><li>
		<li><a href="login.php"><span>Login</span></a><li>
	<ul>
	</div>
	<?php
}
?>