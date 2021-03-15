<?php 
session_start(); 
include("db.php");
$datenow = date("Y-m-d");
if(isset($_SESSION["username"])) {
$username = htmlspecialchars($_SESSION["username"]);
$detail = mysqli_query($connect, "SELECT * FROM users WHERE username='". $username ."'"); // selects details of user
$detail2 = mysqli_fetch_assoc($detail); // function for getting details of user
$isAdmin = $detail2['is_admin'];
if ($detail2["registeredon"] == null) {
	$stmt = $connect->prepare("UPDATE users SET registeredon = ? WHERE username = ?"); // prepares sql commands in prepared statement
	$stmt->bind_param("ss", $datenow, $username);
	$stmt->execute(); // this is to remove SQL injection, and to update the last online date.
}
}
?>
<head>
<link rel="stylesheet" href="main.css" type="text/css">
<link rel="stylesheet" href="styles.css" type="text/css">
<link rel="stylesheet" href="base_all-vfl70436.css" type="text/css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<meta name="theme-color" content="#f28900">
<meta name="description" content="Share your videos with friends and family">
<meta property="og:image" content="/img/icon.png">
<meta name="keywords" content="video,sharing,camera phone,video phone">
</head>
<!---- header start ----->
<div id="baseDiv" class="date-20090101 video-info">
<div id="masthead">
<a href="/web/20090101130443/http://youtube.com/" onmousedown="urchinTracker('/Events/Header_3/YouTubeLogo');" class="logo"><img src="https://web.archive.org/web/20090101130443im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" alt="" border="0"></a>
<div id="non-logo-masthead">
			<div id="top-margin-links-wrapper">
				<div id="lang-locale-picker-links-wrapper">
					<img class="slogan" src="https://web.archive.org/web/20090101130443im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" alt="">
					
		<span class="util-item first with-flag"><a href="#" class="contentRegionPickerLink hLink" onclick="loadFlagImgs();toggleDisplay('contentRegionPickerBox');return false;" onmousedown="urchinTracker('/Events/Header/UtilLinks/I18n/text');">Worldwide</a></span>
		<span class="util-item"><a href="#" class="uiLanguagePickerLink hLink" onclick="loadFlagImgs();toggleDisplay('uiLanguagePickerBox');return false;" onmousedown="urchinTracker('/Events/Header/UtilLinks/I18n/text');">English</a></span>

				</div>

				<div class="user-info">
					




	<div id="util-links" class="normal-utility-links">

		<span class="util-item first"><b><a class="hLink" href="	/signup?next=/
" onclick="_hbLink('SignUp','UtilityLinks');" onmousedown="urchinTracker('/Events/Header/UtilLinks/SignUp');">Sign Up</a></b></span>
		<span class="util-item"><a class="hLink" href="/web/20090101130443/http://youtube.com/watch_queue?all" onmousedown="urchinTracker('/Events/Header/UtilLinks/QuickList');">QuickList</a> (<span id="quicklist-utility">0</span>)</span>
		<span class="util-item"><a class="hLink" href="https://web.archive.org/web/20090101130443/http://help.youtube.com/support/youtube/bin/static.py?page=start.cs&amp;hl=en-US" onmousedown="urchinTracker('/Events/Header/UtilLinks/Help');">Help</a></span>
			<span class="util-item"><a class="hLink" href="		/login?next=/
