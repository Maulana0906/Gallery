<?php
session_start();
require "../function/function.php";
$login = $_SESSION["login"];
$id_user = $_SESSION["id"];


if (!isset($_SESSION["login"])) {
    header("location: user/login.php");
}
$query_album = mysqli_query($conn, "SELECT * FROM album ");


if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    if ($kategori === 'dll') {
        $query_album = mysqli_query($conn, "SELECT * FROM album 
        WHERE kategori != 'semua' 
        AND kategori NOT IN ('pemandangan', 'background', 'poster', 'alami', 'anime', 'transportasi', 'vector', 'hewan', 'spiritual')
        ");
        if (!$query_album) {
            die(mysqli_error($conn));
        }
    } else {
        $query_album = mysqli_query($conn, "SELECT * FROM album WHERE kategori = '$kategori'");
        if (!$query_album) {
            die(mysqli_error($conn));
        }
    }
}

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    if ($sort == 'terbaru') {
        $query_album = mysqli_query($conn, "SELECT * FROM album ORDER BY tanggal_buat DESC ");
    } else if ($sort == 'terlama') {
        $query_album = mysqli_query($conn, "SELECT * FROM album ORDER BY tanggal_buat ASC ");
    } else if ($sort == 'asc') {
        $query_album = mysqli_query($conn, "SELECT * FROM album ORDER BY nama_album ASC ");
    } else if ($sort == 'desc') {
        $query_album = mysqli_query($conn, "SELECT * FROM album ORDER BY nama_album DESC ");
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Album</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <!-- font google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body>
    <nav class="container-fluid navbar navbar-expand-lg position-fixed" style="z-index: 100; background-color: white;">
        <div class="container-fluid shadow-sm">
            <img src="../asset/img/logo black.JPG" style="width: 130px;" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto gap-lg-5 mb-2 mb-lg-0 text-start" style="font-size: 17px;">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Album</a>
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

    <div class="container-fluid mx-auto row" style=" padding-top: 50px;">
        <div class="container rounded-4 mx-auto text-center">
            <h2 class="fw-bold">Album</h2>
        </div>
        <ul class="d-flex gap-5 mt-4" style="list-style-type: none; overflow-x: auto" id="kategoriAlbum">
            <a href="album.php" style="text-decoration: none;">
                <li class="rounded-4 btn btn-outline-dark" style="font-size: 12px; padding: 3px 10px">
                    Semua
                </li>
            </a>
            <a href="album.php?kategori=pemadangan" style="text-decoration: none;">
                <li class="rounded-4 btn btn-outline-dark" style="font-size: 12px; padding: 3px 10px">
                    Pemandangan
                </li>
            </a>
            <a href="album.php?kategori=background" style="text-decoration: none;">
                <li class="rounded-4 btn btn-outline-dark" style="font-size: 12px; padding: 3px 10px"> Background
                </li>
            </a>
            <a href="album.php?kategori=poster" style="text-decoration: none;">
                <li class="rounded-4 btn btn-outline-dark" style="font-size: 12px; padding: 3px 10px"> Poster
                </li>
            </a>
            <a href="album.php?kategori=alami" style="text-decoration: none;">
                <li class="rounded-4 btn btn-outline-dark" style="font-size: 12px; padding: 3px 10px"> Alami
                </li>
            </a>
            <a href="album.php?kategori=anime" style="text-decoration: none;">
                <li class="rounded-4 btn btn-outline-dark" style="font-size: 12px; padding: 3px 10px"> Anime
                </li>
            </a>
            <a href="album.php?kategori=transportasi" style="text-decoration: none;">
                <li class="rounded-4 btn btn-outline-dark" style="font-size: 12px; padding: 3px 10px"> Transportasi
                </li>
            </a>
            <a href="album.php?kategori=vector" style="text-decoration: none;">
                <li class="rounded-4 btn btn-outline-dark" style="font-size: 12px; padding: 3px 10px"> Vector
                </li>
            </a>
            <a href="album.php?kategori=hewan" style="text-decoration: none;">
                <li class="rounded-4 btn btn-outline-dark" style="font-size: 12px; padding: 3px 10px"> Hewan
                </li>
            </a>
            <a href="album.php?kategori=spiritual" style="text-decoration: none;">
                <li class="rounded-4 btn btn-outline-dark" style="font-size: 12px; padding: 3px 10px"> Spiritual
                </li>
            </a>
            <a href="album.php?kategori=dll" style="text-decoration: none;">
                <li class="rounded-4 btn btn-outline-dark" style="font-size: 12px; padding: 3px 10px"> Dll
                </li>
            </a>
        </ul>

        <div class="container">
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 13px">
                    Urutkan Berdasarkan
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="album.php?sort=terbaru">Terbaru</a></li>
                    <li><a class="dropdown-item" href="album.php?sort=terlama">Terlama</a></li>
                    <li><a class="dropdown-item" href="album.php?sort=asc">A - Z</a></li>
                    <li><a class="dropdown-item" href="album.php?sort=desc">Z - A </a></li>
                </ul>
            </div>
        </div>

        <div class="container mx-auto mt-3 row d-flex   ">
            <?php
            foreach ($query_album as $qa) {
                $album_id = $qa['album_id'];
                $query_foto = mysqli_query($conn, "SELECT * FROM foto WHERE album_id = $album_id LIMIT 1");
                $asc_foto = mysqli_num_rows($query_foto);
                if ($asc_foto === 1) {
                    $qf = mysqli_fetch_array($query_foto);

            ?>
                    <a href="detail-album.php?id=<?= $qa['album_id'] ?>" style="text-decoration: none;" class="card border-0 col-xl-2 col-6 col-sm-4">
                        <div class="card-img-top w-100 border" style="height: 200px; background-image: url('../asset/img/<?= $qf['lokasi_file'] ?>'); background-size: cover; background-position: center;">
                        </div>
                        <div class="card-body px-1">
                            <h5 class="card-title">
                                <?= $qa['nama_album'] ?>
                            </h5>
                            <p class="card-text" style="font-size: 11px;">Deskripsi :
                                <?= $qa['deskripsi']; ?>
                            </p>
                        </div>
                    </a>
                <?php
                } else {
                ?>
                    <a href="detail-album.php?id=<?= $qa['album_id'] ?>" style="text-decoration: none;" class="card border-0 col-2">
                        <div class="w-100 rounded-2 border" style="height: 200px;"></div>
                        <div class="card-body px-1">
                            <h5 class="card-title">
                                <?= $qa['nama_album'] ?>
                            </h5>
                            <p class="card-text" style="font-size: 11px;">Deskripsi :
                                <?= $qa['deskripsi']; ?>
                            </p>
                        </div>
                    </a>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah Album
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah album</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="text" name="nama_album">
                        <input type="text" name="deskripsi">
                        <input type="text" name="tgl" value="<?= date("Y-m-d") ?>">
                        <button type="submit" name="submit_album">kirim</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>