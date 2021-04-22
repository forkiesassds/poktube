<?php 
if(!isset($_SESSION)){
    session_start();
}
include("../../db.php"); //this is the db shit from parent directory, no duplicate files !!!
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
<!DOCTYPE html>
<html lang="en"><head>
<link rel="shortcut icon" href="https://i.r.worldssl.net/img/favicon.png" type="image/png">
<meta charset="utf-8">
<title>VidLii - Display Yourself</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="apple-touch-icon" href="https://i.r.worldssl.net/img/vl_app.png">
<meta name="description" content="Watch, upload and share your favorite videos with the entire world in an easy to use and friendly environment.">
<meta name="keywords" content="video, sharing, camera, upload, social, friends">
<meta property="og:site_name" content="VidLii">
<meta property="og:url" content="https://www.vidlii.com/">
<meta name="msapplication-tap-highlight" content="no">
<link rel="stylesheet" type="text/css" href="m.css">
<script src="main15.js"></script>
<script src="main3.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.4/jquery.rateyo.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<style>		.vlPlayer{position:relative;overflow:hidden;width:100%;height:100%}		.vlPlayer.error{display:table;table-layout:fixed;background:#000;text-align:center}		.vlPlayer.error>span{display:table-cell!important;vertical-align:middle;text-align:center;color:#fff;font-family:Arial;font-size:16px;width:70%}	</style><link id="vlPlayer2007css" rel="stylesheet" href="https://i.r.worldssl.net/vlPlayer/skins/2007HD/skin.css?23"></head>
<body style="visibility: visible;">
<div class="wrapper">
<header class="n_head">
<div class="pr_hd_wrapper">
<a href="/"><img src="img/logo6.png" alt="VidLii" title="VidLii - Display Yourself." id="hd_vidlii"></a>
<nav>
<ul>
<a href="/" id="pr_sel"><li>Home</li></a><a href="/videos"><li>Videos</li></a><a href="/channels"><li>Channels</li></a><a href="/community"><li>Community</li></a>
</ul>
</nav>
<nav id="sm_nav">
<a href="/register">Sign Up</a><a href="/help">Help</a><a href="/login">Sign In</a>
<div id="login_modal">
<form action="/login" method="POST">
<input type="password" class="search_bar" placeholder="Your Password" style="display:none">
<input type="text" name="v_username" class="search_bar" placeholder="Username/E-Mail">
<input type="password" name="5wt_password" class="search_bar" placeholder="Your Password">
<input type="hidden" name="S1Jb" value="5wtvS66">
<input type="hidden" name="381" value="67">
<input type="hidden" name="JbVO" value="tvSS166">
<input type="submit" name="submit_login" class="search_button" value="Sign In">
<div class="forgot_pass"><a href="/forgot_password">Forgot Password?</a></div>
</form>
</div>
</nav>
<div class="pr_hd_bar">
<form action="/results" method="GET">
<input type="search" name="q" class="search_bar" maxlength="256" autofocus="">
<select name="f">
<option>All</option>
<option value="1">Videos</option>
<option value="2">Members</option>
</select>
<input type="submit" class="search_button" value="Search">
</form>
<a href="/upload" class="yel_btn">Upload</a>
</div>
</div>
</header>