<?php include("header_admin.php");
include("admin_check.php");
include("db.php"); ?>
<title>PokTube</title>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello, world!</title>
  </head>
  <body>
  <div class="container-fluid">
    <h1>Welcome, <?php echo $_SESSION["username"];?></h1>
<pre>
<strong>Uptime:</strong>
<?php system("uptime"); ?>
<strong>System Information:</strong>
<?php system("uname -a"); ?>
</pre>
	<h2>Videos</h2>
		<h3>Unapproved</h3>
	<?php
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($connect,"SELECT * FROM videodb WHERE `isApproved` = '0'");

while($row = mysqli_fetch_array($result))
{
echo $row['1'];
echo " (" . $row['0'] . ")";
echo " by " . $row['3'];
echo " - [link]";
echo "<br>";
}
echo "</table>";
?>
	<h3>Approved</h3>
	<?php
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($connect,"SELECT * FROM videodb WHERE `isApproved` = '1'");

while($row = mysqli_fetch_array($result))
{
echo $row['1'];
echo " (" . $row['0'] . ")";
echo " by " . $row['3'];
echo " - [link]";
echo "<br>";
}
echo "</table>";

mysqli_close($connect);
?>
	</div>
  </body>
</html>