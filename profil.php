<?php
require_once("auth.php"); 
require_once("config.php");
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
$username_sesi = $_SESSION["user"]["username"];
$username_sesi = $_SESSION["user"]["username"];
$sql = mysqli_query($link, "SELECT * FROM `users` WHERE `username`='$username_sesi'");
$row = mysqli_fetch_assoc($sql);
$user_id = $row['id'];

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<head>
    <style type="text/css">.disclaimer { display: none; }</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--©2022 Yoga Raditya Nala
    github.com/lycusfelicius-->
    <title>Time Talk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="//cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script src="js/validity.js"></script>
    <script src="js/commons.js"></script>
</head>
<body>
<!--navbar area-->
<nav class="navbar navbar-expand-lg navbar-dark shadow fixed-top" style="background-color: #292c2c;">
  <div class="container-fluid">
    <a class="navbar-brand mb-0 h1" href="#"> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" tabindex="-1" aria-disabled="true" href="index.php">Beranda</a>
        </li>
        <ul class="navbar-nav" style="">
           <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Kategori
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="search.php?key=Menfess">Menfess</a>
          <a class="dropdown-item" href="search.php?key=Diskusi">Diskusi</a>
          <a class="dropdown-item" href="search.php?key=kritik dan Saran">Kritik Saran</a>
        </div>
      </li>
    </ul>
        <li class="nav-item">
          <a class="nav-link" href="tulis.php" tabindex="-1" aria-disabled="true">Tulis Sesuatu</a>
        </li>
    </ul>
    <ul class="navbar-nav" style="">
           <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" aria-current="page" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $username_sesi; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="profil.php">Profil</a>
          <a class="dropdown-item" href="tentang.php">Tentang</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
    </div>
  </div>
</nav>
<div class="container" style="padding-top: 80px;">
        <div class="card">
            <div class="card-body">
            <br>
              <h4>Profil dan Statistik</h4>
              <br>
              <?php 
                $sql = mysqli_query($link, "SELECT * FROM `users` WHERE `id` = '$user_id'");
                $row = mysqli_fetch_assoc($sql);
                $id_user = $row['id'];
                $username = $row['username'];
                $email = $row['email'];
                $score = $row['score'];
                $admin = $row['admin'];
                echo '<p><b>ID User : </b>'.$id_user.'<br><b>Username : </b>'.$username.'<br><b>Email : </b>'.$email.'<br><b>Score : </b>'.$score.'</p>';
                $data = mysqli_query($link,"SELECT * from `post` WHERE `user_id` = '$user_id'");
                $jumlah_data = mysqli_num_rows($data);
                $data_comments = mysqli_query($link,"SELECT * from `comment_to_post` WHERE `user_id` = '$user_id'");
                $jumlah_comments = mysqli_num_rows($data_comments);               
                echo '<p><b>Jumlah Pertanyaan : </b>'.$jumlah_data.'<br><b>Jumlah Respons : </b>'.$jumlah_comments.'<br>';
                if ($admin == "1") {
                    echo '<b>Administrator</b><br>';
                }
              ?>
              <br>
              <a href="edit-user.php" class="btn btn-primary">Edit Detail</a>
    </div></div>
</div>
<footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Beranda</a></li>
      <li class="nav-item"><a href="https://www.github.com/lycusfelicius" class="nav-link px-2 text-muted">Github</a></li>
      <li class="nav-item"><a href="https://www.instagram.com/yogar.n" class="nav-link px-2 text-muted">Instagram</a></li>
      <li class="nav-item"><a href="https://twitter.com/lycusfelicius" class="nav-link px-2 text-muted">Twitter</a></li>
    </ul>
    <p class="text-center text-muted">© 2022 Yoga Raditya</p>
  </footer>
</body>