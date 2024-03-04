<?php
$conn = mysqli_connect("localhost", "root", "", "db_gallery1");
$id_user = isset($_SESSION["id"]) ? $_SESSION["id"] : '';

// upload foto
function upload_foto()
{
    $namaFile = $_FILES['file_foto']['name'];
    $error = $_FILES['file_foto']['error'];
    $tmpName = $_FILES['file_foto']['tmp_name'];

    // cek apakah ada gambar yang di upload 
    if ($error === 4) {
        echo " <script>
        alert('tidak ada foto yang di upload');
        </script>
        ";
        return false;
    }

    // cek apakah ini benar foto
    $ekstensionValid = ['jpg', 'png', 'jpeg', 'svg'];
    $ekstensionFoto = explode('.', $namaFile);
    $ekstensionFoto = strtolower(end($ekstensionFoto));
    if (!in_array($ekstensionFoto, $ekstensionValid)) {
        echo " <script>
        alert('ini bukan foto');
        </script>
        ";
        return false;
    }

    // nama foto baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensionFoto;

    move_uploaded_file($tmpName, '../asset/img/' . $namaFileBaru);
    return $namaFileBaru;
}

function registrasi()
{
    global $conn;
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);
    $email = htmlspecialchars($_POST['email']);
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
    $alamat = htmlspecialchars($_POST['alamat']);

    $foto = upload_foto();
    if (!$foto) {
        return false;
    }

    $result = mysqli_query($conn, "SELECT * FROM user WHERE Username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah ada');
        </script>";
        return false;
    }
    if ($password !== $password2) {
        echo "<script>
        alert('password tidak sama');
        </script>";
        return false;
    }
    $password_hash = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));


    $query = "INSERT INTO user VALUES
    ('', '$username', '$password_hash', '$email', '$nama_lengkap', '$alamat', '$foto')";
    $result = mysqli_query($conn, $query);

    return (mysqli_affected_rows($conn));
}

function like()
{
    global $conn, $id_foto, $id_user, $id_album;
    $sql = mysqli_query($conn, "SELECT * FROM like_foto WHERE foto_id=$id_foto and user_id=$id_user");

    if (mysqli_num_rows($sql) == 1) {
        mysqli_query($conn, "DELETE FROM like_foto WHERE foto_id=$id_foto and user_id=$id_user");
    } else {
        $tgl = date("Y-m-d");
        mysqli_query($conn, "INSERT INTO like_foto VALUES ('','$id_foto', '$id_user', '$tgl')");
    }
    return (mysqli_affected_rows($conn));
}

// tambah album
if (isset($_POST['submit_album'])) {
    $nama = htmlspecialchars($_POST['nama_album']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $tgl = htmlspecialchars($_POST['tgl']);

    $query = "INSERT INTO album VALUES ('', '$nama', '$deskripsi', '$tgl', '$id_user', '$tgl')";
    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
    if ($_POST > 0) {
        echo " <script>
        alert('berhasil menambahkan album');
        </script>
        ";
    } else {
        echo " <script>
        alert('gagal'); 
        </script>
        ";
    }
}

// edit album
if (isset($_POST['edit_album'])) {
    $id_album = htmlspecialchars($_POST['id_album']);
    $nama = htmlspecialchars($_POST['nama_album']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $tgl = htmlspecialchars($_POST['tgl']);
    $tgl_edit = date("Y-m-d");

    $query = "UPDATE album SET nama_album='$nama', deskripsi='$deskripsi', tanggal_buat='$tgl',
    user_id='$id_user', tgl_edit='$tgl_edit' WHERE album_id = $id_album";

    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
    if ($_POST > 0) {
        echo " <script>
        alert('berhasil edit album');
        </script>
        ";
    } else {
        echo " <script>
        alert('gagal'); 
        </script>
        ";
    }
}



// tambah foto di album
if (isset($_POST['tmbh_foto'])) {
    $judul = htmlspecialchars($_POST['judul_foto']);
    $deskripsi = htmlspecialchars($_POST['deskripsi_foto']);
    $tgl = date("Y-m-d");

    $foto = upload_foto();
    if (!$foto) {
        return false;
    }
    $album_id = htmlspecialchars($_POST['album_id']);
    $user_id = htmlspecialchars($_POST['user_id']);


    $query = "INSERT INTO foto VALUES ('', '$judul', '$deskripsi', '$tgl', '$foto', '$album_id','$user_id')";
    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
    if ($_POST > 0) {
        echo " <script>
        alert('berhasil menambahkan foto di album');
        </script>
        ";
    } else {
        echo " <script>
        alert('gagal'); 
        </script>
        ";
    }
}

// edit foto
if (isset($_POST['edit_foto'])) {
    $foto_id = htmlspecialchars($_POST['id_foto']);
    $foto_lama = htmlspecialchars($_POST['foto_lama']);
    $judul = htmlspecialchars($_POST['judul_foto']);
    $deskripsi = htmlspecialchars($_POST['deskripsi_foto']);

    if ($_FILES['file_foto']['error'] === 4) {
        $foto = $foto_lama;
    } else {
        $foto = upload_foto();
    }

    $query = "UPDATE foto SET judul_foto='$judul', deskripsi_foto='$deskripsi', lokasi_file='$foto' WHERE foto_id = $foto_id";
    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
    if ($_POST > 0) {
        echo " <script>
        alert('berhasil edit foto');
        </script>
        ";
    } else {
        echo " <script>
       ('gagal'); 
        </script>
        ";
    }
}

if (isset($_POST['edit_profile'])) {

    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);

    if ($_FILES['file_foto']['error'] === 4) {
        $foto = $foto_lama;
    } else {
        $foto = upload_foto();
    }

    $query = "UPDATE user SET nama_lengkap='$nama_lengkap', email='$email', alamat='$alamat', lokasi_file='$foto' WHERE user_id = $id_user";
    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
    if ($_POST > 0) {
        echo " <script>
        alert('berhasil edit profile');
        </script>
        ";
    } else {
        echo " <script>
       ('gagal'); 
        </script>
        ";
    }
}
if (isset($_POST['submit_album'])) {
    $nama = htmlspecialchars($_POST['nama_album']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $tgl = htmlspecialchars($_POST['tgl']);

    $query = "INSERT INTO album VALUES ('', '$nama', '$deskripsi', '$tgl', '$id_user', '$tgl')";
    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
    if ($_POST > 0) {
        echo " <script>
        alert('berhasil menambahkan album');
        </script>
        ";
    } else {
        echo " <script>
        alert('gagal'); 
        </script>
        ";
    }
}
