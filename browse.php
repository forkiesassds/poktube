<?php 
include("header.php"); 
if(!isset($_GET["page"])){
	$page = 1;
} else
{
	$page = $_GET["page"];
}
$page = $page - 1;
$sql = mysqli_query($connect, "SELECT * FROM videodb"); //instructions for sql

$count = 0;
$pages = 0;
$row = 0;

while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
$count++;
if($count == 20) {
	$pages++;
	$count = 0;
}
}
?>
<title>Browse - PokTube</title>
<div class="ui container">
	<h4 class="ui top attached inverted header">
		<div id="homepage-featured-more-top">
			<span>Most Recent</span>
		</div>
	</h4>
		<div class="ui bottom attached segment">
			<div class="ui center aligned grid">
<?php
$vidlist = mysqli_query($connect, "SELECT * FROM videodb ORDER by `UploadDate` DESC");

$count = 1;

while ($fetch = mysqli_fetch_assoc($vidlist)) {
$idvideolist = $fetch['VideoID'];
$namevideolist = htmlspecialchars($fetch['VideoName']);
$uploadervideolist = htmlspecialchars($fetch['Uploader']);
$uploadvideolist = $fetch['UploadDate'];
$viewsvideolist = htmlspecialchars($fetch['ViewCount']);
	if ($count > 20*$page) {
	echo "<div class=\"four wide column\">
			<a href='watch.php?v=".$idvideolist."'><img src='./content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" width='160' height='120' class='moduleFeaturedThumb'></a>
			<div class='moduleFeaturedTitle'><a href='watch.php?v=".$idvideolist."'>".$namevideolist."</a></div>
			<div class='moduleFeaturedDetails'>
				Added: ".$uploadvideolist."<br>
				by <a href='profile.php?user=".$uploadervideolist."'>".$uploadervideolist."</a>
			</div>
		</div>";
	}
	$count++;
	if ($count == 20*$page+5) {
		if ($row == 4) {
			break;
		}
		echo "</tr>";
		$count = 20 * $page;
		$row++;
	}
}
?>
			</div>
		</div>

			<!-- begin paging -->
			<div class="ui buttons">
				<?php
				$pagecount = 0;
				while($pagecount !== $pages) {
					if($pagecount == 0) {
						echo "Browse Pages:";
					}
					$pagecount++;

					echo "<a class=\"ui button\" href='browse.php?page=".$pagecount."'>".$pagecount."</a>";
					
				}
				?>
			</div>
		</div>
	</div>
			<!-- end paging -->
<?php include("footer.php"); ?>