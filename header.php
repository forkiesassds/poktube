<?php 
session_start(); 
include("db.php");
$datenow = date("Y-m-d");
if(isset($_SESSION["username"])) {
$username = htmlspecialchars($_SESSION["username"]);
$detail = mysqli_query($connect, "SELECT * FROM users WHERE username='". $username ."'"); // selects details of user
$detail2 = mysqli_fetch_assoc($detail); // function for getting details of user
if ($detail2["registeredon"] == null) {
	$stmt = $connect->prepare("UPDATE users SET registeredon = ? WHERE username = ?"); // prepares sql commands in prepared statement
	$stmt->bind_param("ss", $datenow, $username);
	$stmt->execute(); // this is to remove SQL injection, and to update the last online date.
}
}
?>
<head>
<link rel="stylesheet" href="main.css" type="text/css">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<meta name="theme-color" content="#5d42f4">
<meta name="description" content="Share your videos with friends and family">
<meta property="og:image" content="/poktube/img/logo.png">
<meta name="keywords" content="video,sharing,camera phone,video phone">
</head>
<table class="header1" width="100%" bgcolor="#E9E9E9" cellpadding="0" style="padding: 5px 0px 0px 0px;" cellspacing="0" border="0">
	<tr valign="top">
		<td width="130" rowspan="2" style="padding: 0px 5px 5px 5px;"><a href="index.php"><img src="img/logo.png" alt="PokTube" border="0"></a></td>
		<td valign="top">
		<table align="right" width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr valign="top">
			<td align="left" class="headertext" style="padding: 0px 5px 0px 5px; font-style: italic;">Upload, tag and share your videos worldwide!</td>
				<td align="right">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<?php if(isset($_SESSION["username"])) {
		echo "<td><b class='headertext'>Hello, <div style=\"font-size: 12px; font-weight: bold; float: right; padding: 0px 5px 0px 5px;\"><img src=\"content/profpic/" . $_SESSION["username"] . ".png\" onerror=\"this.src='img/profiledef.png'\" width=\"18\" height=\"18\"></div>".$username."</a></b></td>
		<td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a class='headertext' href='profile.php?user=" . $_SESSION["username"] ."'>My Profile</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a class='headertext' href='logout.php'>Log Out</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td style='padding-right: 5px;'><a class='headertext' href='help.php'>Help</a></td>";
	} else {
		echo "<td><a class='headertext' href='signup.php'><strong>Sign Up</strong></a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a class='headertext' href='login.php'>Log In</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td style='padding-right: 5px;'><a class='headertext' href='help.php'>Help</a></td>";
	}?>

				
			</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
	</tr>

		<tr>
		<td width="100%">
		
		<?php if(isset($_SESSION["username"])) {
		echo "<div style=\"font-size: 12px; font-weight: bold; float: right; padding: 10px 5px 0px 5px;\"><a href=\"my_videos_upload.php\"><img src=\"img/pic_upload_130x28.png\" alt=\"Upload Videos\"></a>";
		} else {
			echo "";}?>
		<!--&nbsp;//&nbsp; <a href="browse.php">Browse</a>--></div>
		
		<table cellpadding="2" cellspacing="0" border="0">
			<tr>
				<form method="GET" action="results.php">
				<td>
					<input type="text" value="" name="search" size="30" maxlength="128" style="color:#2746B5; font-size: 14px; padding: 2px;">
				</td>
				<td>
					<input type="submit" value="Search Videos">
					<span class="headertext">NOT IMPLEMENTED</span>
				</td>
				</form>
			</tr>
		</table>
		
		</td>
	</tr>

			
</table>
<table class="header2" align="center" width="100%" bgcolor="#adcded" cellpadding="0" cellspacing="0" border="0" style="margin: 0px 0px 10px 0px;">
	<tr>
		<td><img src="img/pixel.gif" width="1" height="5"></td>
	</tr>
	<tr>
		<td><img src="img/pixel.gif" width="5" height="1"></td>
		
		<td width="100%">

		<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td>
											<table cellpadding="2" cellspacing="0" border="0">
						<tr>
							<td>&nbsp;<a class="headertext" href="index.php">Home</a></td>
							<!--
							<td>&nbsp;|&nbsp;</td>
							<td><a href="my_videos.php">My Videos</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="my_favorites.php">My Favorites</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="my_friends.php">My Friends</a>&nbsp;<img src="img/new.gif"></td>
							-->
							<td>&nbsp;|&nbsp;</td>
							<td><a class="headertext" href="my_profile.php">Settings</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a class="headertext" href="browse.php">Browse</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a class="headertext" href="https://discord.gg/72ZPaTtXct">Discord</a></td>
						</tr>
						</table>
					</td>
				</tr>
			</table>
			
			</td>
	
		<td><img src="img/pixel.gif" width="5" height="1"></td>
	</tr>
	<tr>
		<td><img src="img/pixel.gif" width="1" height="5"></td>
	</tr>
</table>