<?php 
if(!isset($_SESSION)){
    session_start();
}
include("db.php");
include("uiFramework.php");
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
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="styles_yts1171492455.css" type="text/css">
<link rel="stylesheet" href="base_yts1170100257.css" type="text/css">
<link rel="stylesheet" href="base_all-vfl70436.css" type="text/css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" href="poktube_bootstrap_mod.css" type="text/css">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-header">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">squareBracket</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="\">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="browse.php">Videos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="browse.php">Channels</a>
        </li>
		<li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">QuickList</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="browse.php">Help</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Community
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">IRC</a></li>
            <li><a class="dropdown-item" href="#">Forums</a></li>
            <li><a class="dropdown-item" href="#">Discord</a></li>
          </ul>
        </li>
      </ul>
      <form method="GET" action="results.php" class="d-flex">
        <input type="text" value="" class="form-control me-2" name="search" type="text" value="" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="signup.php">Register</a>
            </li>
        </ul>
    </div>
  </div>
</nav>
<div class="container">
<?php 
if (isset($username)) {
	$data = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM users WHERE username ='".$username."'"));
	$contents = "";
	if ($data['isBanned'] == true AND $data['bannedUntil'] > time()) {
		$contents .= "squareBracket staff have banned you for the following reason: <b>"; if (!isset($data['banReason'])) { $contents .= "No reason specified"; } else { $contents .= $data['banReason']; } $contents .= "</b><br> Please contact the staff for a ban appeal."; if($data['bannedUntil'] != 18446744073709551615) { $contents .= " Or wait until you get unbaned on ".date('r', $data['bannedUntil']); }
		makeBox("Warning", "$contents");
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