<?php 
include("header.php"); 
if(!isset($_GET["page"])){
	$page = 1;
}
if(isset($_GET["page"])){
if($_GET["page"] == 1) {
	$page = 1;
}
if($_GET["page"] && $_GET["page"] > 1){
	$page = $_GET["page"] * 20;
}
}
$page = $page - 1;
$sql = mysqli_query($connect, "SELECT * FROM videodb"); //instructions for sql
$count = 0;
$pages = 0;

while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
$count++;
if($count == 20) {
	$pages++;
	$count = 0;
}
}
?>
<?php $query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `isApproved` = '1';");
$vdf_alt = mysqli_fetch_assoc($query);
if(($pages * 20) < $vdf_alt['COUNT(VideoID)']) {
	$pages++;
}	
?>
<title>Browse - squareBracket</title>
<div id="mainContent"><br>
<div id="sectionHeader" class="videosColor">
	<div class="my"><a href="/web/20061111083351/http://www3.youtube.com/my_videos"><img src="/img/btn_myvideo_104x25.gif" alt="myvideos" width="104" height="25" border="0"></a></div>
	<div class="name">Videos</div>
	<span class="title_browse">Most Recent (<?php echo ($count - 19)."-".($pages * 20)?> of <?php $query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `isApproved` = '1';");
		$vdf_alt = mysqli_fetch_assoc($query);
		echo $vdf_alt['COUNT(VideoID)'];?>)</span>
</div>
<div id="mainContentWithNav">
		
	
	<br><br>
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
            	<tbody><tr valign="top"><?php
$vidlist = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' ORDER by `UploadDate` DESC LIMIT ".$page.", 20");
$count = 0;

while ($fetch = mysqli_fetch_assoc($vidlist)) {
$idvideolist = $fetch['VideoID'];
$lengthlist = 0;
if($fetch['VideoLength'] > 3600) {
	$lengthlist = floor($fetch['VideoLength'] / 3600) . ":" . gmdate("i:s", $fetch['VideoLength'] % 3600);
} else { 
	$lengthlist = gmdate("i:s", $fetch['VideoLength'] % 3600) ;
};
$namevideolist = htmlspecialchars($fetch['VideoName']);
$uploadervideolist = htmlspecialchars($fetch['Uploader']);
$uploadvideolist = $fetch['UploadDate'];
$viewsvideolist = htmlspecialchars($fetch['ViewCount']);

	if($count == 0) {
		echo "<tr valign='top'>";
	}
	echo "		<td width='25%'>
				<div class='v120vEntry'>
			<div style='margin-top:-20px;'>
		<div class='vstill'><a href='watch?v=$idvideolist'><img src='content/thumbs/$idvideolist.png' onerror=\"this.src='img/default.png'\" class='vimg'></a></div>
		<div class='vtitle'>
			<a href='/web/20061111083351/http://www3.youtube.com/watch?v=Y2Oy8QOoIvA'>$namevideolist</a><br>
			<span class='runtime'>$lengthlist</span>
		</div>

		<div class='vfacets'>
			<span class='grayText'>Added:</span>$uploadvideolist<br>
			<span class='grayText'>From:</span> <a href='profile.php?user=$uploadervideolist'>$uploadervideolist</a><br>
		</div>
			</div>
	</div> <!-- end vEntry / this is like the 3rd fucking time we redesigned this one fucking page-->";
	$count++;
	if($count == 4) {
		echo "</tr>";
		$count = 0;
	}
	}
?>
	</tbody></table>
		<div class="footerBox">
			
					<div class="pagingDiv">
				<?php
				$pagecount = 0;
				while($pagecount !== $pages) {
					if($pagecount == 0) {
						echo "Pages: ";
					}
					$pagecount++;
					if(!isset($_GET["page"])) {
						$pagee = 1;
					} else {
						$pagee = $_GET["page"];
					}
					if($pagee == $pagecount)
					{
						echo "<span class=\"pagerCurrent\">".$pagecount."</span>";
					} else {
						echo "<span class=\"pagerNotCurrent\" onclick=\"location.href='/browse.php?page=".$pagecount."'\" style=\"text-decoration: underline; color:blue;\">".$pagecount."</span>";
					}
				}
				?>
			</div> <!-- end pagingDiv -->




		</div>
	


</div>
			
			</div></div>

<?php include("footer.php"); ?>