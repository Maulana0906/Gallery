<?php
session_start();
require "../function/function.php";
$login = $_SESSION["login"];
$id_user = $_SESSION["id"];
$id_album = $_GET['id_album1'];

if (!isset($_SESSION["login"])) {
    header("location: user/login.php");
}


if (isset($_GET['id_album1'])) {
    $query = "DELETE FROM album WHERE album_id = $id_album";

    if (mysqli_query($conn, $query)) {
        echo " <script>
        alert('berhasil dihapus');
        document.location.href = 'album.php';
    </script>
    ";
    } else{
        echo " <script>
        alert('gagal dihapus');
        document.location.href = 'album.php';
    </script>";
    }
}
?>