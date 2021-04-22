<html>
<?php 
include("header.php"); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php 
if(isset($_GET["vexist"])) {
if(($_GET["vexist"]) == 0){
	echo "<table class=\"alert\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"#f44336\">
			<tr>
				<td><img src=\"img/box_login_tl.gif\" width=\"5\" height=\"5\"></td>
				<td width=\"100%\"><img src=\"img/pixel.gif\" width=\"1\" height=\"5\"></td>
				<td><img src=\"img/box_login_tr.gif\" width=\"5\" height=\"5\"></td>
			</tr>
			<tr>
				<td><img src=\"img/pixel.gif\" width=\"5\" height=\"1\"></td>
				<td>
				<img style=\"float: left; margin: 0px 12px 0px 0px; padding: 2px 0px 0px 0px;\" src=\"img/error.png\"><p>This video does not exist!</p></div>
					<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
					</tr>
				</table>
				
				</td>
				<td><img src=\"img/pixel.gif\" width=\"5\" height=\"1\"></td>
			</tr>
			<tr>
				<td><img src=\"img/box_login_bl.gif\" width=\"5\" height=\"5\"></td>
				<td><img src=\"img/pixel.gif\" width=\"1\" height=\"5\"></td>
				<td><img src=\"img/box_login_br.gif\" width=\"5\" height=\"5\"></td>
			</tr>
		</table>";
} else if (($_GET["vexist"]) == 1) {
		echo "<table class=\"alert\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" bgcolor=\"#f44336\">
			<tr>
				<td><img src=\"img/box_login_tl.gif\" width=\"5\" height=\"5\"></td>
				<td width=\"100%\"><img src=\"img/pixel.gif\" width=\"1\" height=\"5\"></td>
				<td><img src=\"img/box_login_tr.gif\" width=\"5\" height=\"5\"></td>
			</tr>
			<tr>
				<td><img src=\"img/pixel.gif\" width=\"5\" height=\"1\"></td>
				<td>
				<img style=\"float: left; margin: 0px 12px 0px 0px; padding: 2px 0px 0px 0px;\" src=\"img/error.png\"><p>This video is ethier under verification, or it has been declined.</p></div>
					<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
					</tr>
				</table>
				
				</td>
				<td><img src=\"img/pixel.gif\" width=\"5\" height=\"1\"></td>
			</tr>
			<tr>
				<td><img src=\"img/box_login_bl.gif\" width=\"5\" height=\"5\"></td>
				<td><img src=\"img/pixel.gif\" width=\"1\" height=\"5\"></td>
				<td><img src=\"img/box_login_br.gif\" width=\"5\" height=\"5\"></td>
			</tr>
		</table>";
} else {
	$vexist = null;
}
} else {
	$vexist = null;
}?>
<div class="welcomePokTube">
<h1>Welcome to squareBracket</h1>
<?php
if(isset($_SESSION["username"])) // is logged in?
{
	echo "secks";
} else {
echo "<p>\"nerd ur sites dead\", they say, \"your site is literally dead / therws no point of advertising something that isnt even functional\", they also say.
<br>joke's on them, site's functional even with no activity.</p>";
}	?></div>
<div id='homepage-main-content'>
<!--subscription videos-->
<?php
if(isset($_SESSION['username'])) {
$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $_SESSION["username"] ."'"); // calls for channel info
$cdf = mysqli_fetch_assoc($chanfetch);
$Subscriptions = $cdf['subscriptions'];
if(!isset($Subscriptions) OR $Subscriptions == "") {
} else if(count(json_decode($Subscriptions)) == 0) {
} else {
echo "
<div class='homepage-content-block subcription-videos-block'>
		<div id=\"hpSVidHeader\">Subscriptions</div>
		<div>
";
$users = implode('\', \'', json_decode($Subscriptions));
$sqlSponsered = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' AND `Uploader` IN ('$users') ORDER by `UploadDate` DESC LIMIT 5"); //instructions for sql
while ($fetch = mysqli_fetch_assoc($sqlSponsered)) {
$idvideolistSponsered = $fetch['VideoID'];
$lengthlistSponsered = 0;
if($fetch['VideoLength'] > 3600) {
	$lengthlistSponsered = floor($fetch['VideoLength'] / 3600) . ":" . gmdate("i:s", $fetch['VideoLength'] % 3600);
} else { 
	$lengthlistSponsered = gmdate("i:s", $fetch['VideoLength'] % 3600) ;
};
$namevideolistSponsered = htmlspecialchars($fetch['VideoName']);
$uploadervideolistSponsered = htmlspecialchars($fetch['Uploader']); // get recommendations information
$uploadvideolistSponsered = htmlspecialchars($fetch['UploadDate']); // get recommendations information
$descvideolistSponsered = htmlspecialchars($fetch['VideoDesc']);
$viewsvideolistSponsered = htmlspecialchars($fetch['ViewCount']);
echo "<div class='hpSVidEntry ' style='margin-bottom: 0px;'>
				<div class='vstill'><a href='watch.php?v=$idvideolistSponsered'><img src='content/thumbs/".$idvideolistSponsered.".png' onerror=\"this.src='img/default.png'\" class='vimg90'></a></div>
				<div class='small home video-time'><span id='video-run-time-muP9eH2p2PI'>$lengthlistSponsered</span></div>
				<div class='vtitle smallText'>
				<a href='watch.php?v=$idvideolistSponsered'>$namevideolistSponsered</a>
				</div>
				<div class='vfacets' style='margin-bottom: 0px;'>
				<a href='profile.php?user=$uploadervideolistSponsered' class='dg'>$uploadervideolistSponsered</a>
				</div>
				
			</div>";
}
			echo "
				<div class='spacer-sm'></div>
</div>
</div>
<br><br><br><br><br><br><br><br>";
}
}
?>
<!--promoted videos-->
<div class='homepage-content-block sponsored-videos-block'>
		<div id="hpSVidHeader">Promoted Videos</div>
		<div>

