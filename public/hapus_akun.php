<?php
session_start();
require "../function/function.php";
$login = $_SESSION["login"];
$id_user = $_GET["id"];

if (!isset($_SESSION["login"])) {
    header("location: user/login.php");
}

if (isset($_GET['id'])) {
    $query = "DELETE FROM user WHERE user_id = $id_user";

    if (mysqli_query($conn, $query)) {
        echo " <script>
        alert('berhasil dihapus');
        document.location.href = '../user/login.php';
        session_start();
        session_unset();
        session_destroy();
    </script>
    ";
    } else{
        echo " <script>
        alert('gagal dihapus');
        document.location.href = '../user/login.php';
    </script>";
    }
}
?>