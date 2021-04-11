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
$sql = mysqli_query($connect, "SELECT * FROM users"); //instructions for sql
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
<title>Browse - PokTube</title>
<div>
	
		<div class="headerRCBox">
	<b class="rch">
	<b class="rch1"><b></b></b>
	<b class="rch2"><b></b></b>
	<b class="rch3"></b>
	<b class="rch4"></b>
	<b class="rch5"></b>
	</b> <div class="content">	<table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr>
	<td class="headerTitle">Recent Channels</td>
	<td class="smallText"></td>
	<td width="20%">&nbsp;</td>
	</tr></tbody></table>
</div>
	</div>

	<div class="contentBox" style="background: #EEE;"> 
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tbody>
	<?php
$chanfetch = mysqli_query($connect, "SELECT * FROM users WHERE `isBanned` != '1' ORDER BY id DESC");
$count = 0;

while ($cdf = mysqli_fetch_assoc($chanfetch)) {
$Username = htmlspecialchars($cdf['username']);
$PreRegisteredOn = $cdf['registeredon'];
$query = mysqli_query($connect, "SELECT COUNT(VideoID) FROM videodb WHERE `Uploader`='".$Username."' AND `isApproved` = '1';");
$vdf_alt = mysqli_fetch_assoc($query);

	if($count == 0) {
		echo "<tr valign='top'></tr>";
	}
	echo "<td width='20%'>
			<div class='vBriefEntry'>
				<div class='img'><a href='profile.php?user=$Username'><img src='content/profpic/$Username.png' onerror=\"this.src='img/profiledef.png'\" class='vimg'></a></div>
				<div class='title'>
					<b><a href='profile.php?user=$Username'>$Username</a></b>
				</div>
				<div class='facets'>
					<span class='grayText'>Joined:</span> $PreRegisteredOn<br>
					<span class='grayText'>Videos:</span>".$vdf_alt['COUNT(VideoID)']."<br>
				</div>
			</div>
		</td>";
	$count++;
	if($count == 4) {
		echo "</tr>";
		$count = 0;
	}
	}
?>	

	</tbody></table>
	</div>
	
</div>

<?php include("footer.php"); ?>