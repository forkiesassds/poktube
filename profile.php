<?php 
require_once __DIR__ . '/lib/PHPColors/Color.php';
use Mexitek\PHPColors\Color;
include("header.php"); 

if(isset($_GET["user"])) {
$user = $_GET["user"];
}
$vidfetch = mysqli_query($connect, "SELECT * FROM videodb");
$vdf = mysqli_fetch_assoc($vidfetch);
$Uploader = htmlspecialchars($vdf['Uploader']); // get all video information
$VideoName = htmlspecialchars($vdf['VideoName']);
$ViewCount = $vdf['ViewCount'];
$PreUploadDate = htmlspecialchars($vdf['UploadDate']);
$VideoDesc = nl2br(htmlspecialchars($vdf['VideoDesc']));

//if $FeaturedVideo is null then dont show anything
if (!isset($_GET["user"])) {
die();
}

$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE username='". $user ."'"); // calls for channel info
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
if($cdf['channel_color']) {
	$Foreground = htmlspecialchars($cdf['channel_color']);
} else {
	$Foreground = "#003366";
}
$Background = htmlspecialchars($cdf['channel_bg']);
$color = new Color($Foreground);
if($cdf['prof_website']) {
$Website = htmlspecialchars($cdf['prof_website']);
} else {
	$Website = "";
}
$PreRegisteredOn = $cdf['registeredon'];
$DateTime = new DateTime($PreRegisteredOn);
$RegisteredOn = $DateTime->format('F j Y');
$RegisteredYear = $DateTime->format('Y');
?>
<style>
.headerPROF {
    position: relative;
    width: 100%;
    height: 150px;
	<?= $color->getCssGradient(10, true)?>
    text-align: right;
	margin-top: -1rem;
}

.ui.padded.grid:not(.vertically):not(.horizontally) {
	position: relative !important;
	bottom: 125px;
}
.two.column.stackable.ui.padded.grid {
	margin-top: -1rem !important;
}
</style>
<meta name="title" content="<?php echo $Username ?>'s Channel">
<meta name="description" content="<?php echo $AboutMe ?>">
<title><?php echo $Username ?> - PokTube</title>
<body>
<div class="headerPROF"></div>
<div style="padding: 0px 5px 0px 5px;">
<div class="four column stackable ui padded grid">
<div class="three wide column">
<div class="ui fluid card">
  <div class="image">
    <img src="content/profpic/<?php echo $Username?>.png" onerror="this.src='img/profiledef.png'">
  </div>
  <div class="content">
    <a class="header"><?php echo $Username ?></a>
    <div class="meta">
      <span class="date">Joined in <?php echo $RegisteredYear?></span>
    </div>
    <div class="description">
      <?php echo stripslashes($AboutMe) ?>
    </div>
  </div>
</div>
</div>
<div class="four wide column">
<div class="ui fluid card">
  <div class="content">
    <div class="header">About me</div>
  </div>
          <div class="content">
          <div class="summary">
            <div class="meta">Name:</div> <div class="description"><?php echo $Name ?></div>
          </div>
		  <div class="summary">
            <div class="meta">Age:</div> <div class="description"><?php echo $Age ?></div>
          </div>
		  <div class="summary">
            <div class="meta">Hometown:</div> <div class="description"><?php echo $Hometown ?></div>
          </div>
		  <div class="summary">
            <div class="meta">Current City:</div> <div class="description"><?php echo $City ?></div>
          </div>
		  <div class="summary">
            <div class="meta">Country:</div> <div class="description"><?php echo $Country ?></div>
          </div>
		  <div class="summary">
            <div class="meta">Website:</div> <div class="description"><?php echo $Website ?></div>
          </div>
        </div>
</div>
</div>
<div class="six wide column">
<div class="ui fluid card">
  <div class="content">
    <div class="header">Most recent uploaded video:</div>
  </div>
          <div class="content">
			<div>
				<iframe style='outline: 0px solid transparent;' src='./player.php?v=<?php echo $LastestVideo ?>' width='100%' height='320' frameBorder='0' scrolling='no' debug='true'></iframe>
			</div>
          </div>
</div>
</div>
<div class="three wide right floated column" style="width:250px !important;">
<div class="ui fluid card">
  <div class="content">
    <div class="header">Uploaded videos</div>
  </div>
	<div class="ui center aligned grid">
		<div class="twenty wide column">
			<div class="content">
					<?php				
$x = 1; 
$sql = mysqli_query($connect, "SELECT * FROM videodb ORDER by `UploadDate` DESC"); //instructions for sql

while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
if ($x == 3) {
	break;
}
$idvideolist = $fetch['VideoID'];
$lengthlist = 0;
if($fetch['VideoLength'] > 3600) {
	$lengthlist = floor($fetch['VideoLength'] / 3600) . ":" . gmdate("i:s", $fetch['VideoLength'] % 3600);
} else { 
	$lengthlist = gmdate("i:s", $fetch['VideoLength'] % 3600) ;
};
$namevideolist = htmlspecialchars($fetch['VideoName']);
$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
$viewsvideolist = $fetch['ViewCount'];
$uploadedvideolist = htmlspecialchars($fetch['UploadDate']);

if ($uploadervideolist == $user) {
	if (!($fetch['isApproved'] == 2)) {
		echo "<div class='center aligned item'>
			<div class='image' style=\"display: grid;\">
				<div class='ui basic compact fitted segment'>
				  <div class='ui black bottom right attached label' style=\"margin-right: 22px;\">".$lengthlist."</div>
				  <a href='watch.php?v=$idvideolist'>
					<img width='180' height='140' src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\">
				  </a>
				</div>
			</div>
			<div class='content'>
			  <a href='watch.php?v=$idvideolist' class='header'>$namevideolist</a>
			  <div class='extra'>
			  Uploaded on $uploadedvideolist<br>
			  </div>
			  <br/>
			</div>
		  </div>";
		$x++;
	}
}
}
?>
          </div>
		</div>
	</div>
		<div class="extra content">
			<a class="right floated" href="profile_videos.php?user=<?php echo $user;?>">
				<i class="arrow circle right icon"></i>
				View more
			</a>
		</div>
</div>
</div>
</div>
</div>
</div>

<?php include("footer.php"); ?>