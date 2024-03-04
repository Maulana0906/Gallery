<?php
session_start();
require "../function/function.php";
$login = $_SESSION["login"];
$id_user = $_SESSION["id"];
$id_foto = $_GET['id'];
$id_album = $_GET['id_album'];

if (like($_POST) > 0) {
    echo " <script>
    document.location.href = 'detail-foto.php?id_foto=$id_foto&id_album=$id_album';
    </script>
    ";
} else {
    echo " <script>
    alert('like gagal');
    document.location.href = 'detail-foto.php?id_foto=$id_foto';
    </script>
    ";
}
