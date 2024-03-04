<?php
session_start();
require "../function/function.php";
$login = $_SESSION["login"];
$id_user = $_SESSION["id"];
$id_album = $_SESSION['id_album'];

if (!isset($_SESSION["login"])) {
    header("location: user/login.php");
}


if (isset($_GET['id_foto'])) {
    $id_foto = $_GET['id_foto'];
    $query = "DELETE FROM foto WHERE foto_id = $id_foto";

    if (mysqli_query($conn, $query)) {
        echo " <script>
        alert('berhasil dihapus');
        document.location.href = 'foto.php';
    </script>
    ";
    } else{
        echo " <script>
        alert('gagal dihapus');
        document.location.href = 'foto.php';
    </script>";
    }
}
?>