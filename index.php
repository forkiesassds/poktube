<html>
<script>
function onclick(event) {
  _hbLink('NursingMonkeyinmylaplooksforanswers', 'VidHorz');
}
</script> 
<?php 
include("header.php"); 
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
				<img style=\"float: left; margin: 0px 12px 0px 0px; padding: 2px 0px 0px 0px;\" src=\"img/error.png\"><p>This video is private!</p></div>
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

<div id='homepage-main-content'>
<div class='homepage-content-block sponsored-videos-block'>
		<div id="hpSVidHeader">Promoted Videos</div>
		<div>

<?php

$sqlSponsered = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' ORDER BY RAND() DESC LIMIT 4"); //instructions for sql, also WHERE with ORDER BY works, icty, you said that it didn't in FEB 24 2021, you're wrong.
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
			</div>
		</td>
		<td valign='top'>
			<div class='vtitle'>
			<a href='watch.php?v=$idvideolist'>$namevideolist</a><br> 
			<span class='runtime'>$lengthlist</span>
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
echo "            
<div class='headerRCBox'>
	<b class='rch'>
	<b class='rch1'><b></b></b>
	<b class='rch2'><b></b></b>
	<b class='rch3'></b>
	<b class='rch4'></b>
	<b class='rch5'></b>
	</b> <div class='content'><span class='headerTitle'>Welcome back, $Username!</span></div>
	</div>
	<div class='contentBox'>
                <div>
                    <div class='floatR'><span class='smallText'><b><a href='my_profile.php'>Profile Settings</a></b></span></div>
					<img src='content/profpic/$Username.png' onerror='this.src='img/profiledef.png'' class='thumb' style='height: 64px;' width='64'>
                    <div class='clear'></div>
                </div>
                <table>
                    <tbody>
                </tbody></table>
                <div class='hpLoginForgot smallText'>
                    <p class='marT0 marB0' align='center'><a href='profile.php?user=$Username'>My Channel</a> | <a href='/my_videos.php'>My Videos</a></p>
                <p class='marT0 marB0' align='center'>
                </p></div>
                <div class='bottomBorderDotted'></div>
        </div>";
} else {
echo "<div class='homepage-content-block'>
  <div class='signInBoxBorder'>
    <div class='signInBoxContent'>
            <strong>Want to participate in SquareBracket?</strong><br>
        <a href='/login.php'><strong>Login to SquareBracket now!</strong></a>
        <div class='homepage-border-dotted'></div>
        <span class='smgrayText'>
        <a href='/signup.php'>Don't have an account? Sign up!</a>
        </span>
        <a href='/about.php' rel='nofollow'><img src='img/pixel.gif' class='alignMid gaiaHelpBtn' alt='' border='0'></a>
    </div>  
        </div>  
            </div>"; }
?>
<br>
<div class="hpContentBlock">
			<div class="headerRCBox">
	<b class="rch">
	<b class="rch1"><b></b></b>
	<b class="rch2"><b></b></b>
	<b class="rch3"></b>
	<b class="rch4"></b>
	<b class="rch5"></b>
	</b> <div class="content"><span class="headerTitle">What's New on SquareBracket</span></div>
	</div>

		<div class="contentBox">
			<div class="hpWNentry">
				<div class="hpWNimage">
				<a href="my_profile.php"><img src="img/downloaded/pic_home_chnlcustom_30x37.gif" border="0"></a>
				</div>
				<div class="hpWNdesc">
				<b><a href="my_profile.php">More Channel Customizations and New Channel Redesign</a></b><br>
				Now you can choose more colors for your Profile. Additionally, the 2006 YouTube Channel layout has been implemented.
				</div>
			</div> <!-- end hpWNentry -->
		</div>
	</div>
	<!--<div class="hpContentBlock">
			<div class="headerRCBox">
	<b class="rch">
	<b class="rch1"><b></b></b>
	<b class="rch2"><b></b></b>
	<b class="rch3"></b>
	<b class="rch4"></b>
	<b class="rch5"></b>
	</b> <div class="content"><span class="headerTitle">Active Channels</span></div>
	</div>

		<div class="contentBox">
			<div class="hpChannelEntry v80hEntry">
				<div class="vstill"><a href="/web/20070214121244/http://youtube.com/profile?user=openingmind"><img src="https://web.archive.org/web/20070214121244im_/http://sjc-static10.sjc.youtube.com/vi/lytExpvDAlU/2.jpg" class="vimg" style="background: #333;"></a></div>
				<div class="vinfo">
					<b><a href="/web/20070214121244/http://youtube.com/profile?user=openingmind">openingmind</a></b>
					<div class="vfacets">23 Videos | 102 Subscribers</div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div style="text-align: right;"><a href="/web/20070214121244/http://youtube.com/members">See More Channels</a></div>
		</div>
	</div>-->
   </div>
</div></div>


<div id="sheet" style="position:fixed; top:0px; visibility:hidden; width:100%; text-align:center;">
	<table width="100%">
		<tr>
			<td align="center">
				<div id="sheetContent" style="filter:alpha(opacity=50); -moz-opacity:0.5; opacity:0.5; border: 1px solid black; background-color:#cccccc; width:40%; text-align:left;"></div>
			</td>
		</tr>
	</table>
</div>

<?php include("footer.php"); ?>