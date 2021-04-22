<?php
// Create connection
 $con=mysqli_connect('localhost', 'root', '', 'poktube');
// Check connection
 if (mysqli_connect_errno($con)) {
 echo "Database connection failed!: " . mysqli_connect_error();
 }
 
 $sql = "SELECT * FROM videodb DESC LIMIT 20";
 $query = mysqli_query($con,$sql);
 
 header( "Content-type: text/xml");
 
 echo "<?xml version='1.0' encoding='UTF-8'?>
 <rss version='2.0'>
 <channel>
 <title>w3schools.in | RSS</title>
 <link>/</link>
 <description>Cloud RSS</description>
 <language>en-us</language>";
 
 while($row = mysqli_fetch_array($con,$query)){
   $title=$row["VideoName"];
   $link=$row["VideoID"];
   $description=$row["VideoDesc"];
 
   echo "<item>
   <title>$title</title>
   <link>$link</link>
   <description>$description</description>
   </item>";
 }
 echo "</channel></rss>";
?>