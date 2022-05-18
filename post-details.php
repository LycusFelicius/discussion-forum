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
$id = $_GET['id'];
$date = date("H:i Y/m/d");


// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(isset($_POST['submit'])){
    //edit score
    $data = mysqli_query($link,"SELECT * FROM users WHERE username LIKE '$username_sesi'");
    foreach ($data as $row_search) {   
        $score = $row_search['score'];
    }
    $score++;
    $sql = "UPDATE `users` SET `score`='$score' WHERE `username` LIKE '$username_sesi'";
        if(mysqli_query($link, $sql)){
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    //balas komentar
    if ($_POST['comment_id'] != "") {
        $content = $_POST['content'];
        $comment_id = $_POST['comment_id'];
        $sql = "INSERT INTO reply (post_id, comment_id, content, user_id, date) 
                VALUES ('$id',' $comment_id', '$content', '$user_id', '$date')";
        if(mysqli_query($link, $sql)){
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    } else {
        $content = $_POST['content'];
        $sql = "INSERT INTO comment_to_post (post_id, content, user_id, date) 
                VALUES ('$id', '$content', '$user_id', '$date')";
        if(mysqli_query($link, $sql)){
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
    //totalling
    $data_com = mysqli_query($link,"SELECT * FROM comment_to_post WHERE post_id='$id'");
    $data_rep = mysqli_query($link,"SELECT * FROM reply WHERE post_id='$id'");
    $count_com = mysqli_num_rows($data_com);
    $count_rep = mysqli_num_rows($data_rep);
    $total = $count_com + $count_rep;
    $sql = "UPDATE `post` SET `total_resp`='$total', `last_resp`='$date' WHERE `id` = '$id'";
    if(mysqli_query($link, $sql)){
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
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
    <script src="js/validity.js"></script>
    <script src="js/comments.js"></script>
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
          <a class="nav-link active" href="tulis.php" aria-current="page">Tulis Sesuatu</a>
        </li>
    </ul>
    <ul class="navbar-nav" style="">
           <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
<!--greeting area-->
<!--cards area-->
<div class="container" style="padding-top: 80px;">
            <br>
              <h4>Detail Postingan</h4>
              <br>
  <div class="row justify-content-lg-center">
    <div class="col">
    <?php
        //foreach area
        $sql = mysqli_query($link, "SELECT * FROM `post` WHERE `id` = '$id'");
        foreach ($sql as $row) {
            $judul = $row['title'];
            $isi = $row['content'];
            $category = $row['category'];
            $date = $row['date'];
            $id = $row['id'];
            $total_resp = $row['total_resp'];
                        if ($total_resp == "") {
                $total_resp = "Belum Ada";
            }
            echo '
            <div class="card mb-3 w-100 rounded shadow">
            <div class="card-body kiri-margin">
              <h5 class="card-title">'.$judul.'</h5>
              <p class="card-text">'.$isi.'</p>
              <p class="card-text"><small class="text-muted">'.$total_resp.' Respons<br>Kategori : '.$category.'<br>Dikirim pada '.$date.'<br></small><br>
              <a href="post-details.php?id='.$id.'" class="stretched-link"></a>
            </div>
          </div>';
        }
    ?>
    <br>
              <h4>Komentar</h4>

              <form action="" class="needs-validation" method="POST" novalidate>
              <input type="hidden" name="comment_id" id="comment_id"><input type="hidden" name="post_id" id="post_id" value="<?php echo $id; ?>">
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="content" id="commentbox" placeholder="Ketikkan sesuatu..." aria-label="" aria-describedby="button-addon2" autocomplete="off" required>
                <button class="btn btn-outline-danger" name="" onclick="cancel()" type="button" id="button-addon2">X</button>
                <button class="btn btn-outline-success" type="submit" name="submit">Kirim</button>
                </div>
    </form>
    <?php
            $sql = mysqli_query($link, "SELECT * FROM `comment_to_post` WHERE `post_id` = '$id'");
            $no = "1";
            foreach ($sql as $row) {
            $content = $row['content'];
            $date = $row['date'];
            $comment_id = $row['id'];
            $user_id = $row['user_id'];
            $sql = mysqli_query($link, "SELECT * FROM `users` WHERE `id`='$user_id'");
            $row = mysqli_fetch_assoc($sql);
            $username = $row['username'];
            echo '
            <div class="card mb-3 w-100 rounded shadow">
                    <div class="card-body kiri-margin">
                    <h5 class="card-title">'.$username.'</h5>
                    <p class="card-text">'.$content.'</p>
                    <p class="card-text"><small class="text-muted">Dikirim pada '.$date.'</small><br>
                    <button id="reply'.$no.'" onclick="reply('.$no.')" class="btn btn-clipboard ms-auto float-end text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reply" viewBox="0 0 16 16">
                    <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z"/>
                  </svg> Balas Komentar</button><br>
                  <input type="hidden" class="secret_username" id="secret_username'.$no.'" name="secret_username" value="'.$username.'">
                  <input type="hidden" class="secret_comment" id="secret_comment'.$no.'" name="secret_comment" value="'.$comment_id.'">
                  ';
                  $sql = mysqli_query($link, "SELECT * FROM `reply` WHERE `comment_id` = '$comment_id'");
                  foreach ($sql as $row) {
                    $content = $row['content'];
                    $date = $row['date'];
                    $comment_id = $row['id'];
                    $user_id = $row['user_id'];
                    $sql = mysqli_query($link, "SELECT * FROM `users` WHERE `id`='$user_id'");
                    $row = mysqli_fetch_assoc($sql);
                    $username = $row['username'];
            echo '
                  <div class="card">
        <div class="card-body rounded kiri-margin">
        <h5 class="card-title">'.$username.'</h5>
        <p class="card-text">'.$content.'</p>
        <p class="card-text"><small class="text-muted">Dikirim pada '.$date.'</small><br>
        </div>
    </div><br>';
        }
            echo '</div>
            </div>';
            $no++;
            }
          ?>
    <br>
</div>

    <div class="container">
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Beranda</a></li>
      <li class="nav-item"><a href="https://www.github.com/lycusfelicius" class="nav-link px-2 text-muted">Github</a></li>
      <li class="nav-item"><a href="https://www.instagram.com/yogar.n" class="nav-link px-2 text-muted">Instagram</a></li>
      <li class="nav-item"><a href="https://twitter.com/lycusfelicius" class="nav-link px-2 text-muted">Twitter</a></li>
    </ul>
    <p class="text-center text-muted">© 2022 Yoga Raditya</p>
  </footer>
</div>
</body>