<?php
$conn=mysqli_connect("localhost:3308","root","","first");
if (!$conn) {
  echo mysqli_connect_error();
  exit;
}
$id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$query="delete from users where users.id='".$id."' limit 1" ;
if(mysqli_query($conn,$query)){
  header("location:users_list.php");
  exit;
}
else {
  echo mysqli_error($conn);
}
mysqli_close($conn);


  ?>
