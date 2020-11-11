<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>YouTube - Your Digital Video Repository</title>
<link rel="icon" href="/web/20050701000942im_/http://www.youtube.com/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/web/20050701000942im_/http://www.youtube.com/favicon.ico" type="image/x-icon">
<link href="http://localhost/poktube/styles.css" rel="stylesheet" type="text/css">
<link rel="alternate" type="application/rss+xml" title="YouTube " "="" recently="" added="" videos="" [rss]"="" href="https://web.archive.org/web/20050701000942/http://www.youtube.com/rss/global/recently_added.rss">
</head>


<body onload="javascript:sf();" return="" false;="">

<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#D5E5F5" align="center">
	<tbody><tr>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/box_login_tl.gif" width="5" height="5"></td>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/pixel.gif" width="1" height="5"></td>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/box_login_tr.gif" width="5" height="5"></td>
	</tr>
	<tr>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/pixel.gif" width="5" height="1"></td>
		
		<td width="100%">

		<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tbody><tr>
					<td>
										<table cellspacing="0" cellpadding="2" border="0">
						<tbody><tr>
							<td>&nbsp;<a href="index.php" class="bold">Home</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="my_videos.php">My Videos</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="my_favorites.php">My Favorites</a></td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="my_messages.php">My Messages</a>
														</td>
							<td>&nbsp;|&nbsp;</td>
							<td><a href="my_profile.php">My Profile</a></td>
						</tr>
					</tbody></table>
					</td>
				</tr>
			</tbody></table>
			
			</td>
	
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/pixel.gif" width="5" height="1"></td>
	</tr>
	<tr>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/box_login_bl.gif" width="5" height="5"></td>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/pixel.gif" width="1" height="5"></td>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/box_login_br.gif" width="5" height="5"></td>
	</tr>
</tbody></table>

<div class="tableLinkBar">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tbody><tr>
	
		<?php
session_start(); // Right at the top of your script
?>
  <?php 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    //echo $_SESSION['username'] . $_SESSION['username'] . "!";
	$txt1 = "Learn PHP";
	echo '<td width="100%" align="right">
		<table cellspacing="0" cellpadding="2" border="0" align="right">
			<tbody><tr>
							<td><a href="register.php" class="bold">My Profile</a></td>
				<td>&nbsp;|&nbsp;</td>
				<td><a href="logout.php">Log Out</a></td>
				<td>&nbsp;|&nbsp;</td>
				<td><a href="help.php">Help</a>&nbsp;</td>
						</tr>
		</tbody></table>
		</td>';
} else {
    echo '<td width="100%" align="right">
		<table cellspacing="0" cellpadding="2" border="0" align="right">
			<tbody><tr>
							<td><a href="register.php" class="bold">Sign Up</a></td>
				<td>&nbsp;|&nbsp;</td>
				<td><a href="login.php">Log In</a></td>
				<td>&nbsp;|&nbsp;</td>
				<td><a href="help.php">Help</a>&nbsp;</td>
						</tr>
		</tbody></table>
		</td>';
}
  ?>
	</tr>

		
</tbody></table></div>


<script>
	function sf()
	{
		document.f.search.focus();
	}
</script>

<table width="80%" cellspacing="0" cellpadding="3" border="0" align="center">
	<tbody><tr>
		<td align="center">
			<img src="img/logo.gif" alt="YouTube" width="180" vspace="12" hspace="12" height="71">
			<br>
			Your Digital Video Repository
			<?php
			echo $_SESSION["username"];
			?>
			<br>
			<br>
		</td>
	</tr>

	<form name="f" method="GET" action="results.php"></form>
	<tr>
		<td align="center"><input type="text" name="search" size="35" maxlength="128" style="color:#ff3333; font-size: 18px; padding: 3px;"></td>
	</tr>
	<tr>
		<td align="center"><input type="submit" value="Search Videos"></td>
	</tr>
	
</tbody></table>

<div style="font-size: 16px; font-weight: bold; margin-top: 20px; margin-bottom: 20px; text-align: center;"><a href="my_videos_upload.php">Upload Your Videos</a></div>

<br>

