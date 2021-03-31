<?php 
include("header.php");
?>
<div id="sectionHeader" style="margin-bottom: 5px;">
	<h1>QuickList</h1></div>
<?php
if(isset($_SESSION['username'])) {
$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $_SESSION["username"] ."'"); // calls for channel info
$cdf = mysqli_fetch_assoc($chanfetch);
$Quicklist = $cdf['quicklist'];
if(!isset($Quicklist) OR $Quicklist == "") {
} else if(count(json_decode($Quicklist)) == 0) {
} else {
$Quicklist = implode('\', \'', json_decode($Quicklist));
$sqlSponsered = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' AND `VideoID` IN ('$Quicklist') ORDER by `UploadDate` DESC LIMIT 4"); //instructions for sql
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
<br><br><br><br><br><br><br><br>";
}
}
?>
<?php 
include("footer.php"); 
?>