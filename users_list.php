
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
  elseif ($_SESSION['admin']==0) {
    header("location:normaluser.php");
  }
  $conn= mysqli_connect("localhost:3308","root","","first");
  if (!$conn) {
    echo "something went wrong!";
  }

  $query="select * from users";

  if (isset($_GET['search'])&& !empty($_GET['search'])){
    $search=mysqli_escape_string($conn, $_GET['search']);
    $query.=" WHERE name LIKE '%".$search."%' OR email LIKE '%".$search."%' OR id='".$search."'";
  }
  $query.=" order by -id";
  $result= mysqli_query($conn,$query);
  $salary1= New salary();
  if (isset($_GET['id'])) {

    $abquery="select * from users where id='".$_GET['id']."' limit 1" ;
    $results=mysqli_query($conn,$abquery);
    $rows=mysqli_fetch_assoc($results);


    if ($_GET['button']==1) {
      $adding=(string)((float)$rows['absence']+1);

      $query="update users set absence='".$adding."' where id='".$_GET['id']."'";
      mysqli_query($conn,$query);

    }
    elseif ($_GET['button']==0.5) {
      $adding=(string)((float)$rows['absence']+0.5);
      echo $adding;
      $query="update users set absence='".$adding."' where id='".$_GET['id']."'";
      mysqli_query($conn,$query);

    }
    if ($_GET['admin']=='add') {
      $query="update users set admin='1' where id='".$_GET['id']."'";
      mysqli_query($conn,$query);
    }
      if ($_GET['admin']=='delete') {
      $query="update users set admin='0' where id='".$_GET['id']."'";
      mysqli_query($conn,$query);
    }
    header("location:users_list.php");
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
      <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="users_list.php">
        <strong><h3 style="color:BLUE;margin-top:6%;font-family: 'Montserrat', sans-serif;">ADMIN PANEL</H3></strong>
      </a>

      <!-- Search form -->
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
    <!-- Left elements -->

    <!-- Center elements -->
    <ul class="navbar-nav flex-row d-none d-md-flex">
      <li class="nav-item me-3 me-lg-1 active">
      <h4>email:<?=$_SESSION['email']?$_SESSION['email']:""?></h4>
      </li>
    </ul>
    <!-- Center elements -->

    <!-- Right elements -->
    <ul class="navbar-nav flex-row">
      <li class="nav-item me-3 me-lg-1">
        <a class="nav-link d-sm-flex align-items-sm-center" href="normaluser.php">
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
<!-- _____________________________html_______________________________________-->
<div class="input-group">
  <div class="form-outline">
    <!--
    <form method="GET">
      <input id="search-input" type="search" id="form1" class="form-control" name="search" />
      <label class="form-label" for="form"1>Search</label>

    <input  type="submit" class="btn btn-primary" value="search">


    </form>
-->
<table class="table align-middle">
  <thead>
    <tr>
      <th scope="col"><h2>id</h2></th>
      <th scope="col"><h2>name</h2></th>
      <th scope="col"><h2>email</h2></th>
      <th scope="col"><h2>avatar</h2></th>
      <th scope="col"><h2>salary</h2></th>
      <th scope="col"><h2>absence</h2></th>
      <th scope="col"><h2>net salary</h2></th>
      <th scope="col"><h2>controls</h2></th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row =mysqli_fetch_assoc($result)) {
        ?>
      <tr>
      <th scope="row"><h3><?=$row['id']?></h3></th>
      <td><h4><?=$row['name']?></h4></td>
      <td><h4><?=$row['email']?></h4></td>
      <td>
        <?php
        if ($row['avatar']) {
          ?>
          <img
            src="<?=$row['avatar']?>"
            class="rounded-circle"
            style="width: 150px;"
            alt=""
          />
      <?php
        }
        else {
            ?>
            <img
              src="uploads/OIP.jpg"
              class="rounded-circle"
              style="width: 150px;"
              alt=""
            />

      <?php  } ?>


      </td>
      <td><h4><?=$row['salary']?></h4></td>
      <td><h4><?=$row['absence']?><div><a href="users_list.php?id=<?=$row['id']?>&&button=1" class="btn btn-warning btn-sm px-3">+1</a><a href="users_list.php?id=<?=$row['id']?>&&button=0.5" class="btn btn-warning btn-sm px-3">+0.5</a><div></h4></td>
      <td><h4><?=$row['salary']?(int)$salary1->salaryout((int)$row['salary'],(float)$row['absence']):$row['salary']?></h4></td>

      <td>
        <a href="edit.php?id=<?=$row['id']?>" class="btn btn-warning btn-sm px-3">edit</a>
        <?php if ($row['admin']=='0') {?>
        <a href="users_list.php?admin=add&&id=<?=$row['id']?>" class="btn btn-ok btn-sm px-3">add admin</a>
        <?php  } ?>
        <?php if ($row['admin']=='1') {?>
        <a href="users_list.php?admin=delete&&id=<?=$row['id']?>" class="btn btn-ok btn-sm px-3">delete admin</a>
        <?php  } ?>
        <a href="delete.php?id=<?=$row['id']?>" class="btn btn-danger btn-sm px-3">delete</a>

      </td>

      </tr>

<?php
  }
  ?>
  </tbody>
</table>
<a href="new.php" class="btn btn-primary btn-sm px-3"><h4>add new user</h4></a>
<?php
  if (isset($_GET['search']) && !empty($_GET['search'])){
 ?>
 <a href="users_list.php" class="btn btn-primary btn-sm px-3"><h4>show all</h4></a>
<?php
}
 ?>
 <a href="clear.php?clear=1" class="btn btn-primary btn-sm px-3"><h4>clear absence</h4></a>
 <button type="button" name="button"class="btn btn-primary btn-sm px-3"onclick="window.print();return false;"><h4>print</h4></button>
</body>