" onmousedown="urchinTracker('/Events/Header/UtilLinks/SignIn');">Sign In</a></span>
	</div>

	<form name="logoutForm" method="post" target="_top" action="/web/20090101130443/http://youtube.com/index">
		<input type="hidden" name="action_logout" value="1">
	<input name="session_token" type="hidden" value="V8Z5yjv5ol84fVYzIH3QaF_3OOZ8MTIzMDkwMTQ4Mw=="></form>


				</div>

			</div>

				<div id="contentRegionPickerBox">
		<div class="picker-top">
			<div class="box-close-link"><a class="eLink" href="#" onclick="hideDiv('contentRegionPickerBox'); return false;">Close</a><img onclick="hideDiv('contentRegionPickerBox');" src="https://web.archive.org/web/20090101130443im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" alt="Close"></div>
			<h2>Set Your Country Content Preference <a href="#" class="eLink picker-help-link" onclick="toggleDisplay('region-picker-help'); return false;">(What is this?)</a></h2>
				<div id="region-picker-help">Choose which country's videos, channels, and activity filters (for example, "Most Viewed"), you would like to view.</div> 
			<div class="clearR"></div>
		</div>
	<div class="flagDiv">
			<script type="text/javascript">
				var gContentRegions = [
				[
				['en_US','US','Worldwide (All)']				
				]
									,				[
				['en_AU','AU','Australia']									,				['en_CA','CA','Canada']									,				['en_IN','IN','India']									,				['en_IE','IE','Ireland']									,				['en_NZ','NZ','New Zealand']									,				['en_GB','GB','UK']				
				]
									,				[
				['pt_BR','BR','Brazil']									,				['cs_CZ','CZ','Czech Republic']									,				['de_DE','DE','Germany']									,				['es_ES','ES','Spain']									,				['fr_FR','FR','France']									,				['zh_HK','HK','Hong Kong']									,				['en_IL','IL','Israel']									,				['it_IT','IT','Italy']									,				['ja_JP','JP','Japan']									,				['ko_KR','KR','South Korea']									,				['es_MX','MX','Mexico']									,				['nl_NL','NL','Netherlands']									,				['pl_PL','PL','Poland']									,				['ru_RU','RU','Russia']									,				['sv_SE','SE','Sweden']									,				['zh_TW','TW','Taiwan']				
				]
				
				];
			</script>
			<div id="flagDivInnerContentRegion">
			</div>
	</div>
	</div>

				<div id="uiLanguagePickerBox">
		<div class="picker-top">
			<div class="box-close-link"><a class="eLink" href="#" onclick="hideDiv('uiLanguagePickerBox'); return false;">Close</a><img onclick="hideDiv('uiLanguagePickerBox');" src="https://web.archive.org/web/20090101130443im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif" alt="Close"></div>
			<h2>Set Your Language Preference <a href="#" class="eLink picker-help-link" onclick="toggleDisplay('language-picker-help'); return false;">(What is this?)</a></h2>
			<div id="language-picker-help">Choose the language in which you want to view YouTube. This will only change the interface, not any text entered by other users.</div>
			<div class="clearR"></div>
		</div>
	<div class="flagDiv">
			<script type="text/javascript">
				var gUILanguages = [
				['de','Deutsch']									,				['en-GB','English (UK)']									,				['en','English (US)']									,				['es','Español (España)']									,				['es-MX','Español (Latinoamérica)']									,				['fr','Français']									,				['it','Italiano']									,				['nl','Nederlands']									,				['pl','Polski']									,				['pt','Português (Brasil)']									,				['ru','Pyccĸий']									,				['sv','Svenska']									,				['cs','Čeština']									,				['zh-CN','中文 (简体)']									,				['zh-TW','中文 (繁體)']									,				['ja','日本語']									,				['ko','한국어']				
				];
			</script>
			<div id="flagDivInnerUILanguage">
			</div>
	</div>
	</div>

		</div>
