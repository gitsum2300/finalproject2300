<?php
if(isset($_SESSION['user'])){
	?>
	<div id="nav">
	<ul>
		<li><a href="index.php"><span>Home</span></a></li>
		<li><a href="uploader.php"><span>Admin</span></a><li>
                
                <?php
                if ($_SESSION['user'] == "admin"){
                ?>
                    <li><a href="settings.php"><span>Settings</span></a><li>
                <?php
                }
                ?>
                
                <li><a href="logout.php"><span>Logout</span></a><li>
                <?php
                if ($_SESSION['user'] == "admin"){
                ?>
                    <li>&nbsp;&nbsp;Welcome, Administrator!</li>
                <?php
                }else{
                    print("<li>&nbsp;&nbsp;Welcome, Member!</li>");
                }
                ?>
	<ul>
	</div>
	<?php
} else{
	?>
	<div id="nav">
	<ul>
		<li><a href="index.php"><span>Home</span></a></li>
		<li><a href="login.php"><span>Login</span></a><li>
                <li>&nbsp;&nbsp;Welcome, Guest!</li>
	<ul>
	</div>
	<?php
}
?>