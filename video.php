<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
$mysqli = new mysqli("localhost", "root", "", "video");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT * FROM `videos` WHERE `video_id` = " . $_GET['v'];;
$result = $mysqli->query($query);

/* numeric array */
$row = $result->fetch_array(MYSQLI_NUM);
printf ("%s (title name: %s)\n %s %s %s", $row[0], $row[1], $row[2], $row[3], $row[4], $_GET['v']);

/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>

<?php
  $connect = new mysqli("localhost", "root", "", "video");
  $SQL = "SELECT * FROM `videos` WHERE `video_id` = " . $_GET['v'];
  $query = mysqli_query($SQL);
  $result = mysqli_fetch_array($query);
?>
<html>
<body>
<video width="320" height="240" controls>
<source src="videos\<?php echo $result[$row[2]] ?? $row[2];?>" type="video/mp4">
</video>
<img src="pfp\<?php echo $result[$row[4]] ?? $row[4];?>.png" alt="<?php echo $result[$row[4]] ?? $row[4];?>" width="128" height="128"> 


</body>
</html>