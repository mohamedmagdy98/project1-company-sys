<?php
class salary
{
  public $tax=0.14;
  public function salaryout($value,float $abs){
    $out=$value-(($value*$this->tax)+(($value/30)*$abs));
    return $out;
  }

}
  session_start();
  if (!isset($_SESSION['id'])) {
    header("location:login.php");
  }
  $conn= mysqli_connect("localhost:3308","root","","first");
  if (!$conn) {
    echo "something went wrong!";
  }

  $query="select * from users where id='".$_SESSION['id']."' limit 1";
  $result=mysqli_query($conn,$query);
  if ($result) {
    $row=mysqli_fetch_assoc($result);
  }
  ?>
  <body style="background-color:#D4F1F8;">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
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
  <!-- Navbar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid justify-content-between">
      <!-- Left elements -->
      <div class="d-flex">
        <!-- Brand -->
        <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="normaluser.php">
          <strong><h3 style="color:BLUE;margin-top:6%;font-family: 'Montserrat', sans-serif;">home</H3></strong>
        </a>

        <!-- Search form
        <form class="input-group w-auto my-auto d-none d-sm-flex" method="GET">
          <input
            autocomplete="off"
            type="search"
            class="form-control rounded"
            placeholder="Search"
            style="min-width: 125px;"
            name="search"
          />
          <span class="input-group-text border-0 d-none d-lg-flex"
            ><i class="fas fa-search"></i
          ></span>
        </form>
      </div>
      -->
      <!-- Left elements -->

      <!-- Center elements -->
      <?php if ($_SESSION['admin']==1) {?>
        <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="users_list.php">
          <strong><h3 style="color:BLUE;margin-top:6%;font-family: 'Montserrat', sans-serif;">adminpanel</H3></strong>
        </a>
    <?php  } ?>

      <ul class="navbar-nav flex-row d-none d-md-flex">
        <li class="nav-item me-3 me-lg-1 active">
        <h4>email:<?=$_SESSION['email']?$_SESSION['email']:""?></h4>
        </li>
      </ul>
      <!-- Center elements -->

      <!-- Right elements -->
      <ul class="navbar-nav flex-row">

        <li class="nav-item me-3 me-lg-1">
          <a class="nav-link d-sm-flex align-items-sm-center" href="#">
            <img
              src="<?=$_SESSION['avatar']?$_SESSION['avatar']:"uploads/OIP.jpg"?>"
              class="rounded-circle"
              height="50"
              width="40"
              alt=""
              loading="lazy"
            />
            <strong class="d-none d-sm-block ms-1"><h4><?=$_SESSION['name']?$_SESSION['name']:""?></h4></strong>
          </a>
        </li>
        <li class="nav-item me-3 me-lg-1">
          <a class="nav-link d-sm-flex align-items-sm-center" href="logout.php">

            <strong class="d-none d-sm-block ms-1" style="margin-top:5px;"><h4>logout</h4></strong>
          </a>
        </li>
          <ul

      <!-- Right elements -->
    </div>
  </nav>
  <!-- Navbar -->
