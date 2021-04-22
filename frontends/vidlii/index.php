<?php include "header.php"?>
<main class="bottom_wrapper">
<section class="h_l">
<div class="wdg" id="ft_widget">
<div style="background:#dae9fe">
<a href="/special_videos?c=0&amp;t=v"><img src="https://i.r.worldssl.net/img/ft.png" alt="Featured Videos"><span>Featured Videos</span></a>
<div class="wdg_sel">
</div>
</div>
<div>
<div class="v_v_bx">
<?php
$sql = mysqli_query($connect, "SELECT * FROM videodb WHERE `isApproved` = '1' ORDER BY RAND() DESC LIMIT 4"); //instructions for sql, also WHERE with ORDER BY works, icty, you said that it didn't in FEB 24 2021, you're wrong.

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
$categoryvideolist = htmlspecialchars($fetch['VideoCategory']);
echo "<div>
<div class='th'>
<div class='th_t'>$lengthlist</div>
<a href='watch.php?v=$idvideolist'><img class='vid_th' onerror=\"this.src='/img/defaultVL.png'\" src='/content/thumbs/$idvideolist.png' alt='Vidlii Terrorism and Ashley2012 and BMF Coalition' title='Vidlii Terrorism and Ashley2012 and BMF Coalition' width='140' height='88'></a>
</div>
<a href='watch.php?v=$idvideolist' class='ba'>$namevideolist</a>
<div class='vw s'>$viewsvideolist views</div>
<a href='/user/ashleyhasdied' class='ch_l s'>$uploadervideolist</a>
<div class='s_r'><img src='img/full_star.png' width='14' height='13'><img src='img/full_star.png' width='14' height='13'><img src='img/full_star.png' width='14' height='13'><img src='img/full_star.png' width='14' height='13'><img src='img/full_star.png' width='14' height='13'></div>
</div>";
};
?>
</div>
</div>
</div>
<div class="wdg" id="most_popular">
<div>
<img src="https://i.r.worldssl.net/img/pop.png" alt="Most Popular Videos"><span>Most Popular</span>
<div class="wdg_sel">
</div>
</div>
<div>
<div class="mp_hr">
<div>
<a href="/videos?c=15&amp;o=re&amp;t=0">Nonprofits &amp; Activism</a>
<div class="th">
<div class="th_t">0:48</div>
<a href="/watch?v=ISA893cNgWB"><img class="vid_th" src="/usfi/thmp/ISA893cNgWB.jpg" alt="Metzitzah Bpeh" title="Metzitzah Bpeh" width="140" height="88"></a>
</div>
<div class="vr_i">
<a href="/watch?v=ISA893cNgWB" class="ln2">Metzitzah B'peh</a>
<div class="vw s">6 views</div>
<a href="/user/Jamesdow" class="ch_l s">Jamesdow</a>
<div class="s_r"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"></div>
</div>
</div>
<div>
<a href="/videos?c=4&amp;o=re&amp;t=0">Pets &amp; Animals</a>
<div class="th">
<div class="th_t">0:07</div>
<a href="/watch?v=EKXeLlHRcv4"><img class="vid_th" src="/usfi/thmp/EKXeLlHRcv4.jpg" alt="🐐" title="🐐" width="140" height="88"></a>
</div>
<div class="vr_i">
<a href="/watch?v=EKXeLlHRcv4" class="ln2">🐐</a>
<div class="vw s">18 views</div>
<a href="/user/Sanchez18" class="ch_l s">Sanchez18</a>
<div class="s_r"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="13"></div>
</div>
</div>
<div>
<a href="/videos?c=2&amp;o=re&amp;t=0">Autos &amp; Vehicles</a>
<div class="th">
<div class="th_t">4:59</div>
<a href="/watch?v=mXkJJaO36a2"><img class="vid_th" src="/usfi/thmp/mXkJJaO36a2.jpg" alt="Thomas, Percy and the Squeak" title="Thomas, Percy and the Squeak" width="140" height="88"></a>
</div>
<div class="vr_i">
<a href="/watch?v=mXkJJaO36a2" class="ln2">Thomas, Percy and the Squeak</a>
<div class="vw s">0 views</div>
<a href="/user/Osiris415" class="ch_l s">Osiris415</a>
<div class="s_r"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"></div>
</div>
</div>
<div>
<a href="/videos?c=11&amp;o=re&amp;t=0">News &amp; Politics</a>
<div class="th">
<div class="th_t">2:13</div>
<a href="/watch?v=-y5L74rCEwP"><img class="vid_th" src="/usfi/thmp/-y5L74rCEwP.jpg" alt="Incatenati ad un blocco di cemento la resistenza di due No Tav sul tetto del presidio di San Didero" title="Incatenati ad un blocco di cemento la resistenza di due No Tav sul tetto del presidio di San Didero" width="140" height="88"></a>
</div>
<div class="vr_i">
<a href="/watch?v=-y5L74rCEwP" class="ln2">Incatenati ad un blocco di cemento la resistenza di due No Tav sul tetto del presidio di San Didero</a>
<div class="vw s">0 views</div>
<a href="/user/LucianoDavi" class="ch_l s">LucianoDavi</a>
<div class="s_r"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"></div>
</div>
</div>
<div>
<a href="/videos?c=13&amp;o=re&amp;t=0">Education</a>
<div class="th">
<div class="th_t">1:15</div>
<a href="/watch?v=a4pHE3-8pXo"><img class="vid_th" src="/usfi/thmp/a4pHE3-8pXo.jpg" alt="Best and genuine Job opportunities in Dubai | i12wrk" title="Best and genuine Job opportunities in Dubai | i12wrk" width="140" height="88"></a>
</div>
<div class="vr_i">
<a href="/watch?v=a4pHE3-8pXo" class="ln2">Best and genuine Job opportunities in Dubai | i12wrk</a>
<div class="vw s">3 views</div>
<a href="/user/i12wrkseo" class="ch_l s">i12wrkseo</a>
<div class="s_r"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"></div>
</div>
</div>
<div>
<a href="/videos?c=14&amp;o=re&amp;t=0">Science &amp; Technology</a>
<div class="th">
<div class="th_t">9:03</div>
<a href="/watch?v=vGVtHsKzD24"><img class="vid_th" src="/usfi/thmp/vGVtHsKzD24.jpg" alt="La historia de Netscape Navigator" title="La historia de Netscape Navigator" width="140" height="88"></a>
</div>
<div class="vr_i">
<a href="/watch?v=vGVtHsKzD24" class="ln2">La historia de Netscape Navigator</a>
<div class="vw s">2 views</div>
<a href="/user/MasterJayanX" class="ch_l s">MasterJayanX</a>
<div class="s_r"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"></div>
</div>
</div>
<div>
<a href="/videos?c=6&amp;o=re&amp;t=0">Travel &amp; Events</a>
<div class="th">
<div class="th_t">5:42</div>
<a href="/watch?v=WCujBKTCrni"><img class="vid_th" src="/usfi/thmp/WCujBKTCrni.jpg" alt="50 SUBSCRIBERS! THANK YOU!" title="50 SUBSCRIBERS! THANK YOU!" width="140" height="88"></a>
</div>
<div class="vr_i">
<a href="/watch?v=WCujBKTCrni" class="ln2">50 SUBSCRIBERS! THANK YOU!</a>
<div class="vw s">18 views</div>
<a href="/user/FrailAlien" class="ch_l s">FrailAlien</a>
<div class="s_r"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/full_star.png" width="14" height="13"></div>
</div>
</div>
<div>
<a href="/videos?c=7&amp;o=re&amp;t=0">Gaming</a>
<div class="th">
<div class="th_t">12:16</div>
<a href="/watch?v=ESSBLan3wvh"><img class="vid_th" src="/usfi/thmp/ESSBLan3wvh.jpg" alt="Call of duty Black ops 2 zombies-saw furret,mario, and Lost Foot[Funny Moments]" title="Call of duty Black ops 2 zombies-saw furret,mario, and Lost Foot[Funny Moments]" width="140" height="88"></a>
</div>
<div class="vr_i">
<a href="/watch?v=ESSBLan3wvh" class="ln2">Call of duty Black ops 2 zombies-saw furret,mario, and Lost Foot[Funny Moments]</a>
<div class="vw s">2 views</div>
<a href="/user/TailslyMoxFox" class="ch_l s">TailslyMoxFox</a>
<div class="s_r"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"><img src="https://www.vidlii.com/img/no_star.png" width="14" height="13"></div>
</div>
</div>
</div>
</div>
</div>
</section>
<aside class="h_r">
<div style="text-align:center;">
<script async="" src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8433080377364721" data-ad-slot="7129467293" data-ad-format="auto"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<div class="mv_wr">
<div style="height: 250px; border: 0px none; border-radius: 0px; padding: 0px 0px 32px;">
<script id="heightAdjust">
	if (!window.videoInfo)
		var videoInfo = {};

	function adjustHeight(n) {
		var height;
		var par = $("#heightAdjust").parent();
		if (par[0].style.height) {
			height = par.height();
			par.height(height+n);
		}
	}
	
	// Easier way of setting cookies
	function setCookie(name, value) {
		var CookieDate = new Date;
		CookieDate.setFullYear(CookieDate.getFullYear() + 10);
		document.cookie = name+'='+value+'; expires=' + CookieDate.toGMTString( ) + '; path=/';
	}

	// Easier way of getting cookies
	function getCookie(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i <ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
	
	function getTimeHash() {
		var h = 0;
		var st = 0;
		
		if ((h = window.location.href.indexOf("#t=")) >= 0) {
			st = window.location.href.substr(h+3);
			return parseInt(st);
		}
		
		return 0;
	}
	
	var vlpColors = "teal,white";
	vlpColors = vlpColors.split(",");
	
			var viValues = {
		variable: "vlp",
		src: "https://www.vidlii.com/usfi/v/wde1G--04Xi.112iwPRO_heL6fpMt9pPqYHOKLbvK1J6Xim_sSDigBPtwNQeYlHHm_Dmp3QL7HJEPSqzpPjd8MRD3Bw1.mp4",
		hdsrc: "https://www.vidlii.com/usfi/v/wde1G--04Xi.112iwPRO_heL6fpMt9pPqYHOKLbvK1J6Xim_sSDigBPtwNQeYlHHm_Dmp3QL7HJEPSqzpPjd8MRD3Bw1.720.mp4",
		img: "/usfi/thmp/wde1G--04Xi.jpg",
		url: "wde1G--04Xi",
		duration: 35,
		autoplay: false,
		skin: "2007HD",
		btcolor: vlpColors[0],
		bgcolor: vlpColors[1],
		adjust: true,
		start: getTimeHash()
	};
	
	for (var i in viValues) {
		if (videoInfo[i] === void(0)) {
			videoInfo[i] = viValues[i];
		}
	}
	</script>

<div class="vlPlayer vlPlayer2007 tealBt initialized hideVol compact" style="padding-bottom: 32px;" tabindex="0">
<div class="vlPreload"><input type="text" tabindex="-1"></div><div class="vlScreenContainer"><div class="vlScreen"><div class="vlPreview" style="background-image: url(&quot;/usfi/thmp/wde1G--04Xi.jpg&quot;);"></div><div class="vlsLoad"></div><div class="vlsPlay vlButton"></div><video></video></div></div><div class="vlControls"><div class="vlcLeft"><div class="vlcPlay vlButton"></div><div class="vlcStop vlButton"></div></div><div class="vlcRight"><div class="vlTimer"><span class="vltPos">00:00</span> / <span class="vltDur">00:35</span></div><div class="vlSeparator"></div><span class="vlcSoundContainer"><span class="vlcSoundContainerAbsolute"><div class="vlcSoundBar"><div class="vlcSoundSlider vlButton"></div></div></span><div class="vlcSound vlButton"></div></span><div class="vlSeparator"></div><div class="vlcExpand vlButton" style="display: none;"></div><div class="vlcHDButton vlButton">HD</div><div class="vlcFull vlButton"></div><div class="vlcCloseFull vlButton"></div></div><div class="vlcCenter"><div class="vlProgress"><div class="vlPosition" style="width: 0%;"></div><div class="vlSeeker vlButton" style="margin-left: 0%;"></div><div class="vlBuffer"></div></div></div></div></div>
</div>
<style>
                .vlControls {
                    border-bottom-right-radius: 0 !important;
                    border-bottom-left-radius: 0 !important;
                }
            </style>
</div>
<div class="mv_under" style="bottom:0;margin-bottom:12px">
<a href="/user/rowbert"><img src="https://www.vidlii.com/usfi/avt/UGvSagZZGVQ.jpg" class="avt2 " alt="rowbert" width="50" height="50"></a> <div>
<a href="/watch?v=wde1G--04Xi">Batman: The Dark Night Deleted Scenes! (DAN BULL)</a>
<img src="https://www.vidlii.com/img/full_star.png" width="18" height="17"><img src="https://www.vidlii.com/img/full_star.png" width="18" height="17"><img src="https://www.vidlii.com/img/full_star.png" width="18" height="17"><img src="https://www.vidlii.com/img/full_star.png" width="18" height="17"><img src="https://www.vidlii.com/img/full_star.png" width="18" height="17"> </div>
</div>
<div class="you_wnt">
<div>
<strong>Want to customize this homepage?</strong><br>
<a href="/login">Sign In</a> or <a href="/register">Sign Up</a> now!
</div>
</div>
<div class="wdg">
<div style="height:23px">
<span>Recommended Channels</span>
</div>
<div>
<div style="padding-bottom:1px;margin-bottom:5px;border-bottom:1px solid #ccc;overflow:hidden">
 <div style="float:left;width:19%;margin-right:5%">
<a href="/user/0"><img src="https://www.vidlii.com/usfi/avt/hw4pgYEJEXn.jpg" class="avt2 " alt="0" width="56" height="56"></a> </div>
<div style="float:left; width:76%;position:relative;bottom:2px">
<a href="/user/0" style="font-weight:bold;font-size:16px">0</a>
<div style="margin-top:1px;height:2em;line-height:13px;font-size:13px;overflow:hidden">
DISCLAIMER: Nicholas Walstrom a.k.a WALRUSGUY did not create, nor does he possess or have access to any part of this channel.
He is a contracted content producer which according to the VidLii Terms of Service and Community Guidelines is 100% okay. </div>
<div style="margin-top:3px;color:gray;font-size:13px">
1,040 views - 66 subscribers
</div>
</div>
</div>
<div style="padding-bottom:1px;margin-bottom:5px;border-bottom:1px solid #ccc;overflow:hidden">
<div style="float:left;width:19%;margin-right:5%">
<a href="/user/3"><img src="https://www.vidlii.com/img/no.png" class="avt2 " alt="3" width="56" height="56"></a> </div>
<div style="float:left; width:76%;position:relative;bottom:2px">
<a href="/user/3" style="font-weight:bold;font-size:16px">3</a>
<div style="margin-top:1px;height:2em;line-height:13px;font-size:13px;overflow:hidden">
<em>No Description...</em> </div>
<div style="margin-top:3px;color:gray;font-size:13px">
135 views - 15 subscribers
</div>
</div>
</div>
<div style="">
<div style="float:left;width:19%;margin-right:5%">
<a href="/user/8"><img src="https://www.vidlii.com/img/no.png" class="avt2 " alt="8" width="56" height="56"></a> </div>
<div style="float:left; width:76%;position:relative;bottom:2px">
<a href="/user/8" style="font-weight:bold;font-size:16px">8</a>
<div style="margin-top:1px;height:2em;line-height:13px;font-size:13px;overflow:hidden">
8 </div>
<div style="margin-top:3px;color:gray;font-size:13px">
0 views - 5 subscribers
</div>
</div>
</div>
</div>
</div>
<div class="whats_new">
<strong>What's New</strong>
<a href="/login">Cosmic Panda</a>
The famous 2012 YouTube Channel Layout is now finally on VidLii. Unlike YouTube we won't force it though!
<a href="/channels">Awards</a>
See how you compare to other channels this week / this month.
<a href="/themes">Themes</a>
Choose your favorite theme and make VidLii look the way you want it to look.
</div>
<div class="last_5">
<strong>Last 5 Users Online</strong>
<div>
<a href="/user/Yoshimasa">Yoshimasa</a>
<span>26 videos</span><span>101 favorites</span><span>337 friends</span>
</div>
<div>
<a href="/user/UncleKlaskyCsupo">UncleKlaskyCsupo</a>
<span>8 videos</span><span>20 favorites</span><span>7 friends</span>
</div>
<div>
<a href="/user/trollgethursday">trollgethursday</a>
<span>3 videos</span><span>0 favorites</span><span>0 friends</span>
</div>
<div>
<a href="/user/Kaede">Kaede</a>
<span>0 videos</span><span>11 favorites</span><span>125 friends</span>
</div>
<div>
 <a href="/user/FeralMewsMinion">FeralMewsMinion</a>
<span>0 videos</span><span>0 favorites</span><span>17 friends</span>
</div>
</div>
</aside>
<div class="cl"></div>
</main>
<div class="cl"></div>
<footer style="margin-top:30px">
<form action="/results" method="GET">
<input type="search" name="q" class="search_bar" maxlength="256"> <input type="submit" value="Search" class="search_button">
</form>
<div>
<div>
<strong>About VidLii</strong>
<div>
<a href="/blog">Blog</a><a href="/about">About</a>
</div>
<div>
<a href="/terms">Terms of Use</a><a href="/privacy">Privacy Policy</a>
</div>
<div style="margin-right: 49px">
<a href="/themes">Themes</a><a href="/testlii">Testlii</a>
</div>
</div>
<div>
<strong>Help &amp; Info</strong>
<div>
<a href="/help">Help Center</a><a href="/partners">Partnership</a>
</div>
<div>
<a href="/copyright">Copyright</a><a href="/guidelines">Community Guidelines</a>
</div>
</div>
<div>
<strong>Your Account</strong>
<div>
<a href="/my_videos">My Videos</a><a href="/my_favorites">My Favorites</a>
</div>
<div>
<a href="/my_subscriptions">My Subscriptions</a><a href="/my_account">My Account</a>
</div>
</div>
</div>
</footer>
</body></html>