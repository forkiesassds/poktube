<?php 
include("header.php"); 
?>
<html>
<head>
<title>Chaziz PokTube</title>
<body>
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
} else {
	$vexist = null;
}
} else {
	$vexist = null;
}?>

<div id='homepage-main-content'>
<div class='homepage-content-block sponsored-videos-block'>
		<div class='homepage-block-heading homepage-block-heading-gray'>Promoted Videos</div>
		<div>

<?php

$sqlSponsered = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' ORDER BY RAND() DESC LIMIT 4"); //instructions for sql, also WHERE with ORDER BY works, icty, you said that it didn't in FEB 24 2021, you're wrong.
while ($fetch = mysqli_fetch_assoc($sqlSponsered)) {
$idvideolistSponsered = $fetch['VideoID'];
$namevideolistSponsered = htmlspecialchars($fetch['VideoName']);
$uploadervideolistSponsered = htmlspecialchars($fetch['Uploader']); // get recommendations information
$uploadvideolistSponsered = htmlspecialchars($fetch['UploadDate']); // get recommendations information
$descvideolistSponsered = htmlspecialchars($fetch['VideoDesc']);
$viewsvideolistSponsered = htmlspecialchars($fetch['ViewCount']);
echo "<div class='homepage-sponsored-video'>
				<div class='videoIconWrapperOuter'>
					<div class='videoIconWrapperInner'>
					<div class='vstill'><a href='watch.php?v=$idvideolistSponsered'><img src='content/thumbs/".$idvideolistSponsered.".png' onerror=\"this.src='img/default.png'\"  class='vimg120'></a></div>
					</div>
				</div>
				<div class='vtitle smallText'>
					<a href='watch.php?v=$idvideolistSponsered'>$namevideolistSponsered</a>
				</div>
				<div class='vfacets'>
				<a href='/web/20090101130443/http://youtube.com/user/VenetianPrincess' class='dg'>$uploadervideolistSponsered</a>
				</div>
			</div>";};
		?>
				<div class='spacer-sm'></div>
		</div>
<!-- begin recently featured -->
<div id="homepage-featured-heading">
			<div id="homepage-featured-more-top"><a id="hpVideoListMoreLink" href="browse.php" onmousedown="urchinTracker('/Events/Home/SeeMore/Featured/Top');">See More Featured Videos</a></div>
		<h1 id="hpVideoListHead">Featured Videos</h1>
		<div id="homepage-featured-tabs">
		<div class="clear"></div>
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
echo "<div class='video-entry'>
   <div class='v120WideEntry'>
      <div class='v120WrapperOuter'>
         <div class='v120WrapperInner'>
            <a id='video-url-muP9eH2p2PI' href='watch.php?v=$idvideolist' rel='nofollow'><img title='$namevideolist' src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" class='vimg120' qlicon='muP9eH2p2PI' alt='$namevideolist'></a>
         <div class='video-time'><span id='video-run-time-muP9eH2p2PI'>$lengthlist</span></div>
		 </div>
      </div>
   </div>
   <div class='video-main-content' id='video-main-content-muP9eH2p2PI'>
      <div class='video-title '>
         <div class='video-long-title'>
            <a id='video-long-title-muP9eH2p2PI' href='watch.php?v=$idvideolist&player=0'  title='$namevideolist' rel='nofollow'>$namevideolist</a>
         </div>
      </div>
      <div id='video-description-muP9eH2p2PI' class='video-description'>
         $descvideolist
      </div>
      <div class='video-facets'>
         Uploaded on $uploadvideolist by: <span class='video-username'><a id='video-from-username-muP9eH2p2PI' class='hLink' href='profile.php?user=$uploadervideolist'>$uploadervideolist</a></span>
      </div>
   </div>
   <div class='video-clear-list-left'></div>
</div>";
};
//<a href='watch.php?v=$idvideolist&player=1'>Flash Player</a> - <a href='watch.php?v=$idvideolist&player=2'>ActiveX</a>
?>
			<!-- end recently featured -->
</div></div></div></div></div></div>

<div id="homepage-side-content">
   <div class="homepage-side-block" id="homepage-whats-new-block">
      <div class="homepage-yellow-block">
         <div class="homepage-block-heading" style="color:#CC6600">What's New</div>
         <div class="clear"></div>
         <div class="bottomBorderDotted"></div>
		 <b style="color:#CC6600">Reverted redesign</b><br>
		 Squarebracket's Semantic UI redesign has been reverted. Chaziz (and even <a href="https://cdn.discordapp.com/attachments/805298283302879242/821111535442067476/unknown.png">Chief Bazinga from FulpTube<a>) didn't like it.<br><br>
		 <b style="color:#CC6600">New server</b><br>
		 PokTube is no longer hosted on a laptop. It has been moved to be hosted on a Debian server with Nginx.<br><br>
		 Since we haven't figured everything out yet, video uploading and playback is broken for the time being.<br><br>
         <div style="font-size: 1px; height: 1px;"><br></div>
      </div>
      <img class="homepage-yellow-block-bot" src="https://web.archive.org/web/20090101094601im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif">
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