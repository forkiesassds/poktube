<?php
include("header.php"); 
$con = $connect;
if( $con->connect_error){
    die('Error: ' . $con->connect_error);
}
$sql = "SELECT * FROM `videodb`";
if( isset($_GET['search']) ){
    $name = mysqli_real_escape_string($connect, htmlspecialchars($_GET['search']));
    $sql = "SELECT * FROM `videodb` WHERE VideoName LIKE '%{$name}%' AND `isApproved`='1'";
}
$result = $connect->query($sql);
echo "<html>
<head>
<title>Search results for ".$_GET['search']."</title>";
?>
<div style="margin: auto; width: 95%;">
<!-- begin recently featured -->
					<table class="roundedTable" width="auto" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#cccccc">
			<tr>
				<td><img src="img/box_login_tl.gif" width="5" height="5"></td>
				<td width="100%"><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_tr.gif" width="5" height="5"></td>
			</tr>
			<tr>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
				<td width="585">
					<div class="sunkenTitleBar">
						<div class="moduleTitle">
							<span style="color:#444;">Search results for <?php echo $_GET['search']?></span>
						</div>
					</div>
											<?php
$sql = mysqli_query($connect, "SELECT * FROM `videodb` WHERE VideoName LIKE '%{$name}%' AND `isApproved`='1'"); //instructions for sql

while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
$idvideolist = $fetch['VideoID'];
$namevideolist = htmlspecialchars($fetch['VideoName']);
$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
$uploadvideolist = htmlspecialchars($fetch['UploadDate']); // get recommendations information
$descvideolist = htmlspecialchars($fetch['VideoDesc']);
$viewsvideolist = htmlspecialchars($fetch['ViewCount']);
echo "<div class='moduleEntry'>
						<table width='665' cellpadding='0' cellspacing='0' border='0'>
							<tbody><tr valign='top'>
								<td><a href='watch.php?v=$idvideolist&player=0'><img src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\" class='moduleEntryThumb' width='120' height='90'></a>
								</td>
								<td width='100%'>
									<div class='moduleEntryTitle'>
										<a href='watch.php?v=".$idvideolist."&player=0'>".$namevideolist."</a>
									</div>
										<div class='moduleEntryDescription'>
									".$descvideolist."
									</div>
							
									<div class='moduleEntryDetails'>
										Added: ".$uploadvideolist." by <a href='profile.php?user=".$uploadervideolist."'>".$uploadervideolist."</a>
									</div>
									
									<div class='moduleEntryDetails'>
										Alternative players: <a href='watch.php?v=$idvideolist&player=1'>Flash Player</a> - <a href='watch.php?v=$idvideolist&player=2'>ActiveX</a>
									</div>
									<nobr>
	</nobr>
								</td>
							</tr>
						</tbody></table>
					</div>";
}
?>
				</td>
				<td><img src="img/pixel.gif" width="5" height="1"></td>
			</tr>
			<tr>
				<td><img src="img/box_login_bl.gif" width="5" height="5"></td>
				<td><img src="img/pixel.gif" width="1" height="5"></td>
				<td><img src="img/box_login_br.gif" width="5" height="5"></td>
			</tr>
		</table>
	</div>
			<!-- end recently featured -->
<?php include("footer.php"); ?>