<?php
$id_album = $_GET['id'];
session_start();
require "../function/function.php";
$login = $_SESSION["login"];
$id_user = $_SESSION["id"];


if (!isset($_SESSION["login"])) {
    header("location: user/login.php");
}
$query_foto = mysqli_query($conn, "SELECT * FROM foto WHERE album_id=$id_album");
$query_album = mysqli_query($conn, "SELECT * FROM album LEFT JOIN user ON user.user_id = album.user_id WHERE album_id=$id_album");
$akses_user = mysqli_query($conn, "SELECT * FROM album WHERE album_id=$id_album AND user_id=$id_user");
$num_akses_user = mysqli_num_rows($akses_user);
$edit_album = mysqli_query($conn, "SELECT * FROM album WHERE album_id=$id_album");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Album</title>
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

    <?php
    foreach ($query_album as $qa) {
    ?>
        <div class="container-md row pt-5 mx-auto bg-secondary-subtle rounded-3 mb-3" style="height: 250px;">
            <div class="col-6 pt-3 d-flex flex-column justify-content-between">
                <h6>Create by
                    <span class="fw-semibold">
                        <?= $qa['nama_lengkap'] ?>
                    </span> - <span class="opacity-50" style="font-size : 14px">
                        <?= $qa['tanggal_buat'] ?>
                    </span>
                </h6>
                <div class="">
                    <h5>
                        <?= $qa['nama_album'] ?>
                    </h5>
                    <p style="font-size: 13px;">Deskripsi :
                        <?= $qa['deskripsi'] ?>
                    </p>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <?php
                if (mysqli_num_rows($akses_user) == 1) {
                ?>
                    <button class="btn btn-success mt-3 px-2" style="height: 40px" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                        <i class="bi bi-plus-lg text-light fs-4" style="line-height: 10px"></i>
                    </button>
                    <button class="btn mt-3 btn-primary ms-1" style="height: 40px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-pen-fill text-light m-0"></i>
                    </button>
                    <a href="hapus_album.php?id_album1=<?= $id_album ?>">
                        <button onclick="return confirm('apakah anda yakin ingin menghapus album ini')" class="btn mt-3 btn-danger ms-1">
                            <i class="bi bi-trash3-fill text-light"></i>
                        </button>
                    </a>

                <?php
                } ?>
            </div>
        </div>

        <div class="container mx-auto">
            <div class="grid">
            <?php }
        foreach ($query_foto as $qf) {
            ?>
                <div class="grid-item">
                    <a href="detail-foto.php?id_foto=<?= $qf['foto_id'] ?>&id_album=<?= $id_album ?>">
                        <img src="../asset/img/<?= $qf['lokasi_file'] ?>" alt="">
                    </a>
                </div>
            <?php } ?>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Album</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" class="modal-body">
                        <?php
                        foreach ($edit_album as $ef) {
                        ?>
                            <div class="row g-3 align-items-center  justify-content-center">
                                <div class="col-3">
                                    <label for="judul" class="col-form-label">Nama album :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" id="judul" style="width: 90%;" class="border-dark form-control" aria-describedby="passwordHelpInline" value="<?= $ef['nama_album'] ?>" name="nama_album">
                                </div>
                            </div>
                            <input type="hidden" value="<?= $ef['album_id'] ?>" name="id_album">
                            <input type="hidden" name="tgl" value="<?= $ef['tanggal_buat'] ?>">
                            <div class="row my-2 align-items-center">
                                <div class="col-3">
                                    <label for="deskripsi" class="col-form-label text-start">Deskripsi :</label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control p-1" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="deskripsi"> <?= $ef['deskripsi'] ?> </textarea>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit" name="edit_album">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah foto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row g-3 align-items-center  justify-content-center">
                                <div class="col-3">
                                    <label for="judul" class="col-form-label">Judul :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" name="judul_foto" id="judul" style="width: 90%;" class="border-dark form-control" aria-describedby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row g-3 my-2 align-items-center  justify-content-center">
                                <div class="col-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi :</label>
                                </div>
                                <div class="col-9">
                                    <textarea type="text" name="deskripsi_foto" id="deskripsi" style="width: 90%;" class="border-dark form-control" aria-describedby="passwordHelpInline"></textarea>

                                </div>
                            </div>
                            <input class="mt-2 mb-5" type="file" name="file_foto">
                            <input type="hidden" name="album_id" value="<?= $id_album ?>">
                            <input type="hidden" name="user_id" value="<?= $id_user ?>">
                            <input type="hidden" name="tgl" value="<?= date("Y-m-d") ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="tmbh_foto" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        <script src="   /path/to/masonry.pkgd.min.js"></script>
        <script src="../asset/js/mansory.js"></script>


</body>

</html>