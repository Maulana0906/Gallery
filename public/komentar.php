<?php
session_start();
require "../function/function.php";
$login = $_SESSION["login"];
$id_user = $_SESSION["id"];
$id_foto = $_POST['id_foto'];
$id_album = $_POST['id_album'];

if (isset($_POST['submit_komentar'])) {
    $komen = htmlspecialchars($_POST['komentar']);
    $tgl = htmlspecialchars($_POST['tgl']);
    $query = "INSERT INTO komentar_foto VALUES ('', '$id_foto', '$id_user', '$komen', '$tgl', '$id_album')";

    if (mysqli_query($conn, $query)) {
        $query = "UPDATE album SET total_komen = total_komen + 1 WHERE album_id = $id_album";
        mysqli_query($conn, $query);
        echo " <script>
    document.location.href = 'detail-foto.php?id_foto=$id_foto&id_album=$id_album';
    </script>
    ";
        exit;
    } else {
        echo " <script>
    alert('komentar gagal');
    document.location.href = 'detail-foto.php?id_foto=$id_foto&id_album=$id_album';
    </script>
    ";
    }
}
