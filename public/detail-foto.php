<?php
session_start();
require "../function/function.php";
$login = $_SESSION["login"];
$id_user = $_SESSION["id"];
$id_foto = $_GET['id_foto'];
$id_album = $_GET['id_album'];


if (!isset($_SESSION["login"])) {
    header("location: ../user/login.php");
}

$query_komentar = mysqli_query($conn, "SELECT * FROM komentar_foto RIGHT JOIN user ON 
komentar_foto.user_id = user.user_id
WHERE foto_id = $id_foto");

$query_foto = mysqli_query($conn, "SELECT *,foto.lokasi_file FROM foto LEFT JOIN user ON user.user_id = foto.user_id WHERE foto_id = $id_foto");

// hak akses
$akses_user = mysqli_query($conn, "SELECT * FROM foto WHERE foto_id = $id_foto AND user_id = $id_user");
$num_akses_user = mysqli_num_rows($akses_user);

// menghitung like
$query_like = mysqli_query($conn, "SELECT COUNT(*) AS total_like FROM like_foto WHERE foto_id = $id_foto");
$like_asc = mysqli_fetch_assoc($query_like);


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Foto</title>
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
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto gap-lg-5 mb-2 mb-lg-0" style="font-size: 17px;">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="album.php">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="foto.php">Foto</a>
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

    <div class="container pt-5" style="overflow-x: hidden;">
        <div class="modal-content">
            <?php
            foreach ($query_foto as $qf) {
            ?>
                <div class="modal-body row" style="height: 100%">
                    <div class="col-md-5 col-12 border-end border-2">
                        <div class="d-flex pt-2">
                            <i style="font-size: 40px;" class=" bi bi-person-circle"></i>
                            <div class="d-flex p-2 flex-column " style="line-height: 7px;">
                                <h6>
                                    <?= $qf['nama_lengkap'] ?> - <span class="opacity-75">
                                        <?= $qf['tanggal_unggah'] ?>
                                    </span>
                                </h6>
                                <p style="font-size: 13px;">
                                    <?= $qf['alamat'] ?>
                                </p>
                            </div>
                            <?php
                            if ($num_akses_user === 1) {
                            ?>
                                <button class="btn btn-primary ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" style="height: 30px; line-height: 10px">
                                    <i class="bi bi-pen-fill text-light m-0" style="font-size: 13px;"></i></button>
                                <a href="hapus_foto.php?id_foto=<?= $id_foto ?>">
                                    <button onclick="return confirm('apakah anda yakin ingin menghapus album ini')" class="btn btn-danger mx-2 mt-3" style="height: 30px; line-height: 10px">
                                        <i class="bi bi-trash3-fill text-light" style="font-size: 13px;"></i>
                                    </button>
                                </a>
                            <?php } ?>
                        </div>
                        <img src="../asset/img/<?= $qf['lokasi_file'] ?>" style="width: 100%" alt="">
                        <div class="my-2">
                            <a href="like.php?id=<?= $id_foto ?> &id_album<?= $id_album ?>" style="text-decoration : none;">
                                <?php
                                $bt_like = mysqli_query($conn, "SELECT * FROM like_foto WHERE foto_id=$id_foto and user_id=$id_user");
                                $btn_like = mysqli_num_rows($bt_like);
                                if ($btn_like === 1) {
                                ?>
                                    <i class="bi bi-heart-fill text-danger" style="font-size:20px;">
                                        <span style="font-size: 13px;">
                                            <?= $like_asc['total_like'] ?> likes
                                        </span></i>
                                <?php } else { ?>
                                    <i style="font-size: 20px;" class="bi me-2 bi-heart"> <span style="font-size: 13px;">
                                            <?= $like_asc['total_like'] ?>
                                            likes
                                        </span> </i>
                                <?php } ?>
                            </a>
                        </div>
                        <div class="">
                            <h6 class="fw-semibold">Judul :
                                <?= $qf['judul_foto'] ?>
                            </h6>
                            <p style="font-size: 13px;">
                                <?= $qf['deskripsi_foto'] ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-7 col-12 bg-body-secondary h-100">
                    <h3 class="mt-3 text-center fw-semibold">Komentar</h3>
                    <?php
                    foreach ($query_komentar as $qk) {
                    ?>
                        <div class="w-100 d-flex gap-1 align-items-center py-1 my-2 ">
                            <?php
                            if (!$qk['lokasi_file'] == '') {
                            ?>
                                <div class="rounded-circle" style="width: 30px; height: 30px; background-image: url('../asset/img/<?= $qk['lokasi_file'] ?>'); background-size: cover; background-position: center;"></div>
                            <?php } else { ?>
                                <i style="font-size: 30px;" class="bi bi-person-circle"></i>
                            <?php } ?>
                            <p class=" m-0" style="font-size: 12px; line-height: 15px">
                                <span class="fs-6 fw-semibold">
                                    <?= $qk['nama_lengkap'] ?>
                                </span> <br>
                                <?= $qk['isi_komentar'] ?>
                            </p>
                        </div>
                    <?php } ?>
                    <div class="w-100" style="height: 60px"></div>
                    <div class="w-100 position-fixed" style="bottom: 0; height: 50px; background-color: white;">
                        <form action="komentar.php" method="post">
                            <input type="text" name="komentar" class="py-1 px-2 rounded-3" style="width: 25rem;">
                            <input type="hidden" name="id_foto" value="<?= $id_foto ?>">
                            <input type="hidden" name="id_album" value="<?= $id_album ?>">
                            <input type="hidden" name="tgl" value="<?php echo date('Y-m-d'); ?>">
                            <button type="submit" name="submit_komentar" class="border-0">
                                <i style="font-size: 20px; cursor: pointer; padding: 3px 10px" class="rounded-3 text-white ms-2 bi bi-send-fill bg-dark"></i>
                            </button>
                        </form>
                    </div>
                </div>
                </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="post" enctype="multipart/form-data">
                <?php
                foreach ($query_foto as $ef) {
                ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Foto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_foto" value="<?= $ef['foto_id'] ?>">
                            <input type="hidden" name="foto_lama" value="<?= $ef['lokasi_file'] ?>">
                            <div class="row g-3 align-items-center  justify-content-center">
                                <div class="col-3">
                                    <label for="judul" class="col-form-label">Judul :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="judul_foto" value="<?= $ef['judul_foto'] ?>" id="judul" style="width: 90%;" class="border-dark form-control" aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 my-2 align-items-center  justify-content-center">
                                <div class="col-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi :</label>
                                </div>
                                <div class="col-9">
                                    <textarea type="text" name="deskripsi_foto" id="deskripsi" style="width: 90%;" class="border-dark form-control" aria-describedby="passwordHelpInline"><?= $ef['deskripsi_foto'] ?> </textarea>
                                </div>
                            </div>
                        </div>
                        <input class="mt-2 mb-5 ps-3" type="file" name="file_foto">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="edit_foto" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="/path/to/masonry.pkgd.min.js"></script>
    <script src="../asset/js/mansory.js"></script>


</body>

</html>