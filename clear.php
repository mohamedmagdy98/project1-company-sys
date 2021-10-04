<?php
  if ($_GET['clear']=1) {
  $conn= mysqli_connect("localhost:3308","root","","first");
  $query="update users set absence=0";
  mysqli_query($conn,$query);
  header("location:users_list.php");

} ?>