<?php

$sqlSponsered = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' ORDER BY RAND() DESC LIMIT 5"); //instructions for sql, also WHERE with ORDER BY works, icty, you said that it didn't in FEB 24 2021, you're wrong.
while ($fetch = mysqli_fetch_assoc($sqlSponsered)) {
$idvideolistSponsered = $fetch['VideoID'];
$lengthlistSponsered = 0;
if($fetch['VideoLength'] > 3600) {
	$lengthlistSponsered = floor($fetch['VideoLength'] / 3600) . ":" . gmdate("i:s", $fetch['VideoLength'] % 3600);
} else { 
	$lengthlistSponsered = gmdate("i:s", $fetch['VideoLength'] % 3600) ;
};
$namevideolistSponsered = htmlspecialchars($fetch['VideoName']);
$uploadervideolistSponsered = htmlspecialchars($fetch['Uploader']); // get recommendations information
$uploadvideolistSponsered = htmlspecialchars($fetch['UploadDate']); // get recommendations information
$descvideolistSponsered = htmlspecialchars($fetch['VideoDesc']);
$viewsvideolistSponsered = htmlspecialchars($fetch['ViewCount']);
echo "<div class='hpSVidEntry ' style='margin-bottom: 0px;'>
				<div class='vstill'><a href='watch.php?v=$idvideolistSponsered'><img src='content/thumbs/".$idvideolistSponsered.".png' onerror=\"this.src='img/default.png'\" class='vimg90'></a></div>
				<div class='small home video-time'><span id='video-run-time-muP9eH2p2PI'>$lengthlistSponsered</span></div>
				<div class='vtitle smallText'>
				<a href='watch.php?v=$idvideolistSponsered'>$namevideolistSponsered</a>
				</div>
				<div class='vfacets' style='margin-bottom: 0px;'>
				<a href='profile.php?user=$uploadervideolistSponsered' class='dg'>$uploadervideolistSponsered</a>
				</div>
				
			</div>";};
		?>
				<div class='spacer-sm'></div>
		</div>
<!-- begin recently featured -->
<br><br><br><br><br><br><br><br>
<div id="homepage-featured-heading">
<div id="hpFeaturedHeading">
		<div id="hpFeaturedMoreTop"><a href="browse.php">See More Featured Videos</a></div>
		<h1>Featured Videos</h1>
	</div>
		<div class="clear"></div>
<div id='homepage-video-list' class='list-view'>
	<div id='hpFeatured'>
		<div class='video-entry'>
<?php
$sql = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' ORDER BY RAND() DESC LIMIT 10"); //instructions for sql, also WHERE with ORDER BY works, icty, you said that it didn't in FEB 24 2021, you're wrong.

while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
$idvideolist = $fetch['VideoID'];
$lengthlist = 0;
if($fetch['VideoLength'] > 3600) {
	$lengthlist = floor($fetch['VideoLength'] / 3600) . ":" . gmdate("i:s", $fetch['VideoLength'] % 3600);
} else { 
	$lengthlist = gmdate("i:s", $fetch['VideoLength'] % 3600) ;
};
$namevideolist = htmlspecialchars($fetch['VideoName']);
$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
$uploadvideolist = htmlspecialchars($fetch['UploadDate']); // get recommendations information
$descvideolist = htmlspecialchars($fetch['VideoDesc']);
$viewsvideolist = htmlspecialchars($fetch['ViewCount']);
$categoryvideolist = htmlspecialchars($fetch['VideoCategory']);
echo "<div class='vEntry'>
	<table width='100%' cellspacing='0' cellpadding='0'>
		<tbody><tr>
		<td rowspan='2' width='130' valign='top'>
			<div id='QLContainer'>
				<a href='watch.php?v=$idvideolist'><img src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" class='vimg120'></a>
				<div class='home video-time'><span id='video-run-time-muP9eH2p2PI'>$lengthlist</span></div>
			</div>
		</td>
		<td valign='top'>
			<div class='vtitle'>
			<a href='watch.php?v=$idvideolist'>$namevideolist</a><br> 
			</div>
			<div class='vdesc'>
						
				<span id='BeginvidDesc_5QUdvUhCZc'>
	$descvideolist
	</span>
	



			</div>
		</td>
		</tr><tr>
		<td valign='bottom'>
			<div class='vfacets'>
			<div class='hpVfacetRight'><span class='grayText'>More in</span> <a href='#' class='dg'>$categoryvideolist</a></div>
			<div class='hpVfacetLeft'>
				<span class='grayText'>From:</span> <a href='profile.php?user=$uploadervideolist' class='dg'>$uploadervideolist</a>
			</div>
			</div> <!-- end vfacets -->
		</td>
		</tr>
	</tbody></table>
	<div></div></div>";
};
//<a href='watch.php?v=$idvideolist&player=1'>Flash Player</a> - <a href='watch.php?v=$idvideolist&player=2'>ActiveX</a>
?>
			<!-- end recently featured -->
