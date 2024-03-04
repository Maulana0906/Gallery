<?php
require '../function/function.php';

if (isset($_POST['submit'])) {
    if (registrasi($_POST) > 0) {
        echo " <script>
            alert('Registrasi berhasil');
            document.location.href = 'login.php';
            </script>";
    } else {
        echo " <script>
            alert('Registrasi gagal');
            document.location.href = 'registrasi.php';
            </script>
            ";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../asset/css/style.css">
    <!-- font google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body>

    <div class="container mx-auto row gap-2 justify-content-center d-flex align-items-center">
        <form method="post" action="" enctype="multipart/form-data" class="col-7 text-center my-2 border border-2 rounded-3 shadow py-2">
            <div class="w-100 mb-4 border-bottom">
                <h2 class="text-center">Registrasi</h2>
            </div>
            <div id="imagePreview" class="rounded-circle border mx-auto mb-2 border-2 shadow-sm" style="width: 200px; height: 200px; background-size: cover; background-position: center;"></div>
            <input type="file" name="file_foto" id="fileInput" accept="image/*" onchange="previewImage(event)">

            <div class="row g-3 align-items-center my-1 justify-content-center">
                <div class="col-3">
                    <label for="nama" class="col-form-label">Nama Lengkap :</label>
                </div>
                <div class="col-9">
                    <input type="text" id="nama" name="nama_lengkap" style="width: 90%;" class="form-control border-dark" aria-describedby="passwordHelpInline">
                </div>
            </div>
            <div class="row g-3 my-1 align-items-center justify-content-center">
                <div class="col-3">
                    <label for="email" class="col-form-label">Email :</label>
                </div>
                <div class="col-9">
                    <input type="email" id="email" name="email" style="width: 90%;" class="form-control border-dark" aria-describedby="passwordHelpInline">
                </div>
            </div>
            <div class="row g-3 my-1 align-items-center justify-content-center">
                <div class="col-3">
                    <label for="alamat" class="col-form-label">Alamat :</label>
                </div>
                <div class="col-9">
                    <input type="text" name="alamat" id="alamat" style="width: 90%;" class="form-control border-dark" aria-describedby="passwordHelpInline">
                </div>
            </div>
            <div class="row g-3 my-1 align-items-center justify-content-center">
                <div class="col-3">
                    <label for="Username" class="col-form-label">Username :</label>
                </div>
                <div class="col-9">
                    <input type="text" name="username" id="username" style="width: 90%;" class="form-control border-dark" aria-describedby="passwordHelpInline">
                </div>
            </div>
            <div class="row g-3 my-1 align-items-center  justify-content-center">
                <div class="col-3">
                    <label for="inputPassword6" class="col-form-label">Password :</label>
                </div>
                <div class="col-9">
                    <input type="password" name="password" id="inputPassword6" style="width: 90%;" class="border-dark form-control" aria-describedby="passwordHelpInline">
                </div>
            </div>
            <div class="row g-3 my-1 align-items-center  justify-content-center">
                <div class="col-3">
                    <label for="inputPassword6" class="col-form-label">Confirm password :</label>
                </div>
                <div class="col-9">
                    <input type="password" name="password2" id="inputPassword6" style="width: 90%;" class="border-dark form-control" aria-describedby="passwordHelpInline">
                </div>
            </div>
            <div class="row justify-content-center">
                <button style="width: 40%;" type="submit" name="submit" class="btn btn-dark mt-4">registrasi</button>
                <a href="login.php" class="mt-2">Login !</a>
            </div>
        </form>
    </div>
    <div class="container" style="height: 40px"></div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function previewImage(event) {
        var reader = new FileReader();

        reader.onload = function() {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.style.backgroundImage = 'url(' + reader.result + ')';
        }

        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</html>