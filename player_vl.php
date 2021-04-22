<?php
//vlplayer for the average site, made by icanttellyou.
//you can write your own code to fill in these values.
//customization guide: 
// playerstlye: value must be either 2007HD, 2009HD or 2012,
// playerautoplay: boolian string, determins if player will autoplay.
// playerbuttoncolor: value must be either red, orange, gold, olive, green, teal, blue, violet, pink, magenta or white.
// playerbackgroundcolor: value must be either red, orange, gold, olive, green, teal, blue, violet, pink, magenta, white or black.
// videopath: path to your video.
// hdvideopath: path to hd quolity video, not nessecairy if $videoishd is false.
// thunb: thumbnail that will show before video will play.
// watchpagepath: path to your watch page.
// videoid: the video id your video is using.
// videoishd: determains if the video is hd.
// videolength: the length of your video.
$playerstyle = "2007HD";
$playerautoplay = "true";
$playerbuttoncolor = "teal";
$playerbackgroundcolor = "white";
$videopath = "https://185.86.231.49/video/kpL9_l72TNu.mp4";
$hdvideopath = "https://185.86.231.49/video/kpL9_l72TNu.hq.mp4";
$thumb = "../content/thumbs/tSKraHWTmpy.png";
$watchpagepath = "../watch.php?v=";
$videoid = "794";
$videoishd = true;
$videolength = 0;
?>

<link rel="stylesheet" type="text/css" href="Dxba6_VY.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="vlPlayer/main15.js"></script>
<div id="vtbl_pl">
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
	
	var vlpColors = "<?php echo $playerbuttoncolor ?>,<?php echo $playerbackgroundcolor ?>";
	vlpColors = vlpColors.split(",");
	
			var viValues = {
		variable: "vlp",
		src: "<?php echo $videopath ?>",
		hdsrc: "<?php echo $hdvideopath ?>",
		img: "<?php echo $thumb ?>",
		url: "<?php echo $videoid ?>",
		duration: <?php echo $videolength ?>,
		autoplay: <?php echo $playerautoplay ?>,
		skin: "<?php echo $playerstyle ?>",
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

<div class="vlPlayer">
<script>
				window[videoInfo.variable] = new VLPlayer({
					id: videoInfo.id,
					src: videoInfo.src,
					hdsrc: <?php if($videoishd == true) { 
					echo "videoInfo.hdsrc";
					} else {
					echo "null";
					}?>,
					preview: videoInfo.img,
					videoUrl: "<?php echo $watchpagepath ?>"+videoInfo.url,
					duration: videoInfo.duration,
					autoplay: videoInfo.autoplay,
					skin: "vlPlayer/skins/"+videoInfo.skin,
					adjust: videoInfo.adjust,
					btcolor: videoInfo.btcolor,
					bgcolor: videoInfo.bgcolor,
					start: videoInfo.start,
					expand: videoInfo.expand,
					complete: videoInfo.complete,
					ended: videoInfo.ended
				});
				
				$(window).on('hashchange', function() {
					var t = getTimeHash();
					vlp.play();
					vlp.seek(t);
					$(window).scrollTop(0);
				});
			</script>
</div>
</div>