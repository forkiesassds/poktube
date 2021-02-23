<?php 
session_start(); 
include("db.php");
$datenow = date("Y-m-d");
if(isset($_SESSION["username"])) {
$username = htmlspecialchars($_SESSION["username"]);
$detail = mysqli_query($connect, "SELECT * FROM users WHERE username='". $username ."'"); // selects details of user
$detail2 = mysqli_fetch_assoc($detail); // function for getting details of user
$isAdmin = $detail2['is_admin'];
if ($detail2["registeredon"] == null) {
	$stmt = $connect->prepare("UPDATE users SET registeredon = ? WHERE username = ?"); // prepares sql commands in prepared statement
	$stmt->bind_param("ss", $datenow, $username);
	$stmt->execute(); // this is to remove SQL injection, and to update the last online date.
}
}
?>
<head>
<link rel="stylesheet" type="text/css" href="assets/components/menu.css">
<link rel="stylesheet" type="text/css" href="assets/components/image.css">
<link rel="stylesheet" type="text/css" href="assets/components/transition.css">
<link rel="stylesheet" type="text/css" href="assets/semantic.twitter.min.css">
<script src="assets/jquery-3.5.1.min.js"></script>
<script src="assets/semantic.min.js"></script>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<meta name="theme-color" content="#f28900">
<meta name="description" content="Share your videos with friends and family">
<meta property="og:image" content="/img/icon.png">
<meta name="keywords" content="video,sharing,camera phone,video phone">
</head>
<!---- header start ----->
<div class="ui menu inverted">
	<div class="item"><img src="img/logo.png" alt="PokTube" border="0" style="scale: 5.5;margin-right: 78px;padding-left: 13px;"></img></div>
	<a href="index.php" class="item">Home</a>
	<a href="browse.php" class="item">Videos</a>
	<a href="https://discord.gg/72ZPaTtXct" class="item">Discord</a>
	<div class="right menu"></div>
	<div class="header item">
		<form method="GET" action="results.php" style="padding: unset;margin: unset;">
			<div class="ui transparent inverted icon input">
				<i class="search icon"></i>
				<input type="text" name="search" value="" placeholder="Search">
			</div>
		</form>
	</div>
		<?php if(isset($_SESSION["username"])) {
		echo "
<a href='profile.php?user=" . $_SESSION["username"] ."' class=\"item\">" . $_SESSION["username"] . "</a>
<a href='my_videos_upload.php' class=\"item\">Upload</a>
<a href='my_profile.php' class=\"item\">Settings</a>
<a href='logout.php' class=\"item\">Log Out</a>
<a href='help.php' class=\"item\">Help</a>
";
if($isAdmin == 1)
{
echo "<a href='admin.php' class=\"item\">Admin</a>";
}
else
{
    echo "";
}
	} else {
		echo "
<a href='signup.php' class=\"item\"><strong>Sign Up</strong></a>
<a href='login.php' class=\"item\">Log In</a>
<a href='help.php' class=\"item\">Help</a>
	";}?>
</div>
<!---- header end ----->
<div>