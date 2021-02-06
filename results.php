
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
<!DOCTYPE html>
</head>
<body>
<table width="800" cellspacing="0" cellpadding="0" border="0" align="center">
	<tbody><tr>
		<td style="padding-bottom: 25px;" bgcolor="#FFFFFF">
		<div style="padding: 0px 5px 0px 5px;">
<p>IMPORTANT NOTE: This is retarded</p>
<?php echo "<div class=\"tableSubTitle\">Search results for ".$_GET['search']."</div>" ?>
<table cellspacing='0' cellpadding='0' border='0' class='roundedTable' bgcolor='#cccccc' border='2'>
<tbody>
<tr>
<th>Thumbnail</th>
<th>Video Name</th>
<th>Description</th>
<th>Uploader</th>
<th>Uploaded</th>
<th>Link</th>
</tr>
</tbody>
<?php
while($row = $result->fetch_assoc()){
    ?>
    <tr>
	<td class='moduleEntry_alt'><img src="content/thumbs/<?php echo $row['VideoID']; ?>.png" width="120" height="90"</img></td>
    <td class='moduleEntry_alt'><?php echo htmlspecialchars($row['VideoName']); ?></td>
	<td class='moduleEntry_alt'><?php echo htmlspecialchars($row['VideoDesc']); ?></td>
	<td class='moduleEntry_alt'><?php echo htmlspecialchars($row['Uploader']); ?></td>
	<td class='moduleEntry_alt'><?php echo htmlspecialchars($row['UploadDate']); ?></td>
    <td class='moduleEntry_alt'><a href="watch.php?v=<?php echo htmlspecialchars($row['VideoID']); ?>&player=0">Watch</td>
    </tr>
    <?php
}
?>
</table>
</body>
</html>