<?php
require_once("config.php");    
$userfail = "0";
$pwdfail = "0";
if(isset($_POST['register'])){

    if ($_POST["password"] == $_POST["con_password"]) {
    // filter data yang diinputkan
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // enkripsi password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $con_password = password_hash($_POST["con_password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];
    //check email username
    $stmt = $db->prepare('SELECT * FROM users WHERE username=:username OR email=:email');
    $params = array(
        ":username" => $username,
        ":email" => $email,
    );
    $stmt->execute($params);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if( ! $row) {

    // menyiapkan query
    $sql = "INSERT INTO users (username, email, password) 
            VALUES (:username, :email, :password)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":password" => $password,
        ":email" => $email,
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if($saved) header("Location: masuk.php?success=true");
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
   <script src="js/signup.js"></script>
   <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: #292c2c;">
<div class="card fly-margin shadow rounded text-center mx-auto d-flex" style="width: 85%; height: 100%;">
<div class="card-body">
<div class="text-center">
<main class="form-signin fly-margin">
  <form action="" method="POST" class="needs-validation" novalidate>
    <img class="mb-4" src="logo.png" alt="" width="100">
    <h3 class="h3 mb-3 fw-normal">Daftar Time Talk</h1>

<?php
if ($userfail == "1") {
        echo '<div class="alert alert-danger text-center" role="alert">
<strong>Pendaftaran Gagal!</strong><br> Email atau Username Telah Digunakan
</div>';
} else if ($pwdfail == "1") {
    echo '<div class="alert alert-danger text-center" role="alert">
<strong>Pendaftaran Gagal!</strong> Password tidak sesuai
</div>';
}
?>
     <div class="form-floating">
      <input name="username" type="text" class="form-control" id="username" autocomplete="off" placeholder="Username" required>
      <label for="username">Username</label>
    </div>
    <br>
    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="email" autocomplete="off" placeholder="Email" required>
      <label for="email">Email</label>
    </div>
    <br>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
      <label for="password">Password</label>
      <div id="pw_invalid" class="invalid-feedback">

    </div>
    </div>
    <br>
    <div class="form-floating">
      <input name="con_password" type="password" class="form-control" id="con_password" autocomplete="off" placeholder="Confirmation Password" required>
      <label for="con_password">Konfirmasi Password</label>
      <div id="con_invalid" class="invalid-feedback">

    </div>
    <div id="con_valid" class="valid-feedback">

    </div>
    </div>
    <br>
    <button type="submit" name="register" class="btn btn-primary btn-block">Daftar</button><br><br>
    <a href="masuk.php">Sudah punya akun? login disini!</a>
    <p class="mt-5 mb-3 text-muted">© 2022</p>
  </form>
</main>
</body></html>