<div style="font-size: 13px; color: #333333; margin-bottom: 30px; text-align: center; width: 50%; margin-left: auto; margin-right: auto;">


	<a style="font-size: 12px;" href="results.php?search=nansheng">nansheng</a> :

	
	<a style="font-size: 12px;" href="results.php?search=azlan">azlan</a> :

	
	<a style="font-size: 12px;" href="results.php?search=wereldband">wereldband</a> :

	
	<a style="font-size: 17px;" href="results.php?search=ny">ny</a> :

	
	<a style="font-size: 17px;" href="results.php?search=superbike">superbike</a> :

	
	<a style="font-size: 12px;" href="results.php?search=japan">japan</a> :

	
	<a style="font-size: 12px;" href="results.php?search=sinceretheory">sinceretheory</a> :

	
	<a style="font-size: 17px;" href="results.php?search=jozef">jozef</a> :

	
	<a style="font-size: 17px;" href="results.php?search=party">party</a> :

	
	<a style="font-size: 12px;" href="results.php?search=amazon">amazon</a> :

	
	<a style="font-size: 12px;" href="results.php?search=board">board</a> :

	
	<a style="font-size: 12px;" href="results.php?search=skate">skate</a> :

	
	<a style="font-size: 12px;" href="results.php?search=buckley">buckley</a> :

	
	<a style="font-size: 12px;" href="results.php?search=shubs">shubs</a> :

	
	<a style="font-size: 12px;" href="results.php?search=falls">falls</a> :

	
	<a style="font-size: 12px;" href="results.php?search=de">de</a> :

	
	<a style="font-size: 12px;" href="results.php?search=stockshot">stockshot</a> :

	
	<a style="font-size: 12px;" href="results.php?search=cubbyhole">cubbyhole</a> :

	
	<a style="font-size: 12px;" href="results.php?search=burnout">burnout</a> :

	
	<a style="font-size: 12px;" href="results.php?search=satellite">satellite</a> :

	
	<a style="font-size: 12px;" href="results.php?search=poughkeepsie">poughkeepsie</a> :

	
	<a style="font-size: 12px;" href="results.php?search=cruise">cruise</a> :

	
	<a style="font-size: 12px;" href="results.php?search=heritage">heritage</a> :

	
	<a style="font-size: 17px;" href="results.php?search=orgel">orgel</a> :

	
	<a style="font-size: 12px;" href="results.php?search=chin">chin</a> :

	
	<a style="font-size: 12px;" href="results.php?search=themed">themed</a> :

	
	<a style="font-size: 17px;" href="results.php?search=mill">mill</a> :

	
	<a style="font-size: 12px;" href="results.php?search=music">music</a> :

	
	<a style="font-size: 12px;" href="results.php?search=new">new</a> :

	
	<a style="font-size: 12px;" href="results.php?search=live">live</a> :

	
	<a style="font-size: 17px;" href="results.php?search=to">to</a> :

	
	<a style="font-size: 12px;" href="results.php?search=farmer">farmer</a> :

	
	<a style="font-size: 17px;" href="results.php?search=mtv">mtv</a> :

	
	<a style="font-size: 12px;" href="results.php?search=puenbrouck">puenbrouck</a> :

	
	<a style="font-size: 12px;" href="results.php?search=sicily">sicily</a> :

	
	<a style="font-size: 17px;" href="results.php?search=fairfield">fairfield</a> :

	
	<a style="font-size: 17px;" href="results.php?search=musical">musical</a> :

	
	<a style="font-size: 17px;" href="results.php?search=coffeehouse">coffeehouse</a> :

	
	<a style="font-size: 17px;" href="results.php?search=bud">bud</a> :

	
	<a style="font-size: 17px;" href="results.php?search=2005">2005</a> :

	
	<a style="font-size: 17px;" href="results.php?search=trip">trip</a> :

	
	<a style="font-size: 12px;" href="results.php?search=jfk">jfk</a> :

	
	<a style="font-size: 12px;" href="results.php?search=woordjes">woordjes</a> :

	
	<a style="font-size: 12px;" href="results.php?search=death">death</a> :

	
	<a style="font-size: 12px;" href="results.php?search=xlanz">xlanz</a> :

	
	<a style="font-size: 12px;" href="results.php?search=skill">skill</a> :

	
	<a style="font-size: 12px;" href="results.php?search=olle">olle</a> :

	
	<a style="font-size: 12px;" href="results.php?search=nature">nature</a> :

	
	<a style="font-size: 12px;" href="results.php?search=ads">ads</a> :

	
	<a style="font-size: 17px;" href="results.php?search=dance">dance</a> :

	
<div style="font-size: 14px; font-weight: bold; margin-top: 10px;"><a href="tags.php">See More Tags</a></div>

</div>
		
