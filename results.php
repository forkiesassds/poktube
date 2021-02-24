
<?php
include("header.php"); 
$con = $connect;
if( $con->connect_error){
    die('Error: ' . $con->connect_error);
}
$sql = "SELECT * FROM `videodb`";
if( isset($_GET['search']) ){
    $name = mysqli_real_escape_string($connect, htmlspecialchars($_GET['search']));
    $sql = "SELECT * FROM `videodb` WHERE VideoName LIKE '%{$name}%'";
}
$result = $connect->query($sql);
echo "<html>
<head>
<title>Search results for ".$_GET['search']."</title>";
?>
<div style="margin: auto; width: 95%;">
<!-- begin recently featured -->
<div class="ui container">
	<h4 class="ui top attached inverted header">
		<div id="homepage-featured-more-top">
			Search results for <?php echo $_GET['search']?>
		</div>
	</h4>
	<div class="ui bottom attached segment">
		<div class="ui celled list">
<?php
$sql = mysqli_query($connect, "SELECT * FROM `videodb` WHERE VideoName LIKE '%{$name}%'"); //instructions for sql

while ($fetch = mysqli_fetch_assoc($sql)) { //go forward with instructions
$idvideolist = $fetch['VideoID'];
$namevideolist = htmlspecialchars($fetch['VideoName']);
$uploadervideolist = htmlspecialchars($fetch['Uploader']); // get recommendations information
$uploadvideolist = htmlspecialchars($fetch['UploadDate']); // get recommendations information
$descvideolist = htmlspecialchars($fetch['VideoDesc']);
$viewsvideolist = htmlspecialchars($fetch['ViewCount']);
echo "
	<div class='item'>
				<div class='image'>
				  <img width='160' height='120' src='content/thumbs/".$idvideolist.".png' onerror=\"this.src='img/default.png'\">
				</div>
				<div class='content'>
				  <a href='watch.php?v=$idvideolist&player=0' class='header'>$namevideolist</a>
				  <div class='meta'>
					<span>$descvideolist</span>
				  </div>
				  <div class='description'>
					<p></p>
				  </div>
				  <div class='extra'>
				  Uploaded on $uploadvideolist<br>
				  <a href='profile.php?user=$uploadervideolist'><img class='ui avatar image' src='content/profpic/$uploadervideolist.png' onerror=\"this.src='img/profiledef.png'\">
				  <span>$uploadervideolist</span></a>
				  </div>
			  </div>
			</div>
";
}
?>
			</div>
		</div>
	</div>
</div>
<!-- end recently featured -->
<?php include("footer.php"); ?>