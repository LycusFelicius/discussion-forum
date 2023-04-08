<?php 
require_once("config.php");    
$userfail = "0";
    $pwdfail = "0";
    $success = "0";
if (isset($_GET['success'])) {
 $success  = "1";
} 
if(isset($_POST['login'])){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){
        // verifikasi password
        if(password_verify($password, $user["password"])){
            // buat Session
            session_start();
            $_SESSION["user"] = $user;
            // login sukses, alihkan ke halaman timeline
            header("Location: index.php");
        } else {
          $userfail = "1";
              }
    } else {
$pwdfail = "1";
    }
}
?>
<!DOCTYPE html>
<html style="background-color: #292c2c;">
<head>
  <style type="text/css">.disclaimer { display: none; }</style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="language" content="English">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="js/login.js"></script>
   <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: #292c2c;">
<div class="card fly-margin shadow rounded text-center mx-auto d-flex" style="width: 85%; height: 100%;">
<div class="card-body">
<div class="text-center">
<main class="form-signin fly-margin">
  <form action="" method="POST" class="needs-validation" novalidate>
    <img class="mb-4" src="logo.png" alt="" width="100">
    <h3 class="h3 mb-3 fw-normal">Masuk Time Talk</h1>

<?php
if ($userfail == "1") {
    echo '<div class="alert alert-danger text-center" role="alert">
          <strong>Login Gagal!</strong> Username atau Password tidak sesuai!
          </div>';
} else if ($pwdfail == "1") {
    echo '<div class="alert alert-danger text-center" role="alert">
<strong>Login Gagal!</strong> Username atau Password tidak sesuai!
</div>';
} else if ($success == "1") {
      echo '<div class="alert alert-success text-center" role="alert">
<strong>Pendaftaran Berhasil!</strong> Silahkan Login Kembali
</div>';
}
?>
    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="username" autocomplete="off" placeholder="Username" required>
      <label for="username">Username atau Email</label>
    </div>
    <br>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
      <label for="password">Password</label>
    </div>
    <br>
    <button class="btn btn-primary" name="login" type="submit">Masuk</button>
    <a href="signup.php" class="btn btn-success">Daftar</a>
    <p class="mt-5 mb-3 text-muted">© 2022</p>
  </form>
</main>
</body></html>
