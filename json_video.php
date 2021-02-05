<?php

  $con=mysqli_connect("localhost","root","","poktube");

  // Check connection
  if (mysqli_connect_errno())
  {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $query = "SELECT * FROM `videodb` where `VideoID` = '" . $_GET['v'] . "'";

  $result = mysqli_query($con,$query);

  $rows = array();
  while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }
  header("Content-type: application/json");
  echo json_encode($rows);

  mysqli_close($con);
?>