<table width="80%" cellspacing="0" cellpadding="0" border="0" bgcolor="#CCCCCC" align="center">
	<tbody><tr>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/box_login_tl.gif" width="5" height="5"></td>
		<td width="100%"><img src="/web/20050701000942im_/http://www.youtube.com/img/pixel.gif" width="1" height="5"></td>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/box_login_tr.gif" width="5" height="5"></td>
	</tr>
	<tr>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/pixel.gif" width="5" height="1"></td>
		<td>
		<div class="moduleTitleBar">
		<div class="moduleTitle"><div style="float: right; padding-right: 5px;"><a href="videos_page.php">&gt;&gt;&gt; Watch More Videos</a></div>
		Featured Videos
		</div>
		</div>
				
		<div class="moduleFeatured"> 
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tbody><tr valign="top">

					
						<td width="20%" align="center"><a href="index.php?v=_QBPp6zso7g"><img src="/web/20050701000942im_/http://www.youtube.com/get_still.php?still_id=2&amp;video_id=_QBPp6zso7g" class="moduleFeaturedThumb" width="120" height="90"></a>
						<div class="moduleFeaturedTitle"><a href="index.php?v=_QBPp6zso7g">Denny's</a></div>
						<div class="moduleFeaturedDetails">Added: June 14, 2005						<br>by <a href="profile.php?user=jrhyley">jrhyley</a><!-- (<a href="profile.php?user=jrhyley">10</a>) --></div>
						<div class="moduleFeaturedDetails">Views: 86 | Comments: 1</div></td>

						
						<td width="20%" align="center"><a href="index.php?v=Eq2ObjmGSD8"><img src="/web/20050701000942im_/http://www.youtube.com/get_still.php?still_id=2&amp;video_id=Eq2ObjmGSD8" class="moduleFeaturedThumb" width="120" height="90"></a>
						<div class="moduleFeaturedTitle"><a href="index.php?v=Eq2ObjmGSD8">On top of the world!</a></div>
						<div class="moduleFeaturedDetails">Added: May 3, 2005						<br>by <a href="profile.php?user=jawed">jawed</a><!-- (<a href="profile.php?user=jawed">10</a>) --></div>
						<div class="moduleFeaturedDetails">Views: 82 | Comments: 0</div></td>

						
						<td width="20%" align="center"><a href="index.php?v=NYVk34eItx8"><img src="/web/20050701000942im_/http://www.youtube.com/get_still.php?still_id=2&amp;video_id=NYVk34eItx8" class="moduleFeaturedThumb" width="120" height="90"></a>
						<div class="moduleFeaturedTitle"><a href="index.php?v=NYVk34eItx8">Trabajo</a></div>
						<div class="moduleFeaturedDetails">Added: June 27, 2005						<br>by <a href="profile.php?user=HaoT">HaoT</a><!-- (<a href="profile.php?user=HaoT">10</a>) --></div>
						<div class="moduleFeaturedDetails">Views: 3 | Comments: 0</div></td>

						
						<td width="20%" align="center"><a href="index.php?v=ivi5mnb6xfA"><img src="/web/20050701000942im_/http://www.youtube.com/get_still.php?still_id=2&amp;video_id=ivi5mnb6xfA" class="moduleFeaturedThumb" width="120" height="90"></a>
						<div class="moduleFeaturedTitle"><a href="index.php?v=ivi5mnb6xfA">Dance Luke &amp; Kylie DANCE!!</a></div>
						<div class="moduleFeaturedDetails">Added: June 28, 2005						<br>by <a href="profile.php?user=WhitneyLee">WhitneyLee</a><!-- (<a href="profile.php?user=WhitneyLee">10</a>) --></div>
						<div class="moduleFeaturedDetails">Views: 15 | Comments: 0</div></td>

						
						<td width="20%" align="center"><a href="index.php?v=dySCz5rPK4E"><img src="/web/20050701000942im_/http://www.youtube.com/get_still.php?still_id=2&amp;video_id=dySCz5rPK4E" class="moduleFeaturedThumb" width="120" height="90"></a>
						<div class="moduleFeaturedTitle"><a href="index.php?v=dySCz5rPK4E">My "Special" Dance</a></div>
						<div class="moduleFeaturedDetails">Added: April 27, 2005						<br>by <a href="profile.php?user=cabmobile">cabmobile</a><!-- (<a href="profile.php?user=cabmobile">10</a>) --></div>
						<div class="moduleFeaturedDetails">Views: 144 | Comments: 0</div></td>

						
				</tr>
			</tbody></table>
		</div>
		
		</td>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/pixel.gif" width="5" height="1"></td>
	</tr>
	<tr>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/box_login_bl.gif" width="5" height="5"></td>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/pixel.gif" width="1" height="5"></td>
		<td><img src="/web/20050701000942im_/http://www.youtube.com/img/box_login_br.gif" width="5" height="5"></td>
	</tr>
</tbody></table>

<br><table cellpadding="10" border="0" bgcolor="#FFFFFF" align="center">
	<tbody><tr>
		<td valign="center" align="center"><span class="footer"><a href="about.php">About Us</a> | <a href="contact.php">Contact Us</a> | <a href="terms.php">Terms of Use</a> | <a href="privacy.php">Privacy Policy</a> | "Copyright" © 2020 PokTube, even though it might not be. | <a href="rss/global/recently_added.rss"><img src="https://web.archive.org/web/20050701000942im_/http://www.youtube.com/img/rss.gif" style="vertical-align: text-top;" width="36" height="14" border="0"></a></span></td>
	</tr>
</tbody></table>




</body></html>