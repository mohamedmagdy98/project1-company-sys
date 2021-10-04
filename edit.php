<?php
//validation
$errors=array();
$conn=mysqli_connect("localhost:3308","root","","first");
if (!$conn) {
  echo mysqli_connect_error();
  exit;
}
$id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$query="select * from users where users.id='".$id."' limit 1" ;
$result= mysqli_query($conn,$query);
$row =mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD']=='POST') {
  if ($_POST['password'] != $_POST['password2']){
    $errors[]="password";
  }
  if (strlen($_POST['password'])<8 && strlen($_POST['password'])!=0) {
    $errors[]="password2";
  }

  //code
  if (!$errors) {
    $conn=mysqli_connect("localhost:3308","root","","first");
    if (! $conn) {
      echo "<h1>can`t connect to database</h5>";
      exit;
    }
    $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
    $name=mysqli_escape_string($conn,(!empty($_POST['name']))?$_POST['name']:$row['name']);
    $email=mysqli_escape_string($conn,(!empty($_POST['email']))?$_POST['email']:$row['email']);
    $password=(!empty($_POST['password'])?sha1($_POST['password']):$row['password']);
    $salary=mysqli_escape_string($conn,(!empty($_POST['salary']))?$_POST['salary']:$row['salary']);
    $absence=mysqli_escape_string($conn,(isset($_POST['absence']))?$_POST['absence']:$row['absence']);

    $upload_dir=$_SERVER['DOCUMENT_ROOT'].'/uploads';
    $avatar='';
    if($_FILES["avatar"]['error']==UPLOAD_ERR_OK){
      $tmp_name=$_FILES["avatar"]["tmp_name"];
      $avatar=basename($_FILES["avatar"]["name"]);
      move_uploaded_file($tmp_name,"$upload_dir/$name.$avatar");
      $avatar_url="uploads/$name.$avatar";
      $result=mysqli_query($conn,"update users set name='".$name."' , email='".$email."', password='".$password."' , avatar='".$avatar_url."', salary='".$salary."', absence='".$absence."' where users.id=".$id);
      if ($result) {
        header("location:users_list.php?uploaded=true");
      }
      else {
        echo "ops! something went wrong";
        echo mysqli_error($conn);
      }

      mysqli_close($conn);
    }
    $result=mysqli_query($conn,"update users set name='".$name."' , email='".$email."', password='".$password."', salary='".$salary."', absence='".$absence."' where users.id=".$id);
    if ($result) {
      header("location:users_list.php");
    }
    else {
      echo "ops! something went wrong";
      echo mysqli_error($conn);
    }

    mysqli_close($conn);
  }


}

 ?>


<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
  rel="stylesheet"
/>

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<a  class="btn btn-primary" href="users_list.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
</svg>
                Back

              </a>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">edit <?=$row['name']?></p>
                <h2>*Leave what u don`t want to change empty</h2>

                <form class="mx-1 mx-md-4" method="POST" enctype="multipart/form-data">
                  <input type="hidden" id="form3Example1c" class="form-control" name="id" value="<?=$row['id']?>" required/>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" name="name" value="<?=$row['name']?>" placeholder="name"/>

                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" class="form-control" name="email" value="<?=$row['email']?>" placeholder="email" />

                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" class="form-control" name="password"  placeholder="edit password if u want to change"/>


                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd" class="form-control" name="password2" placeholder="confirm new password"/>

                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
  <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
  <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
</svg>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example4c" class="form-control" name="salary" placeholder="salary"  />

                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-calendar-x-fill" viewBox="0 0 16 16">
  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6.854 8.146 8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 1 1 .708-.708z"/>
</svg>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example4c" class="form-control" placeholder="absence" name="absence"  />

                  </div>
                    </div>
                  <div class="file-field">
                    <div class="btn btn-primary btn-sm float-left">
                      <span>Choose files</span>
                      <input type="file" id="avatar" name="avatar" >
                    </div>

                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" class="btn btn-primary btn-lg" value="Edit">
                  </div>

                </form>
                <?php

                ?>
                <?php  if (in_array("password",$errors)) {
                ?>
                  <div class="alert alert-danger"> <strong>Wrong!</strong> the two passwords are not identical.</div>
                <?php
                }
                ?>
                <?php
                if (in_array("password2",$errors)) {
                ?>
                  <div class="alert alert-danger"> <strong>Wrong!</strong> the password must be 8 characters.</div>
                <?php
                }
                ?>


              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
