<?php
include( 'db.php' );
header( 'Content-type: text/x-component' );
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($connect,"SELECT * FROM videodb");

while($row = mysqli_fetch_array($result))
{
$VideoName = htmlspecialchars($row["VideoName"]);
$UploadDate = htmlspecialchars($row["UploadDate"]);
$Uploader = htmlspecialchars($row["Uploader"]);
$timestamp = strtotime($UploadDate);
echo "$timestamp|$Uploader|A|$VideoName.$Uploader\n";
}


mysqli_close($connect);
?>
