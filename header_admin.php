<?php 
session_start(); 
include("db.php");
$datenow = date("Y-m-d");
if(isset($_SESSION["username"])) {
$username = htmlspecialchars($_SESSION["username"]);
$detail = mysqli_query($connect, "SELECT * FROM users WHERE username='". $username ."'"); // selects details of user
$detail2 = mysqli_fetch_assoc($detail); // function for getting details of user
$isAdmin = $detail2['is_admin'];
if ($detail2["registeredon"] == null) {
	$stmt = $connect->prepare("UPDATE users SET registeredon = ? WHERE username = ?"); // prepares sql commands in prepared statement
	$stmt->bind_param("ss", $datenow, $username);
	$stmt->execute(); // this is to remove SQL injection, and to update the last online date.
}
}
?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="semantic/dist/components/menu.css">
	<link rel="stylesheet" type="text/css" href="semantic/dist/components/image.css">
	<link rel="stylesheet" type="text/css" href="semantic/dist/components/transition.css">
	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
	<script src="assets/jquery-3.5.1.min.js"></script>
	<script src="assets/semantic.min.js"></script>
    <title>Admin Panel - PokTube</title>
  </head>
<!---- header start ----->
<body>
<div class="ui menu inverted">
  <div class="item">PokTube Admin</div>
  <a class="item" href="#">Home <span class="sr-only">(current)</span></a>
</div>
<!---- header end ----->