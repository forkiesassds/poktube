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
<title>Browse - PokTube</title>

		<div class="headerRCBox">
			<b class="rch">
			<b class="rch1"><b></b></b>
			<b class="rch2"><b></b></b>
			<b class="rch3"></b>
			<b class="rch4"></b>
			<b class="rch5"></b>
			</b> <div class="content">	<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
				<td width="30%">
					<div class="headerTitle">Most Recent</div>
				</td>
				<td width="35%" align="center" class="smallText">
				</td>
				<td width="35%" align="right"><span class="label">Videos <?php echo ($count - 19)."-".($pages * 20)?> of <?php $query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `isApproved` = '1';");
		$vdf_alt = mysqli_fetch_assoc($query);
		echo $vdf_alt['COUNT(VideoID)'];?></span></td>
			</tr>
			</table>
		</div>
		</div>
				
	<div class="contentBox" style="background: #EEE;"> 
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr valign="top">

				<tbody><?php
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
	echo "<td width=\"20%\">
				<div class=\"vBriefEntry\">
		<div class=\"img\">
			<a href='watch.php?v=$idvideolist'><img src='content/thumbs/$idvideolist.png' onerror=\"this.src='img/default.png'\" class=\"vimg\"></a>
		</div>
		<div class=\"title\">
			<b><a href='watch.php?v=$idvideolist'>$namevideolist</a></b><br/>
			<span class=\"runtime\">$lengthlist</span>
		</div>
		<div class=\"facets\">
			<span class=\"grayText\">Added:</span> $uploadvideolist<br/>
			<span class=\"grayText\">From:</span> <a href='profile.php?user=$uploadervideolist'>$uploadervideolist</a><br/>
		</div>
		
	</div>";
	$count++;
	if($count == 5) {
		echo "</tr>";
		$count = 0;
	}
	}
?>
			</div>
			
			</tr>

			</table>

			</div>
			
			<div class="browsePagination">
				<?php
				$pagecount = 0;
				while($pagecount !== $pages) {
					if($pagecount == 0) {
						echo "Browse Pages:";
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
			</div>

<?php include("footer.php"); ?>