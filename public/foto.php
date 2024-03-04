<?php
session_start();
require "../function/function.php";
$login = $_SESSION["login"];
$id_user = $_SESSION["id"];

if (!isset($_SESSION["login"])) {
    header("location: ../user/login.php");
}

$query_foto = mysqli_query($conn, "SELECT * FROM foto");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- font google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="../asset/css/style.css">

    <!-- mansory js -->
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

</head>

<body>
    <nav class="container-fluid navbar navbar-expand-lg position-fixed" style="z-index: 100; background-color: white;">
        <div class="container-fluid shadow-sm">
            <img src="../asset/img/logo black.JPG" style="width: 130px;" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto gap-lg-5 mb-2 text-start mb-lg-0" style="font-size: 17px;">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="album.php">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Foto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/profile.php">Profile</a>
                    </li>
                </ul>
                <a href="../user/logout.php">
                    <button class="btn btn-outline-dark ms-3 py-1">Logout</button>
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid mx-auto row" style="padding-top: 65px;">
        <div class="">
            <h2 class="text-center fw-semibold">Foto</h2>
        </div>
        <div class="grid">
            <?php
            foreach ($query_foto as $qf) {
            ?>
                <div class="grid-item">
                    <a href="detail-foto.php?id_foto=<?= $qf['foto_id'] ?>">
                        <img src="../asset/img/<?= $qf['lokasi_file'] ?>" alt="">
                    </a>
                </div>
            <?php } ?>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="/path/to/masonry.pkgd.min.js"></script>
    <script src="../asset/js/mansory.js"></script>

</body>

</html>