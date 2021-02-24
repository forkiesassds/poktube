<?php 
include("header.php"); 

if(isset($_GET["user"])) {
$user = $_GET["user"];
}

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
$Occupation = htmlspecialchars($cdf['prof_occupation']);
$Interests = htmlspecialchars($cdf['prof_interests']);
$Music = htmlspecialchars($cdf['prof_music']);
$Books = htmlspecialchars($cdf['prof_books']);
$Movies = htmlspecialchars($cdf['prof_movies']);
$Foreground = htmlspecialchars($cdf['channel_color']);
$Background = htmlspecialchars($cdf['channel_bg']);
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
	background-image: linear-gradient(<?php echo $Foreground?>, #000000);
    text-align: right;

}

.ui.padded.grid:not(.vertically):not(.horizontally) {
	position: relative !important;
	bottom: 125px;
}
</style>
<meta name="title" content="<?php echo $Username ?>'s Channel">
<meta name="description" content="<?php echo $AboutMe ?>">
<title><?php echo $Username ?> - PokTube</title>
<body>
<div class="headerPROF">Placeholder !!! Add proper functional CSS calculations - CHAZIZ FEB 23 2021 9:32 PM EST</div>
<div style="padding: 0px 5px 0px 5px;">
<div class="two column stackable ui padded grid">
<div class="two wide column">
<div class="ui card">
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
<div class="ui card">
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
</div>
</div>
</div>


<?php include("footer.php"); ?>