
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
?>
<!DOCTYPE html>
<html>
<head>
<title>Basic Search form using mysqli</title>
<link rel="stylesheet" type="text/css"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<p>IMPORTANT NOTE: This is retarded</p>
<div class="container">
<h2>List of students</h2>
<table class="table table-striped table-responsive">
<tr>
<th>Video Name</th>
<th>Link</th>
</tr>
<?php
while($row = $result->fetch_assoc()){
    ?>
    <tr>
    <td><?php echo $row['VideoName']; ?></td>
    <td><a href="watch.php?v=<?php echo $row['VideoID']; ?>&player=0"><?php echo $row['VideoID']; ?></td>
    </tr>
    <?php
}
?>
</table>
</div>
</body>
</html>