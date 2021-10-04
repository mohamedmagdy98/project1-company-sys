<?php

$errors=array();
if ($_SERVER['REQUEST_METHOD']=='POST') {

//validation
if (!isset($_POST['checkbox1'])) {
  $errors[]="checkbox";
}
if ($_POST['password'] != $_POST['password2']){
  $errors[]="password";
}
if (strlen($_POST['password'])<8) {
  $errors[]="password2";
}

//code of adding user
if (!$errors) {
  $conn=mysqli_connect("localhost:3308","root","","first");
  if (! $conn) {
    echo "<h1>can`t connect to database</h5>";
    exit;
  }
  $name=mysqli_escape_string($conn,$_POST['name']);
  $email=mysqli_escape_string($conn,$_POST['email']);
  $password=sha1($_POST['password']);
  //img upload

  $result=mysqli_query($conn,"insert into users (name , email , password,salary,absence,admin) values ('".$name."','".$email."','".$password."',0,0,0) ");
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

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">New User</p>

                <form class="mx-1 mx-md-4" method="POST" enctype="multipart/form-data">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" name="name" required/>
                      <label class="form-label" for="form3Example1c">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" class="form-control" name="email"required />
                      <label class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" class="form-control" name="password" required/>
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd" class="form-control" name="password2" required/>
                      <label class="form-label" for="form3Example4cd">Repeat your password</label>
                    </div>
                  </div>




                  <div class="form-check d-flex justify-content-center mb-5">
                    <input
                      class="form-check-input me-2"
                      type="checkbox"
                      value=""
                      name="checkbox1"

                    />
                    <label class="form-check-label" for="checkbox1">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" class="btn btn-primary btn-lg" value="register">
                  </div>

                </form>
                <?php
                if (in_array("checkbox",$errors)) {
                ?>
                  <div class="alert alert-danger"> <strong>Wrong!</strong> checkbox not checked.</div>
                <?php
                }
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
