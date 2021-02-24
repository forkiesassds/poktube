<?php include("header_admin.php");
include("admin_check.php");
include("db.php"); 
if(!$admin=1) {
    echo "<script>window.location = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'</script>"; // ASGYHAHHAHAH FUNNY NSAFYNFN FYNNY YOOO FMAIY GUY FINNY MEOMTNS
}?>
<div class="ui container">
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
echo " - [<a href='../watch.php?v=".$row['0']."'>link</a>]";
echo " - [<a href='../approve.php?v=".$row['0']."'>approve</a>]";
echo " - [<a href='../delete.php?v=".$row['0']."'>delete</a>]";
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
echo " - [<a href='../watch.php?v=".$row['0']."'>link</a>]";
echo " - [<a href='../delete.php?v=".$row['0']."'>delete</a>]";
echo "<br>";
}
echo "</table>";

mysqli_close($connect);
?>
	</div>
  </body>
</html>