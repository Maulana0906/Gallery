<?php
session_start();

require '../function/function.php';

if (isset($_SESSION['login'])) {
    header("location:../index.php");
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) === 1) {

        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = "berhasil";
            $_SESSION["id"] = $row['user_id'];
            header("location:../index.php");
            exit;
        } else {
            echo "
        <script> 
        alert('password anda salah');
        </script>
        ";
        }
    } else {
        echo "
        <script> 
        alert('username anda salah');
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
    <title>Login</title>
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

    <div class="container-fluid mx-auto row justify-content-center d-flex align-items-center" style="height: 100vh;">
        <form action="" method="post" class="col-5 text-center">
            <img src="../asset/img/logo black.JPG" class="mb-3" style="width: 200px;" alt="">
            <div class="row g-3 my-4 align-items-center justify-content-center">
                <div class="col-3">
                    <label for="Username" class="col-form-label">Username :</label>
                </div>
                <div class="col-9">
                    <input type="text" name="username" id="username" style="width: 90%;" class="form-control border-dark" aria-describedby="passwordHelpInline">
                </div>
            </div>
            <div class="row g-3 align-items-center  justify-content-center">
                <div class="col-3">
                    <label for="inputPassword6" class="col-form-label">Password :</label>
                </div>
                <div class="col-9">
                    <input type="password" name="password" id="inputPassword6" style="width: 90%;" class="border-dark form-control" aria-describedby="passwordHelpInline">
                </div>
            </div>
            <div class="row justify-content-center">
                <button style="width: 40%;" class="btn btn-dark mt-4" type="submit" name="submit">Login</button>
                <a href="registrasi.php" class="mt-2">Registrasi !</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>