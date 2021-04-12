<?php 
if(!isset($_SESSION)){
    session_start();
}
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
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="styles_yts1171492455.css" type="text/css">
<link rel="stylesheet" href="base_yts1170100257.css" type="text/css">
<link rel="stylesheet" href="base_all-vfl70436.css" type="text/css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="manifest" href="/manifest.webmanifest">
<script>
function dropdownOpen() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
    }
  }
}
</script>
<!--code taken from https://stackoverflow.com/a/62024831-->
<script src="https://cdn.jsdelivr.net/npm/js-cookie/dist/js.cookie.min.js"></script>
<script>
	// code to set the `color_scheme` cookie (which is retarded because it hard codes only two options. fix it.)
	var $color_scheme = Cookies.get("color_scheme");
	function get_color_scheme() {
		return (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) ? "dark" : "light";
    }
    function update_color_scheme() {
		Cookies.set("color_scheme", get_color_scheme());
	}
	// read & compare cookie `color-scheme`
	if ((typeof $color_scheme === "undefined") || (get_color_scheme() != $color_scheme))
		update_color_scheme();
	// detect changes and change the cookie
	if (window.matchMedia)
		window.matchMedia("(prefers-color-scheme: dark)").addListener( update_color_scheme );
</script>
<?php
$color_scheme = isset($_COOKIE["color_scheme"]) ? $_COOKIE["color_scheme"] : false;
if ($color_scheme === false) $color_scheme = 'light';  // fallback
if ($color_scheme == 'dark') {
	echo "<link rel='stylesheet' href='styles-dark.css'>";
}
if ($color_scheme == 'modern') {
	echo "<link rel='stylesheet' href='styles-modern.css'>";
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#f28900">
<meta name="description" content="Share your videos with friends and family">
<meta property="og:image" content="/img/icon.png">
<meta name="keywords" content="video,sharing,camera phone,video phone">
</head>
<table class="header1" width="960px" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		<td width="130" rowspan="1" style="padding: 0px 5px 5px 5px;"><a href="index.php"><img src="<?php
if ($color_scheme == 'dark') {
	echo "img/logo-dark.png";
} else {
	echo "img/logo.png";
}
?>" alt="squareBracket" border="0"></a></td>
		<td valign="top">
				<table width="40%" align="left" cellpadding="2" cellspacing="0" border="0">
			<tr>
				<form method="GET" action="results.php">
				<td>
					<input class="search_input" type="text" value="" name="search" size="30" maxlength="128">
				</td>
				<td>
					<input class="button" type="submit" value="Search">
				</td>
				</form>
			</tr>
		</table>
		<table style="margin-top: 4px;" align="right" width="50%" cellpadding="0" cellspacing="0" border="0">
			<tr valign="top">
				<td align="right">
				<table cellspacing="0" cellpadding="2" border="0">
					<tr>
						<?php if(isset($_SESSION["username"])) {
		echo "<div class='dropdown'>
  <b><a style='cursor: default;' onclick='dropdownOpen()'>$username</a></b>
  <div id='myDropdown' class='dropdown-content'>
    <a href='profile.php?user=$username'>My Profile</a>
    <a href='my_profile.php'>Settings</a>
  </div>
</div> | <a href='logout.php'>Logout</a>";
	} else {
		echo "<td><a  href='signup.php'><strong>Sign Up</strong></a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a  href='login.php'>Log In</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td style='padding-right: 5px;'><a  href='help.php'>Help</a></td>";
	}?>

				
			</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
	</tr>

		<tr>
	</tr>

			
</table>
<table class="header2" align="center" width="960px" bgcolor="#3C3C3C" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td><img src="img/pixel.gif" width="1" height="5"></td>
	</tr>
	<tr>
		<td><img src="img/pixel.gif" width="5" height="1"></td>
		
		<td width="100%">

		<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td>
											<table cellpadding="2" cellspacing="0" border="0" style="padding-top: 3px;">
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
							<td><a class="headertext" href="browse.php">Videos</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a class="headertext" href="members.php">Channels</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a class="headertext" href="quicklist.php">QuickList</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a class="headertext" href="chat.php">Chat</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a class="headertext" href="/forum/">Forums</a></td>
							<?php if(isset($_SESSION['username'])) {
								if($detail2["is_admin"] == 1) {
									echo "<td>&nbsp;|&nbsp;</td>
									<td><a class='headertext' href='admin.php'>Admin</a></td>";
								}
							}?>
									<?php if(isset($_SESSION["username"])) {
		echo "<div style=\"font-size: 12px; font-weight: bold; float: right; padding: 0px 5px 0px 5px;\"><a href='my_videos_upload.php' id='upload-button' class='action-button'>
					<span class='action-button-leftcap'></span>
					<span class='action-button-text'>Upload</span>
					<span class='action-button-rightcap'></span>
				</a></div>";
		} else {
			echo "";}?>
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
<div id="baseDiv" class="date-20090101 video-info">
<div id="masthead">
<?php 
if (isset($username)) {
	$data = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE username ='".$username."'"));
	if ($data['isBanned'] == true AND $data['bannedUntil'] > time()) {
		echo "<div class=\"headerRCBox\">
		<b class=\"rch\">
		<b class=\"rch1\"><b></b></b>
		<b class=\"rch2\"><b></b></b>
		<b class=\"rch3\"></b>
		<b class=\"rch4\"></b>
		<b class=\"rch5\"></b>
		</b> <div class=\"content\"><span class=\"headerTitle\">Warning</span></div></div><div class=\"contentBox\">
		squareBracket staff have banned you for the following reason: <b>"; if (!isset($data['banReason'])) { echo "No reason specified"; } else { echo $data['banReason']; } echo "</b><br> Please contact the staff for a ban appeal."; if($data['bannedUntil'] != 18446744073709551615) { echo " Or wait until you get unbaned on ".date('r', $data['bannedUntil']); }
		echo "</div>";
		include("footer.php");
		// Unset all of the session variables
		$_SESSION = array();
		 
		// Destroy the session.
		session_destroy();
		die();
	} else if ($data['isBanned'] == true AND $data['bannedUntil'] < time()) {
		$zero = 0;
		$empty = "";
		$stmt = $connect->prepare("UPDATE users SET isBanned=?, banReason=?, bannedUntil=? WHERE username=?");
		$stmt->bind_param("bsis", $zero, $empty, $zero, $username);
		$stmt->execute();
	}
}
?>