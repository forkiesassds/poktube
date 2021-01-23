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
  <?php 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    //echo $_SESSION['username'] . $_SESSION['username'] . "!";
	$txt1 = "Learn PHP";
	echo '<div class="hd_under2">
			<ul class="hd_nav2">
            <li><a href="my_profile.php" style="font-weight: bold">My Profile</a></li>
            <li> | </li>
            <li><a href="logout.php">Sign Off</a></li>
            <li> | </li>
            <li><a href="help.php">Help</a></li>
 </ul>
 </div>';
} else {
    echo '<div class="hd_under2">
			<ul class="hd_nav2">
            <li><a href="register.php" style="font-weight: bold">Sign Up</a></li>
            <li> | </li>
            <li><a href="login.php">Log In</a></li>
            <li> | </li>
            <li><a href="help.php">Help</a></li>
 </ul>
 </div>';
}
  ?>
      <div class="hd_under2_left">
        <a href="index.php"><img src="img/logo.png" alt="BitView"></a>
        <form action="/web/20171203210958/http://www.bitview.net/results.php" method="get">
            <input type="text" size="30" name="search" maxlength="128" class="search_box">
            <input type="submit" value="Search Videos">
        </form>
    </div>
	<br>
    <div class="hd_under2_right">
	        <a href="/web/20171203210958/http://www.bitview.net/my_videos_upload.php" style="font-weight:bold;font-size:13px">Upload Videos</a><div class="hd_under2_seperator">//</div><span style="font-size: 13px; font-weight: bold; padding: 4px 6px 4px 6px; background-color:#FFCC66"><a href="/web/20171203210958/http://www.bitview.net/videos.php">Browse Videos</a> <span style="color: #CC6600; font-size: 10px">NEW!</span></span>
</div>
	</tr>
</tbody></table></div>