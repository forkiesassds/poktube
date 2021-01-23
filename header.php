<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#D5E5F5" align="center">
<div class="hd">
    <ul class="hd_nav">
        <li><a href="index.php" style="font-weight: bold">Home</a></li>
        <li> | </li>
                <li><a href="my_videos.php">My Videos</a></li>
        <li> | </li>
        <li><a href="my_favorites.php">My Favorites</a></li>
        <li> | </li>
        <li><a href="my_messages.php">My Messages</a></li>
        <li> | </li>
        <li><a href="my_profile.php">My Profile</a></li>
    </ul>
</div>
<div class="tableLinkBar">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tbody><tr>
	
		<?php
session_start(); // Right at the top of your script
?>
<div class="hd_under">
  <?php 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    //echo $_SESSION['username'] . $_SESSION['username'] . "!";
	$txt1 = "Learn PHP";
	echo '<ul class="hd_nav">
            <li><a href="my_profile.php" style="font-weight: bold">My Profile</a></li>
            <li> | </li>
            <li><a href="logout.php">Sign Off</a></li>
            <li> | </li>
            <li><a href="help.php">Help</a></li>
 </ul>';
} else {
    echo '<ul class="hd_nav">
            <li><a href="register.php" style="font-weight: bold">Sign Up</a></li>
            <li> | </li>
            <li><a href="login.php">Log In</a></li>
            <li> | </li>
            <li><a href="help.php">Help</a></li>
 </ul>';
}
  ?>
</div>
	</tr>
</tbody></table></div>