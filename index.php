<?php
session_start();
require "function/function.php";
$login = $_SESSION["login"];
$id_user = $_SESSION["id"];

if (!isset($_SESSION["login"])) {
  header("location: user/login.php");
}
$album_global = mysqli_query($conn, "SELECT * FROM album WHERE user_id != $id_user");
$foto_global = mysqli_query($conn, "SELECT * FROM foto");


$my_album = mysqli_query($conn, "SELECT * FROM album ORDER BY total_komen DESC LIMIT 4 ");


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="asset/css/style.css">
  <!-- font google -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body>
  <nav class=" container-fluid navbar navbar-expand-lg position-fixed" style="z-index: 100; background-color: white;">
    <div class="container-fluid shadow-sm">
      <img src="asset/img/logo black.JPG" style="width: 130px;" alt="">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto gap-lg-5 mb-2 mb-lg-0 text-start" style="font-size: 17px;">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="public/album.php">Album</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="public/foto.php">Foto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user/profile.php">Profile</a>
          </li>
        </ul>
        <a href="user/logout.php">
          <button class="btn btn-outline-dark shadow-sm ms-3 mb-2 py-1">Logout</button>
        </a>

      </div>
    </div>
  </nav>

  <!-- content -->
  <div class="container-fluid p-0 row justify-content-center pt-5" style="height: 100vh;">
    <div class="col-md-7 col-xl-4 col-12 order-2 order-xl-1 d-flex align-items-center justify-content-center" style="line-height: 0px; flex-direction: column;">
      <p>Rasakan keindahan seni melalui gallery ini.</p>
      <h3 class="fw-semibold">Cari tahu sekarang !</h3>
      <a href="#content-2">
        <button class="btn btn-dark mt-4 py-1">Jelajahi </button>
      </a>
    </div>
    <div class="col-md-6 col-xl-3 order-1 order-xl-2 col-12">
      <div class="d-flex justify-content-center justify-content-lg-start gap-3 pt-5 mt-5" style="height: 370px;">
        <div class="bg-primary shadow align-self-end rounded-4" style="width: 120px; height: 250px; 
                background-image: url('asset/img/image\ 9.png'); background-size: cover; background-position: center;">
        </div>
        <div class="bg-primary shadow align-self-center rounded-4" style="width: 120px; height: 250px;
                background-image: url('asset/img/ok.jpeg'); background-size: cover; background-position: center;">
        </div>
        <div class="shadow bg-primary rounded-4" style="width: 120px; height: 250px;
                background-image: url('asset/img/gojo.webp'); background-size: cover; background-position: center;">
        </div>
      </div>
    </div>
  </div>

  <!-- content 2 -->
  <div class="container-fluid" id="content-2" style="height: 75vh;">
    <div class="container rounded-4 mx-auto text-center py-3">
      <h3 class="fw-semibold"> Album </h3>
      <p style="font-size: 13px;">Jelajahi keindahan dunia melalui galeri kami yang dipenuhi dengan kontribusi unik dari
        berbagai orang, menghadirkan ragam <br>
        inspirasi dan cerita dari sudut pandang yang beragam.</p>
    </div>
    <div class="container mx-auto mt-3 row d-flex justify-content-center">
      <?php
      foreach ($my_album as $rr) {
        $album_id = $rr['album_id'];
        $query_foto = mysqli_query($conn, "SELECT * FROM foto  WHERE album_id = $album_id LIMIT 1");
        $asc_foto = mysqli_num_rows($query_foto);
        if ($asc_foto === 1) {
          $qf = mysqli_fetch_array($query_foto);
      ?>
          <a class="card border-0 col-xl-2 col-6 col-sm-4" href="public/detail-album.php?id=<?= $rr['album_id'] ?>" style="text-decoration: none" ;>
            <div class="card-img-top w-100" style="height: 200px; background-image: url('asset/img/<?= $qf['lokasi_file'] ?>'); background-size: cover; background-position: center;">
            </div>
            <div class="card-body px-1">
              <h5 class="card-title">
                <?= $rr['nama_album'] ?>
              </h5>
              <p class="card-text" style="font-size: 10px;">Deskripsi :
                <?= $rr['deskripsi'] ?>
              </p>
            </div>
          </a>
        <?php } else {
        ?>
          <a class="card border-0 col-2" href="public/detail-album.php?id=<?= $rr['album_id'] ?>" style="text-decoration: none" ;>
            <div class="card-img-top w-100" style="height: 200px;">
            </div>
            <div class="card-body px-1">
              <h5 class="card-title">
                <?= $rr['nama_album'] ?>
              </h5>
              <p class="card-text" style="font-size: 10px;">Deskripsi :
                <?= $rr['deskripsi'] ?>
              </p>
            </div>
          </a>
      <?php

        }
      } ?>
    </div>

    <!-- content 3 -->
    <div class="container-fluid my-5">
      <div class="container mx-auto text-center py-3" style="background-color: #E8E8E8;">
        <h3 class="fw-semibold">Foto</h3>
        <p style="font-size: 13px;">Jelajahi keindahan dunia melalui galeri kami yang dipenuhi dengan kontribusi unik
          dari
          berbagai orang, menghadirkan ragam <br> inspirasi dan cerita dari sudut pandang yang beragam.</p>
        <a href="public/foto.php">
          <button class="btn btn-dark">Jelajahi !</button>
        </a>
      </div>
    </div>
    <footer class="container-fluid bg-dark d-flex justify-content-between align-items-center" style="height: 50px;">
      <div class="d-flex gap-1 pt-4">
        <i class="text-white bi bi-c-circle"></i>
        <p class="text-white">Gallery 2024</p>
      </div>
      <img src="asset/img/logo white.png" style="width: 150px;" alt="">
      <div class="">
        <i class="fs-5 mx-2 opacity-75 text-white bi bi-twitter"></i>
        <i class="fs-5 mx-2 text-white opacity-75 bi bi-github"></i>
        <i class="fs-5 mx-2 bi bi-linkedin opacity-75 text-white"></i>
        <i class="fs-5 mx-2 bi bi-envelope text-white opacity-75"></i>
      </div>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>