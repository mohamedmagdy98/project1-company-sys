<?php
$errors="";
session_start();
if (isset($_SESSION['id'])) {
  header("location:users_list.php");
}
if ($_SERVER['REQUEST_METHOD']=='POST') {
  $conn=mysqli_connect("localhost:3308","root","","first");
  if (!$conn) {

    echo "error";
    exit;
  }
  $email=mysqli_escape_string($conn,$_POST['email']);
  $password=sha1($_POST['password']);
  $query="select * from users where email='".$email."' and password='".$password."'";
  $result=mysqli_query($conn,$query);
  if ($row=mysqli_fetch_assoc($result)) {
    $_SESSION['id']=$row['id'];
    $_SESSION['email']=$row['email'];
    $_SESSION['name']=$row['name'];
    $_SESSION['avatar']=$row['avatar'];
    $_SESSION['admin']=$row['admin'];
    if ($row['admin']==1) {
      header("location:users_list.php");
      exit;
    }
    else {
      header("location:normaluser.php");
      exit;
    }

  }
  else {
    $errors="invalid password or email";
  }
}
 ?>



<!--  _____________________________html_______________________________________ -->

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
<style>
.divider:after,
.divider:before {
  content: "";
  flex: 1;
  height: 1px;
  background: #eee;
}
.h-custom {
  height: calc(100% - 73px);
}
@media (max-width: 450px) {
  .h-custom {
    height: 100%;
  }
}

</style>





<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/draw2.png" class="img-fluid"
          alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST">




          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="form3Example3" name="email" class="form-control form-control-lg"
              placeholder="Enter a valid email address"required />
            <label class="form-label" for="form3Example3">Email address</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" name="password" class="form-control form-control-lg"
              placeholder="Enter password" required/>
            <label class="form-label" for="form3Example4">Password</label>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" name="remember" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Remember me
              </label>
            </div>
            <a href="#!" class="text-body">Forgot password?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <input type="submit" value="Login" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">

            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="new.php"
                class="link-danger">Register</a></p>
          </div>

        </form>
        <?php if ($errors) {  ?>
        <div class="alert alert-danger"> <strong>Wrong!</strong> <?= $errors?></div>

        <?php }  ?>


      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2020. All rights reserved.
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
</section>
