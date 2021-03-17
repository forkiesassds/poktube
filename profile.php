<?php 
require_once __DIR__ . '/lib/PHPColors/Color.php';
use Mexitek\PHPColors\Color;
include("header.php"); 

if(isset($_GET["user"])) {
$user = $_GET["user"];
}

//if $FeaturedVideo is null then dont show anything
if (!isset($_GET["user"])) {
die();
}

$vidfetch = mysqli_query($connect, "SELECT * FROM videodb");
$vdf = mysqli_fetch_assoc($vidfetch);
$Uploader = htmlspecialchars($vdf['Uploader']); // get all video information
$VideoName = htmlspecialchars($vdf['VideoName']);
$ViewCount = $vdf['ViewCount'];
$PreUploadDate = htmlspecialchars($vdf['UploadDate']);
$VideoDesc = nl2br(htmlspecialchars($vdf['VideoDesc']));

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
$Foreground = htmlspecialchars($cdf['channel_color']);
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

if($cdf['channel_color']) {
	$Foreground = htmlspecialchars($cdf['channel_color']);
} else {
	$Foreground = "#003366";
}

?>
<style>
.headerPROF {
    position: relative;
    width: 100%;
    height: 150px;
	<?= $color->getCssGradient(10, true)?>
	padding: none;
	text-align: center;
	padding-top: 10px;
	margin-top: -5px;
	padding-bottom: 10px;
	border: solid 1px #555;
	border-radius: 10px;
}
</style>

<meta name="title" content="<?php echo $Username ?>'s Channel">
<meta name="description" content="<?php echo $AboutMe ?>">
<title><?php echo $Username ?> - PokTube</title>
<div style="padding: 0px 5px 0px 5px;">
<div class="headerPROF">
<img src="content/profpic/<?php echo $Username?>.png" onerror="this.src='img/profiledef.png'" class="thumb" width="128" style="border: solid white 3px;width: 128px;height: 128px">
<div style="font-size: 14px; font-weight: bold; color:#FFFFFF; margin-bottom: 5px;"><?php echo $Username ?></div>
</div>


<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr valign="top">
		
		<td style="padding: 0px 10px 0px 10px;">
		
		<table width="100%" cellpadding="5" cellspacing="0" border="0">
			<tr>
				<td width="120" align="right"><span class="label">User Name:</span></td>
				<td><?php echo $Username ?></td>
			</tr>
		
			<!-- Personal Information: -->
			
					
					
						<tr>
				<td align="right"><span class="label">Name:</span></td>
				<td><?php echo stripslashes($Name) ?></td>
			</tr>
			
			<tr valign="top">
				<td align="right"><span class="label">Age:</span></td>
				<td><?php echo stripslashes($Age) ?></td>
			</tr>
					
					
					
						<tr valign="top">
				<td align="right"><span class="label">About Me:</span></td>
				<td><?php echo stripslashes($AboutMe) ?></td>
			</tr>
					
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			
			
			
			<!-- Location Information -->
			

			<tr valign="top">
				<td align="right"><span class="label">Hometown:</span></td>
				<td><?php echo stripslashes($Hometown) ?></td>
			</tr>
			
			<tr valign="top">
			<td align="right"><span class="label">Current City:</span></td>
			<td><?php echo stripslashes($City) ?></td>
					
			<tr valign="top">
			<td align="right"><span class="label">Country:</span></td>
			<td><?php echo stripslashes($Country) ?></td>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			
			
			
			<!-- Random Information -->
			<tr valign="top">
			<td align="right"><span class="label">Personal Website:</span></td>
			<td><a href="<?php echo $Website ?>"><?php echo $Website ?></a></td>		
					
					
					
					
					
					
			<tr>
				<td align="right"><span class="label"></span></td>
				<td></td>
			</tr>
		</table>
		
		</td>
			
		<td width="180">
		
		<div style="font-size: 14px; font-weight: bold; margin-bottom: 10px; color: #444;">&#187; Profile</div>
		<div style="font-size: 14px; font-weight: bold; margin-bottom: 10px; color: #444;">&#187; <a href="profile_videos.php?user=<?php echo $Username ?>">Public Videos</a> (0)</div>
		<!-- only show this link to friends in their network -->
		<div style="font-size: 14px; font-weight: bold; margin-bottom: 10px; color: #444;">&#187; <a href="profile_videos_private.php?user=<?php echo $Username ?>">Private Videos</a> (0)</div>
		<!-- only show this link to friends in their network -->
		<div style="font-size: 14px; font-weight: bold; margin-bottom: 10px; color: #444;">&#187; <a href="profile_favorites.php?user=<?php echo $Username ?>">Favorites</a> (0)</div>
		<div style="font-size: 14px; font-weight: bold; margin-bottom: 20px; color: #444;">&#187; <a href="profile_friends.php?user=<?php echo $Username ?>">Friends</a> (0)</div>
		

		
		<div style="font-size: 12px; color: #444; margin: 10px 0px 0px 0px; text-align: center;"><strong>Like my videos?</strong><br>
		<a href="#">Subscribe to my RSS Feed.</a></div>
		
		</td>

			
	</tr>
</table>

		</div>
		</td>
	</tr>
</table>
<?php include("footer.php"); ?>