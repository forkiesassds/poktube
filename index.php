<?php 
include("header.php"); 
?>
<div id="homepage-main-content">
<html>
<head>
<title>Chaziz PokTube</title>
<body>
	<tr valign="top">
		<td style="padding-right: 15px;">
					<table class="roundedTable" width="650" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#e5ecf9">
			<tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td width="585">
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr valign="top">
					<td width="33%" style="border-right: 1px dashed #369; padding: 0px 10px 10px 10px; color: #444;">
					<div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;"><img src="img/silk/television.png"> <a href="browse.php">Watch</a></div>
					Instantly find and watch streaming videos.
					</td>
					<td width="33%" style="border-right: 1px dashed #369; padding: 0px 10px 10px 10px; color: #444;">
					<div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;"><img src="img/silk/add.png"> <a href="my_videos_upload.php">Upload</a></div>
					Quickly upload and tag videos in almost any video format.
					</td>
					<td width="33%" style="padding: 0px 10px 10px 10px; color: #444;">
					<div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;"><img src="img/silk/link.png"> <a href="my_friends_invite.php">Share</a></div>
					Easily share your videos with your family, friends, or co-workers.
					</td>
					</tr>
				</table>
				
				</td>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>
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
$sql = mysqli_query($connect, "SELECT * FROM videodb ORDER BY RAND() DESC LIMIT 10"); //instructions for sql

while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
$idvideolist = $fetch['VideoID'];
$namevideolist = htmlspecialchars($fetch['VideoName']);
$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
$uploadvideolist = htmlspecialchars($fetch['UploadDate']); // get recommendations information
$descvideolist = htmlspecialchars($fetch['VideoDesc']);
$viewsvideolist = htmlspecialchars($fetch['ViewCount']);
echo "<div class='video-entry'>
   <div class='v120WideEntry'>
      <div class='v120WrapperOuter'>
         <div class='v120WrapperInner'>
            <a id='video-url-muP9eH2p2PI' href='watch.php?v=$idvideolist&player=0' rel='nofollow'><img title='$namevideolist' src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" class='vimg120' qlicon='muP9eH2p2PI' alt='$namevideolist'></a>
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
		  Alternative players: <a href='watch.php?v=$idvideolist&player=1'>Flash Player</a> - <a href='watch.php?v=$idvideolist&player=2'>ActiveX</a>
	  </div>
      <div class='video-facets'>
         Uploaded by: <span class='video-username'><a id='video-from-username-muP9eH2p2PI' class='hLink' href='profile.php?user=$uploadervideolist'>$uploadervideolist</a></span>
      </div>
   </div>
   <div class='video-clear-list-left'></div>
</div>";
}
?>
			<!-- end recently featured -->
</div></div></div></div></div>

<div id="homepage-side-content">
   <div class="homepage-side-block" id="homepage-whats-new-block">
      <div class="homepage-yellow-block">
         <div class="homepage-block-heading" style="color:#CC6600">What's New</div>
         <div class="clear"></div>
         <div class="bottomBorderDotted"></div>
		 <b style="color:#CC6600">New player</b><br>
		 End my suffering, Flash and ActiveX players are no longer available for the time being.<br><br>
         <b style="color:#CC6600">NEW DESIGN?</b><br>
         Yes. This is based on early-2009 YouTube. Why? because 2005 is total garbage and is lazy.<br><br>
		 Some pages are now fucked up (mainly profile and settings), but keep in mind, this will be fixed LATER.
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
