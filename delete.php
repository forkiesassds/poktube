<?php include("header_admin.php");
include("admin_check.php");
include("db.php"); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!isset($_GET["v"])){
	die('No video ID specified!');
} else {
	$vid = $_GET["v"];
}
$one = 1;
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(!$admin=1) {
    echo "<script>window.location = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'</script>"; // ASGYHAHHAHAH FUNNY NSAFYNFN FYNNY YOOO FMAIY GUY FINNY MEOMTNS
}
$result = mysqli_query($connect,"SELECT * FROM videodb WHERE `VideoId` = '".$vid."'");
$fetch = mysqli_fetch_assoc($result);
unlink($fetch['VideoFile']);
if(isset($fetch['HQVideoFile'])){
unlink($fetch['HQVideoFile']);
}
$stmt = $connect->prepare("DELETE FROM `poktube`.`videodb` WHERE VideoID=?");
$stmt->bind_param("s", $vid);
$stmt->execute();
echo "<script>window.location = 'admin.php'</script>";
?>