</div></div></div></div></div></div>

<div id="homepage-side-content">
<div class="homepage-content-block">
<?php
if(isset($_SESSION["username"])) // is logged in?
{
$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $_SESSION["username"] ."'"); // calls for channel info
$cdf = mysqli_fetch_assoc($chanfetch);
$LastestVideo = htmlspecialchars($cdf['recent_vid']);
$Username = htmlspecialchars($cdf['username']);
$AboutMe = htmlspecialchars($cdf['aboutme']);
$VidsWatched = $cdf['videos_watched'];
$Subscribers = $cdf['subscribers'];
$Name = htmlspecialchars($cdf['prof_name']);
$Age = htmlspecialchars($cdf['prof_age']);
$City = htmlspecialchars($cdf['prof_city']);
$Hometown = htmlspecialchars($cdf['prof_hometown']);
$Country = htmlspecialchars($cdf['prof_country']);
$Foreground = htmlspecialchars($cdf['channel_color']);
if($cdf['prof_website']) {
$Website = htmlspecialchars($cdf['prof_website']);
} else {
	$Website = "";
}
$PreRegisteredOn = $cdf['registeredon'];
$DateTime = new DateTime($PreRegisteredOn);
$RegisteredOn = $DateTime->format('F j Y');
$RegisteredYear = $DateTime->format('Y');
makeBox("Welcome back, $Username!", "<div>
                    <div class='floatR'><span class='smallText'><b><a href='my_profile.php'>Profile Settings</a></b></span></div>
					<img src='content/profpic/$Username.png' onerror='this.src='img/profiledef.png'' class='thumb' style='height: 64px;' width='64'>
                    <div class='clear'></div>
                </div>
                <table>
                    <tbody>
                </tbody></table>
                <div class='bottomBorderDotted'></div>
        </div>
		<br>
		<div id='hpAccountLinksDiv'>
		<div class='mar38L'>
			<a href='profile.php?user=$Username&page=videos'>Videos</a>
			-
			<!---<a href='/web/20070115185031/http://youtube.com/my_favorites' onclick='_hbLink('myFavorites','MyLinks');'>Favorites</a>
			-
			<a href='/web/20070115185031/http://youtube.com/my_playlists' onclick='_hbLink('myPlaylists','MyLinks');'>Playlists</a>
			-
			<a href='/web/20070115185031/http://youtube.com/my_messages' onclick='_hbLink('myMessages','MyLinks');'>Inbox</a>
			-
			<a href='/web/20070115185031/http://youtube.com/subscription_center' onclick='_hbLink('mySubscriptions','MyLinks');'>Subscriptions</a>--->
		</div>");
} else {
makeBox("Want to be part of SquareBracket?", "<div>
					<a href='/login.php'><strong>Login to SquareBracket now!</strong></a><br>
                    <div class='clear'></div>
                </div>
                <table>
                    <tbody>
                </tbody></table>
                <div class='hpLoginForgot smallText'>
                    <a href='/signup.php'>Don't have an account? Sign up!</a><a href='/about.php' rel='nofollow'></a>    <a href='/about.php' rel='nofollow'><img src='img/pixel.gif' class='alignMid gaiaHelpBtn' alt='' border='0'></a>
                <p class='marT0 marB0' align='center'>
                </p></div>
                <div class='bottomBorderDotted'></div>");
}
?>
			<?php
$chanfetch = mysqli_query($connect, "SELECT * FROM users ORDER BY RAND() LIMIT 3"); // calls for channel info
$contents = "";
while ($cdf = mysqli_fetch_assoc($chanfetch)) {
$LastestVideo = htmlspecialchars($cdf['recent_vid']);
$Username = htmlspecialchars($cdf['username']);
$AboutMe = htmlspecialchars($cdf['aboutme']);
$VidsWatched = $cdf['videos_watched'];
$Subscribers = $cdf['subscribers'];
$Name = htmlspecialchars($cdf['prof_name']);
$Age = htmlspecialchars($cdf['prof_age']);
$City = htmlspecialchars($cdf['prof_city']);
$Hometown = htmlspecialchars($cdf['prof_hometown']);
$Country = htmlspecialchars($cdf['prof_country']);
$Foreground = htmlspecialchars($cdf['channel_color']);
if($cdf['prof_website']) {
$Website = htmlspecialchars($cdf['prof_website']);
} else {
	$Website = "";
}
$PreRegisteredOn = $cdf['registeredon'];
$DateTime = new DateTime($PreRegisteredOn);
$RegisteredOn = $DateTime->format('F j Y');
$RegisteredYear = $DateTime->format('Y');
$query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `Uploader`='".$Username."' AND `isApproved` = '1';");
$vdf_alt = mysqli_fetch_assoc($query);
$contents .= "<div class='hpChannelEntry v80hEntry'>
				<div class='vstill'><a href='profile.php?user=$Username'><img src='content/profpic/$Username.png' onerror=\"this.src='img/profiledef.png'\" class='vimg' style='background: #333;'></a></div>
				<div class='vinfo'>
					<b><a href='profile.php?user=$Username'>$Username</a></b>
					<div class='vfacets'>".$vdf_alt['COUNT(VideoID)']." Videos | $Subscribers Subscribers</div>
				</div>
				<div class='clear'></div>
				</div> <!-- end hpChannelEntry -->";
}
makeBox("Active Channels", "$contents <div style=\"text-align: right;\"><a href=\"/web/20060827034106/http://www3.youtube.com/members\">See More Channels</a></div>");
?>
	<?php
	makeBox("ChazizCraft", "<div class=\"hpWNentry\">
				<img src=\"https://mcapi.us/server/image?ip=185.86.231.49&port=25565&title=ChazizCraft\" width=\"292\" border=\"0\">
	</div>");
	?>
</div>
</div>
<?php include("footer.php"); ?>
