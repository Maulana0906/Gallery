<?php
session_start();
require "../function/function.php";
$login = $_SESSION["login"];
$id = $_SESSION['id'];



if (!isset($_SESSION["login"])) {
    header("location: ../user/login.php");
}

$query_profile = mysqli_query($conn, "SELECT * FROM user  WHERE user_id = $id ");
$album = mysqli_query($conn, "SELECT COUNT(*) AS total_album FROM album  WHERE user_id = $id");
$album_asc = mysqli_fetch_assoc($album);

$foto = mysqli_query($conn, "SELECT *, COUNT(*) AS total_foto FROM foto WHERE user_id = $id");
$foto_asc = mysqli_fetch_assoc($foto);


?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
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
    <!-- nav -->
    <nav class="container-fluid navbar navbar-expand-lg position-fixed" style="z-index: 100; background-color: white;">
        <div class="container-fluid shadow-sm">
            <img src="../asset/img/logo black.JPG" style="width: 130px;" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse text-center navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto text-start gap-lg-5 mb-2 mb-lg-0" style="font-size: 17px;">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../public/album.php">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../public/foto.php">Foto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
                <a href="logout.php">
                    <button class="btn btn-outline-dark ms-3 py-1">Logout</button>
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid mx-auto row pt-5 ">
        <?php
        foreach ($query_profile as $prof) {
        ?>
            <div class="container-lg mx-auto" style=" height: 180px; background-image: url('../asset/img/bg-profile.jpg'); background-size: cover;">
                <div class="col-2 ms-auto d-flex justify-content-end">
                    <button class="btn mt-3 btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-pen-fill text-light m-0"></i>
                    </button>
                    <a href="../public/hapus_akun.php?id=<?= $id_user ?>" class="mx-2 " style="margin-top: 10px">
                        <button class="btn mt-1 btn-danger ">
                            <i class="bi bi-trash3-fill text-light"></i>
                        </button>
                    </a>
                </div>
            </div>
            <div class="container-lg mx-auto d-flex align-items-center flex-column flex-md-row ps-4" style="margin-top: -90px">
                <?php
                if (!$prof['lokasi_file'] == '') {
                ?>
                    <div class="border rounded-circle border border-2 shadow mb-2" style="width: 220px; height: 220px; background-color: white; background-image: url('../asset/img/<?= $prof['lokasi_file'] ?>'); background-size: cover; background-position: center;">
                    </div>
                <?php } else { ?>
                    <i class="bi bg-light border border-2 rounded-circle bi-person-circle" style="font-size : 200px; height: 200px; line-height: 0px;"></i>
                <?php } ?>

                <div class="px-4 align-self-md-end align-items-center text-center text-md-start" style="height: 110px; line-height: 7px">
                    <h4 class="fw-semibold">
                        <?= $prof['nama_lengkap'] ?><i style="font-size: 20px" class="ms-1 bi bi-patch-check-fill text-primary"></i>
                    </h4>
                    <ul class="d-flex flex-md-column flex-row flex-wrap justify-content-center gap-2 p-0" style="list-style-type: none;">
                        <li><i class="bi bi-geo-alt"></i>
                            <?= $prof['alamat'] ?>
                        </li>
                        <li><i class="bi bi-envelope"></i>
                            <?= $prof['email'] ?>
                        </li>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
    </div>
    <div class="container mx-auto d-flex justify-content-center">
        <div class="col-4 col-md-2 text-center">
            <p>Total album :</p>
            <button class="btn btn-dark text-white py-0" style="width: 100px;">
                <?= $album_asc['total_album'] ?>
            </button>
        </div>
        <div class="col-4 col-md-2 text-center">
            <p>Total foto :</p>
            <button class="btn btn-dark py-0" style="width: 100px;">
                <?= $foto_asc['total_foto'] ?>
            </button>
        </div>
    </div>
    <div class="container mx-auto mt-3">
        <div class="container rounded-4 mx-auto py-3">
            <h3 class="fw-semibold">Album</h3>
        </div>
        <div class="container mx-auto mt-3 d-flex gap-5">
            <?php
            $query_album = mysqli_query($conn, "SELECT * FROM album WHERE user_id = $id");
            foreach ($query_album as $qa) {
                $album_id = $qa['album_id'];
                $foto_album = mysqli_query($conn, "SELECT * FROM foto WHERE album_id = $album_id LIMIT 1");
                foreach ($foto_album as $qf) {
            ?>
                    <a href="../public/detail-album.php?id=<?= $qf['album_id'] ?>" style="text-decoration: none">
                        <div class="card border-0 " style="width: 200px">
                            <div class="card-img-top w-100" style="height: 200px; background-image: url('../asset/img/<?= $qf['lokasi_file'] ?>'); background-size: cover; background-position: center;">
                            </div>
                            <div class="card-body px-1">
                                <h5 class="card-title">
                                    <?= $qa['nama_album'] ?>
                                </h5>
                                <p class="card-text" style="font-size: 11px;">Deskripsi :
                                    <?= $qa['deskripsi'] ?>
                                </p>
                            </div>
                        </div>
                    </a>
            <?php }
            } ?>
        </div>
    </div>
    <div class="container mx-auto row" style="padding-top: 65px;">
        <div class="">
            <h2 class="mt-2 fw-semibold">Foto</h2>
        </div>
        <div class="grid">
            <?php
            $user_foto = mysqli_query($conn, "SELECT * FROM foto WHERE user_id = $id");
            foreach ($user_foto as $uf) {
            ?>
                <a href="../public/detail-foto.php?id_foto=<?= $uf['foto_id'] ?>">
                    <div class="grid-item">
                        <img src="../asset/img/<?= $uf['lokasi_file'] ?>" alt="">
                    </div>
                </a>
            <?php } ?>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php
                        foreach ($query_profile as $qp) {
                        ?>
                            <div id="profileImage" class="rounded-circle mx-auto mb-3 shadow" style="height: 150px; width: 150px; background-image: url('../asset/img/<?= $qp['lokasi_file'] ?>');
                     background-size: cover; background-position: center;"></div>
                            <div class="row g-3 align-items-center  justify-content-center">
                                <input type="file" class="mt-4" name="file_foto" onchange="previewImage(event)">
                                <input type="text" name="foto_lama" value="<?= $qp['lokasi_file'] ?>">
                                <div class="col-3">
                                    <label for="nama" class="col-form-label">Nama Lengkap :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" id="nama" style="width: 90%;" value="<?= $qp['nama_lengkap'] ?>" class="border-dark form-control" aria-describedby="passwordHelpInline" name="nama_lengkap">
                                </div>
                            </div>
                            <div class="row g-3 my-2 align-items-center  justify-content-center">
                                <div class="col-3">
                                    <label for="email" class="col-form-label">Email :</label>
                                </div>
                                <div class="col-9">
                                    <input type="email" id="email" value="<?= $qp['email'] ?>" style="width: 90%;" class="border-dark form-control" aria-describedby="passwordHelpInline" name="email">
                                </div>
                            </div>
                            <div class="row g-3 my-2 align-items-center  justify-content-center">
                                <div class="col-3">
                                    <label for="alamat" class="col-form-label">alamat :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" id="alamat" value="<?= $qp['alamat'] ?>" style="width: 90%;" class="border-dark form-control" aria-describedby="passwordHelpInline" name="alamat">
                                </div>
                            </div>
                        <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit_profile" class="btn btn-primary">Simpan Perubahan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container" style="height: 10vh"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="/path/to/masonry.pkgd.min.js"></script>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            var profileImage = document.getElementById('profileImage');

            reader.onload = function() {
                profileImage.style.backgroundImage = 'url(' + reader.result + ')';
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script src="/path/to/masonry.pkgd.min.js"></script>
    <script src="../asset/js/mansory.js"></script>
</body>

</html>