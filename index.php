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
}
?>
<br>
<div class="container">
  <div class="row">
  <div class="col-8">
<div id="homepage-main-content">

<div class="card-group">
  <div class="card">
    <img src="img/why.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Watch</h5>
      <p class="card-text">Instantly find and watch streaming videos. </p>
    </div>
  </div>
  <div class="card">
    <img src="img/why.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Upload</h5>
      <p class="card-text">Quickly upload and tag videos in almost any video format. </p>
    </div>
  </div>
  <div class="card">
    <img src="img/why.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Share</h5>
      <p class="card-text">Easily share your videos with your family, friends, or co-workers. </p>
    </div>
  </div>
</div>
<!-- begin recently featured -->
<br>
<div id="homepage-featured-heading">
<div class="card mb-3">
  <div class="card-header">
    Featured Videos
  </div>
<?php
$sql = mysqli_query($connect, "SELECT * FROM videodb ORDER BY RAND() DESC LIMIT 10"); //instructions for sql

while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
$idvideolist = $fetch['VideoID'];
$namevideolist = htmlspecialchars($fetch['VideoName']);
$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
$uploadvideolist = htmlspecialchars($fetch['UploadDate']); // get recommendations information
$descvideolist = htmlspecialchars($fetch['VideoDesc']);
$viewsvideolist = htmlspecialchars($fetch['ViewCount']);
echo "<div class='row g-0'>
    <div class='col-md-4'>
      <img src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" width='160' height='120' alt='...'>
    </div>
    <div class='col-md-8'>
      <div class='card-body'>
        <h5 class='card-title'>$namevideolist</h5>
        <p class='card-text'>$descvideolist</p>
        <p class='card-text'><small class='text-muted'>uploaded $uploadvideolist by $uploadervideolist</small></p>
      </div>
    </div>
  </div>";
}
//<a href='watch.php?v=$idvideolist&player=1'>Flash Player</a> - <a href='watch.php?v=$idvideolist&player=2'>ActiveX</a>
?>
			<!-- end recently featured -->
</div></div><p class="text-end"><a href="browse.php">See More Featured Videos</a></p></div></div>
<div class="col-4">
<div id="homepage-side-content">
   <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        The Homer
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        It costs $82,000. Fuck you. Purchase it.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        New Server
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
			PokTube is no longer hosted on a laptop. It has been moved to be hosted on a Debian server with Nginx.<br><br>
		 Since we haven't figured everything out yet, video uploading and playback is broken for the time being.
		 </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        New player
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        End my suffering, Flash and ActiveX players are no longer available for the time being.
      </div>
    </div>
  </div>
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
