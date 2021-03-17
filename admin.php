<?php include("header_admin.php");
include("admin_check.php");
include("db.php"); 
if(!$admin=1) {
    echo "<script>window.location = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'</script>"; // ASGYHAHHAHAH FUNNY NSAFYNFN FYNNY YOOO FMAIY GUY FINNY MEOMTNS
}?>
	<h1>Welcome, <?php echo $_SESSION["username"];?></h1>
<pre>
<strong>PHP Version:</strong>
<?php echo phpversion();?> (<a href="phpinfo.php">info</a>) <?php echo "\n";?>
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
echo htmlspecialchars($row['1']);
echo " (" . $row['0'] . ")";
echo " by " . htmlspecialchars($row['3']);
echo " - [<a href='watch.php?v=".$row['0']."'>link</a>]";
echo " - [<a href='approve.php?v=".$row['0']."'>approve</a>]";
echo " - [<a href='delete.php?v=".$row['0']."'>decline</a>]";
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
echo htmlspecialchars($row['1']);
echo " (" . $row['0'] . ")";
echo " by " . htmlspecialchars($row['3']);
echo " - [<a href='watch.php?v=".$row['0']."'>link</a>]";
echo " - [<a href='unapprove.php?v=".$row['0']."'>unapprove</a>]";
echo "<br>";
}
echo "</table>";
?>

	<h3>Declined</h3>
	<?php
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($connect,"SELECT * FROM videodb WHERE `isApproved` = '2'");

while($row = mysqli_fetch_array($result))
{
echo htmlspecialchars($row['1']);
echo " (" . $row['0'] . ")";
echo " by " . htmlspecialchars($row['3']);
echo " - [<a href='watch.php?v=".$row['0']."'>link</a>]";
echo "<br>";
}
echo "</table>";

mysqli_close($connect);
?>
  </body>
</html>
