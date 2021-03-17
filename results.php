<?php
include("header.php"); 
$con = $connect;
if( $con->connect_error){
    die('Error: ' . $con->connect_error);
}
$sql = "SELECT * FROM `videodb`";
if( isset($_GET['search']) ){
    $name = mysqli_real_escape_string($connect, htmlspecialchars($_GET['search']));
    $sql = "SELECT * FROM `videodb` WHERE VideoName LIKE '%{$name}%' AND `isApproved`='1'";
}
$result = $connect->query($sql);
echo "<html>
<head>
<title>Search results for ".$_GET['search']."</title>";
?>
<div style="margin: auto; width: 95%;">
<!-- begin recently featured -->
					<table class="roundedTable" width="auto" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#cccccc">
			<tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td width="585">
					<div class="sunkenTitleBar">
						<div class="moduleTitle">
							<span style="color:#444;">Search results for <?php echo $_GET['search']?></span>
						</div>
					</div>
					<div class="list-view">
											<?php
$sql = mysqli_query($connect, "SELECT * FROM `videodb` WHERE VideoName LIKE '%{$name}%' AND `isApproved`='1'"); //instructions for sql

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
echo "<div class='moduleEntry'>
<div class='video-entry' style='padding: 0;'>
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
</div>
</div>";
}
?>
				</td>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>
		</div>
	</div>
			<!-- end recently featured -->
<?php include("footer.php"); ?>