<table class="header1" width="100%" bgcolor="#0049C7" cellpadding="0" style="padding: 5px 0px 0px 0px;" cellspacing="0" border="0">
	<tr valign="top">
		<td width="130" rowspan="2" style="padding: 0px 5px 5px 5px;"><a href="index.php"><img src="img/logo.png" alt="PokTube" border="0"></a></td>
		<td valign="top">
		<table align="right" width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr valign="top">
			<td align="left" class="headertext" style="padding: 0px 5px 0px 5px; font-style: italic;">Upload your videos online!</td>
				<td align="right">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<?php if(isset($_SESSION["username"])) {
		echo "<td><b class='headertext'>Hello, <div style=\"font-size: 12px; font-weight: bold; float: right; padding: 0px 5px 0px 5px; font-size: 12px; font-weight: bold; float: right; margin: -2px 0px 0px 0px;\"><img src=\"content/profpic/" . $_SESSION["username"] . ".png\" onerror=\"this.src='img/profiledef.png'\" width=\"18\" height=\"18\"></div>".$username."</a></b></td>
		<td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a class='headertext' href='profile.php?user=" . $_SESSION["username"] ."'>My Profile</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a class='headertext' href='logout.php'>Log Out</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a class='headertext' href='my_profile.php'>Settings</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td style='padding-right: 5px;'><a class='headertext' href='help.php'>Help</a></td>";
	} else {
		echo "<td><a class='headertext' href='signup.php'><strong>Sign Up</strong></a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td><a class='headertext' href='login.php'>Log In</a></td>
<td style='padding: 0px 5px 0px 5px;'>|</td>
<td style='padding-right: 5px;'><a class='headertext' href='help.php'>Help</a></td>";
	}?>

				
			</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
	</tr>

		<tr>
		<td width="100%">
		
		<?php if(isset($_SESSION["username"])) {
		echo "<div style=\"font-size: 12px; font-weight: bold; float: right; padding: 1px 5px 0px 5px;\"><a href=\"my_videos_upload.php\"><img src=\"img/pic_upload_130x28.png\" alt=\"Upload Videos\"></a>";
		} else {
			echo "";}?>
		<!--&nbsp;//&nbsp; <a href="browse.php">Browse</a>--></div>
		
		<table cellpadding="2" cellspacing="0" border="0">
			<tr>
				<form method="GET" action="results.php">
				<td>
					<input type="text" value="" name="search" size="30" maxlength="128" style="color:#e67402; font-size: 14px; padding: 2px;">
				</td>
				<td>
					<input class="button" type="submit" value="Search Videos">
				</td>
				</form>
			</tr>
		</table>
		
		</td>
	</tr>

			
</table>
		<div class="bar">
				<div id="upload-wrapper">			
		<span id="upload-button" class="action-button">
			<a href="my_videos_upload.php" onmousedown="urchinTracker('/Events/Header/UploadButton');">
				<span class="action-button-leftcap"></span>
				<span class="action-button-text">Upload</span>
			</a>
			<span class="action-button-dropcap" onmouseover="setDisplay(_gel('upload-menu'), true); return false;" onmouseout="setDisplay(_gel('upload-menu'), false); return false;">
				<img src="https://web.archive.org/web/20090101130443im_/http://s.ytimg.com/yt/img/pixel-vfl73.gif">
				<div id="upload-menu" class="action-button-menu">
					<a href="/web/20090101130443/http://youtube.com/my_videos_upload" onmousedown="urchinTracker('/Events/Header/UploadButton');">Video File</a>
					<a href="/web/20090101130443/http://youtube.com/my_videos_quick_capture" onmousedown="urchinTracker('Events/Header/QuickCaptureButton');">Quick Capture</a>
				</div>
			</span>
			<!--<span class="action-button-rightcap"></span>-->
		</span>
	</div>

				<form autocomplete="off" class="search-form" action="/web/20090101130443/http://youtube.com/results" method="get" name="searchForm">
		<div class="search-wrapper">
			<input id="masthead-search-term" class="search-term" name="search_query" type="text" tabindex="1" onkeyup="top.goog.i18n.bidi.setDirAttribute(event,this)" value="" maxlength="128" autocomplete="off">
			<input id="search-type-masthead" name="search_type" type="hidden" value="">
			<div id="masthead-search-container">
				<a href="#" tabindex="2" onclick="document.searchForm.submit(); return false;">
					<span class="search-left-cap"></span>
					<span class="search-button-text">Search</span>
					<span class="search-right-cap"></span>
				</a>
			</div>
		</div>
	<input type="hidden" name="aq" value="f"><input type="hidden" name="oq" value="" disabled=""></form>
			<a class="nav-item" href="index.php">Home</a>
			<a class="nav-item" href="browse.php">Videos</a>
			<a class="nav-item" href="https://discord.gg/FAEEuMhn3M">Discord</a>
			<?php 
if(isset($_SESSION["username"])) {
if($isAdmin == 1) // is logged in?
{
echo "<a class='nav-item' href='admin.php'>Admin</a>";
}
else
{
    echo "";
}
}?>
		</div>
		<br>
<!---- header end ----->