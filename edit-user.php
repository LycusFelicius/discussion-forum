<?php
require_once("auth.php"); 
require_once("config.php");
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    $username_sesi = $_SESSION["user"]["username"];
$sql = mysqli_query($link, "SELECT * FROM `users` WHERE `username`='$username_sesi'");
$row = mysqli_fetch_assoc($sql);
$user_id = $row['id'];
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
    <script src="js/signup.js"></script>
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
        <a class="nav-link dropdown-toggle active" href="#" aria-current="page" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
<?php


// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(isset($_POST["submit"])) {
    $password = $_POST['password'];
    $username = $_POST['username'];
    $email = $_POST['email'];
if ($password != "") {
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $con_password = password_hash($_POST["con_password"], PASSWORD_DEFAULT);
    $sql = "UPDATE `users` SET `username`='$username', `email`='$email', `password`='$password' WHERE `id`='$user_id'";
    if(mysqli_query($link, $sql)){
        header("Location: logout.php");
    } else{
        echo '<div style="" class="alert alert-danger text-center fly-margin" role="alert">
        <strong>Pendaftaran Gagal!</strong><br> Email atau Username Telah Digunakan
        </div>';
    }
} else {
    $sql = "UPDATE `users` SET `username`='$username', `email`='$email' WHERE `id`='$user_id'";
    if(mysqli_query($link, $sql)){
        header("Location: logout.php");
    } else{
        echo '<div class="alert alert-danger text-center" role="alert">
        <strong>Pendaftaran Gagal!</strong><br> Email atau Username Telah Digunakan
        </div>';
    }
}
}
?>
        <div class="col-sm-8">
            <br>
              <h4>Edit Detail User</h4>
              <br>
            <?php
            $sql = mysqli_query($link, "SELECT * FROM `users` WHERE `username`='$username_sesi'");
            foreach ($sql as $row) {
                $username = $row['username'];
                $email = $row['email'];
                $password = $row['password'];
            echo '
    <form action="" method="POST" class="needs-validation" style="margin-bottom: 25px;" enctype="multipart/form-data" novalidate>
      <div class="form-group">
    <label for="username">Username</label>
    <input name="username" type="text" class="form-control" id="username" autocomplete="off" value="'.$username.'" required>
    <div class="invalid-feedback">
      Masukkan username terlebih dahulu!
    </div>
    <div class="valid-feedback">
      Username terlihat bagus!
    </div>
  </div>
  <br>
  <div class="form-group">
    <label for="email">Email</label>
    <input name="email" type="email" class="form-control" id="email" autocomplete="off" value="'.$email.'" required>
    <div class="invalid-feedback">
      Masukkan email terlebih dahulu!
    </div>
    <div class="valid-feedback">
      Email terlihat valid!
    </div>
  </div>
  <br>
  <div class="form-group">
  <label for="password">Password</label>
  <input name="password" type="password" class="form-control" id="password" value="'.$password.'" autocomplete="off" required>
  <div id="pw_invalid" class="invalid-feedback">
    Masukkan password terlebih dahulu!
  </div>
</div>
<br>
<div class="form-group">
  <label for="con_password">Konfirmasi Password</label>
  <input name="con_password" type="password" class="form-control" id="con_password" value="'.$password.'" autocomplete="off" aria-describedby="emailHelp" required>
  <div id="con_invalid" class="invalid-feedback">
    Masukkan konfirmasi password terlebih dahulu!
  </div>
  <div id="con_valid" class="valid-feedback">
    Password valid dan sesuai!
  </div>
  <small id="emailHelp" class="form-text text-muted">*Kami tidak akan pernah membagikan informasi anda dengan pihak manapun.</small>
</div>
<br>
        <div id="">
          <input name="submit" type="submit" class="btn btn-primary" value="Kirim Data"/>
        </div>
      </form>';
            }
      ?>
    </div>
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