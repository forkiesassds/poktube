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
	echo "
	<div class=\"ui container\">
		<div class=\"ui error message\">
			<i class=\"exclamation triangle icon\"></i> This video does not exist!
		</div>
	</div>
	";
} else {
	$vexist = null;
}
} else {
	$vexist = null;
}
?>
<div class="two column stackable ui padded grid">
  <div class="ten wide column">
	<tr valign="top">
		<td style="padding-right: 15px;">
			<div class="ui inverted three column doubling stackable centered divided container segment">
				<div class="column">
					<img src="img/silk/television.png"> 
					<a href="browse.php">
						Watch
					</a>
					Instantly find and watch streaming videos.
				</div>
				<div class="column">
					<img src="img/silk/add.png"> 
					<a href="my_videos_upload.php">
						Upload
					</a>
					Quickly upload and tag videos in almost any video format.
				</div>
				<div class="column">
				<img src="img/silk/link.png">
					<a href="my_friends_invite.php">
						Share
					</a>
					Easily share your videos with your family, friends, or co-workers.
				</div>
			</div>
<!-- begin recently featured -->
<div id="homepage-featured-heading">
	<h4 class="ui top attached inverted header">
		<div id="homepage-featured-more-top">
			<a style="float: right;" id="hpVideoListMoreLink" href="browse.php" onmousedown="urchinTracker('/Events/Home/SeeMore/Featured/Top');">
				See More Featured Videos
			</a>
			<span>Featured Videos</span>
		</div>
	</h4>
	<div class="ui bottom attached segment">
<div class="ui celled list">
<?php
$sql = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' ORDER BY RAND() DESC LIMIT 10"); //instructions for sql
while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
$idvideolist = $fetch['VideoID'];
$namevideolist = htmlspecialchars($fetch['VideoName']);
$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
$uploadvideolist = htmlspecialchars($fetch['UploadDate']); // get recommendations information
$descvideolist = htmlspecialchars($fetch['VideoDesc']);
$viewsvideolist = htmlspecialchars($fetch['ViewCount']);
$count = 0;
if (!($fetch['isApproved'] == 2)) {
	echo "<div class='item'>
		<div class='image'>
		  <a href='watch.php?v=$idvideolist'>
			<img width='160' height='120' src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\">
		  </a>
		</div>
		<div class='content'>
		  <a href='watch.php?v=$idvideolist' class='header'>$namevideolist</a>
		  <div class='meta'>
			<span>$descvideolist</span>
		  </div>
		  <div class='description'>
			<p></p>
		  </div>
		  <div class='extra'>
		  Uploaded on $uploadvideolist<br>
		  <a href='profile.php?user=$uploadervideolist'><img class='ui avatar image' src='content/profpic/$uploadervideolist.png' onerror=\"this.src='img/profiledef.png'\">
		  <span>$uploadervideolist</span></a>
		  </div>
		</div>
	  </div>";
	  $count++;
	  if($count == 10) {
		  break;
	  }
}
}
?>
</div>
</div>
			<!-- end recently featured -->
</div></div>

<div class="six wide column">
   <div class="ui segment">
        <div class="homepage-block-heading" style="color:#CC6600">What's New</div>
        <div class="clear"></div>
        <div class="bottomBorderDotted"></div>
		<b style="color:#CC6600">New server</b><br>
		PokTube is no longer hosted on a laptop. It has been moved to be hosted on a Debian server with Nginx.<br><br>
		Since we haven't figured everything out yet, video uploading and playback is broken for the time being.<br><br>
		<b style="color:#CC6600">New player</b><br>
		End my suffering, Flash and ActiveX players are no longer available for the time being.
		<div style="font-size: 1px; height: 1px;"><br></div>
   </div>
</div></div></div>


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