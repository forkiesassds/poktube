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
<link rel="stylesheet" href="base_all-vfl70436.css" type="text/css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<style>
body {
  background-color: #FA;
}
</style>
<meta name="theme-color" content="#f28900">
<meta name="description" content="Share your videos with friends and family">
<meta property="og:image" content="/img/icon.png">
<meta name="keywords" content="video,sharing,camera phone,video phone">
</head>
<table class="vibriwentuwu" id="dadminpanel" width="100%" bgcolor="#0049C7" cellpadding="0" style="padding: 5px 0px 0px 0px;" cellspacing="0" border="0">
	<tr valign="top">
		<td width="130" rowspan="2" style="padding: 0px 5px 5px 5px;"><a href="index.php"><img src="img/logo.png" alt="squareBracket" border="0"></a></td>
	</tr>

		<tr>
		<td width="100%">
		
		<?php
		echo "<div id='needsToBeBlack' style=\"font-size: 12px; font-weight: bold; float: right; padding: 1px 5px 0px 5px;\">" . date("F jS Y h:i:s A") . "</a>";
		?>
		<!--&nbsp;//&nbsp; <a href="browse.php">Browse</a>--></div>
		
		</td>
	</tr>

			
</table>
<table class="header2" id="dadminpanel" align="center" width="100%" bgcolor="#3C3C3C" cellpadding="0" cellspacing="0" border="0" style="margin: 0px 0px 10px 0px;">
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
							<td>&nbsp;<span class="headertext">Administrator Panel</span></td>
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