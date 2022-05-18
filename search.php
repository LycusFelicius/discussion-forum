<?php
require_once("auth.php"); 
require_once("config.php");
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
$username_sesi = $_SESSION["user"]["username"];
$key = $_GET['key'];
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
    <title>Forum Smanawa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
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
          <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
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
<div class="container-bg">
    <div class="container text-center putih">
        <h1 class="text-container"><img class="logo" src="logo.png"></h1>
        <hr>
        <p>Website yang dibuat untuk mengirimkan menfess, berdiskusi, maupun mengirimkan kritik dan saran.<br><em>Tanyakan apapun disini, have fun all!</em></p>
        <br>
        <form method="GET" action="search.php">
            <div class="input-group mb-3">
                <input type="text" name="key" class="form-control" placeholder="Ketikkan judul tulisan yang dicari" aria-label="" aria-describedby="button-addon2" autocomplete="off" required>
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
            </div>
            <p class=""><em>Malu bertanya sesat di jalan :)<em></p>
        </form>
    </div>
</div>
<br>
<!--cards area-->
<div class="container">
  <div class="row justify-content-lg-center">
    <div class="col">
        <h4>Hasil Pencarian : <?php echo $key; ?></h4><br>
    <?php
    				$batas = 10;
            $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
     
            $previous = $halaman - 1;
            $next = $halaman + 1;
            
            $data = mysqli_query($link,"SELECT * from `post` WHERE title LIKE '$key'");
            $jumlah_data = mysqli_num_rows($data);
            $total_halaman = ceil($jumlah_data / $batas);
     
            $nomor = $halaman_awal+1;
        //foreach area
        $sql = mysqli_query($link, "SELECT * FROM `post` WHERE title LIKE '%$key%' OR category LIKE '%$key%' OR content LIKE '%$key%' ORDER BY id DESC LIMIT $halaman_awal, $batas");
        foreach ($sql as $row) {
            $judul = $row['title'];
            $isi = $row['content'];
            $category = $row['category'];
            $date = $row['date'];
            $id = $row['id'];
            $total_resp = $row['total_resp'];
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
    <div class="card text-center buku">
  <div class="card-header">
    Tidak menemukan apa yang anda cari?
  </div>
  <div class="card-body">
    <h5 class="card-title"></h5>
    <p class="card-text">Coba cari menggunakan kata kunci lain atau periksa di halaman selanjutnya!</p>
    <a href="index.php" class="btn btn-primary">Halaman Utama</a>
  </div>
</div>
<br>
<div class="card" style="margin-bottom: 10px;">
  <div class="card-body shadow rounded">
  <?php
    $data = mysqli_query($link,"SELECT * from `post` WHERE `user_id` = '$user_id'");
    $jumlah_data = mysqli_num_rows($data);
    $data_comments = mysqli_query($link,"SELECT * from `comment_to_post` WHERE `user_id` = '$user_id'");
    $jumlah_comments = mysqli_num_rows($data_comments);
    $data_reply = mysqli_query($link,"SELECT * from `reply` WHERE `user_id` = '$user_id'");
    $jumlah_reply = mysqli_num_rows($data_reply);
    $total_comments = $jumlah_comments + $jumlah_reply;
    echo '<h5 class="text-center">Statistik User</h5>
    <hr>
    <div class="card">
        <div class="card-body rounded">
            <p>'.$jumlah_data.' Pertanyaan <br>
            '.$total_comments.' Jawaban</p>
        </div>
    </div>';
    ?>
  </div>
</div>
<div class="card" style="margin-bottom: 10px;">
  <div class="card-body shadow rounded">
  <h5 class="text-center">Leaderboards</h5>
    <hr>
        <div class="card">
        <div class="card-body rounded">
    <p>
    <?php
    $no=1;
  $sql = mysqli_query($link, "SELECT * FROM `users` ORDER BY score DESC LIMIT 5");
  foreach ($sql as $row) {
      $username = $row['username'];
      $score = $row['score'];
  echo $no.'. '.$username.' ('.$score.' Score) <br>';
  $no++;
    }
    ?>
    </p>
    </div>
</div>
  </div>
</div>
    </div>
<nav>
			<ul class="pagination fly-margin justify-content-center">
				<li class="page-item">
					<a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Sebelumnya</a>
				</li>
				<?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>				
				<li class="page-item">
					<a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Selanjutnya</a>
				</li>
			</ul>
		</nav>
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