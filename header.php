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
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="styles_yts1171492455.css" type="text/css">
<link rel="stylesheet" href="base_yts1170100257.css" type="text/css">
<link rel="stylesheet" href="base_all-vfl70436.css" type="text/css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="manifest" href="/manifest.webmanifest">
<script>
/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
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
<div class="header_holder">
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
						<?php if(isset($_SESSION["username"])) {
		echo "<p class='headertext'>$username</p>
  <a class='headertext' href='profile.php?user=$username'><i class='ri-user-smile-fill'></i>My channel</a>
  <a class='headertext' href='my_profile.php'><i class='ri-list-settings-fill'></i>Settings</a>
  <a class='headertext' href='logout.php'><i class='ri-logout-box-fill'></i>Logout</a>";
	} else {
		echo "<p class='headertext'><i class='ri-error-warning-line'></i>Not logged in</p>
		<a class='headertext' href='signup.php'><i class='ri-key-2-fill'></i>Sign Up</a>
<a class='headertext' href='login.php'><i class='ri-login-box-fill'></i>Log In</a>";
	}?>
  <br>
  <a class="headertext" href="index.php"><i class="ri-home-2-fill"></i>Home</a>
  <a class="headertext" href="browse.php"><i class="ri-film-fill"></i>Videos</a>
  <a class="headertext" href="members.php"><i class="ri-user-fill"></i>Channels</a>
  <a class="headertext" href="quicklist.php"><i class="ri-booklet-fill"></i>QuickList</a>
  <a class='headertext' href='help.php'><i class="ri-question-fill"></i>Help</a>
  <a class="headertext" href="chat.php"><i class="ri-chat-4-fill"></i>Chat</a>
  <a class="headertext" href="https://squarebracket.me/forum"><i class="ri-question-answer-fill"></i>Forums</a>
  									<?php if(isset($_SESSION["username"])) {
		echo "<a class='headertext' href='my_videos_upload.php'><i class='ri-video-upload-fill'></i>Upload</a>";
		} else {
			echo "";}?>
  <?php if(isset($_SESSION['username'])) {
								if($detail2["is_admin"] == 1) {
									echo "<br><a class='headertext' href='admin.php'><i class='ri-admin-fill'></i>Admin</a>";
								}
  }?>
</div>
<div class="header1">
<div id="main">
  <button class="openbtn" onclick="openNav()"><i class="ri-menu-line"></i></button>
</div>
<img src="<?php
if ($color_scheme == 'dark') {
	echo "img/logo-dark.png";
} else {
	echo "img/logo.png";
}
?>" alt="squareBracket" border="0"></a></td>
				<form class="header-left-search" method="GET" action="results.php">
				<td>
					<input class="search_input" type="text" value="" name="search" size="30" maxlength="128">
				</td>
				<td>
					<input class="button" type="submit" value="Search">
				</td>
				</form>
</div></div>
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