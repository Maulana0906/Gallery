-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Mar 2024 pada 05.33
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gallery1`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `soal_1` (IN `id_album` INT(11))   SELECT * FROM foto WHERE foto.album_id = id_album$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `soal_2` (IN `nama_album` INT(11))   SELECT * FROM album WHERE album.album_id = nama_album$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `album_id` int(11) NOT NULL,
  `nama_album` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_buat` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `tgl_edit` datetime NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `total_komen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`album_id`, `nama_album`, `deskripsi`, `tanggal_buat`, `user_id`, `tgl_edit`, `kategori`, `total_komen`) VALUES
(3, 'Anime', 'kumpulan anime', '2024-02-01', 1, '2024-02-29 00:00:00', 'anime', 2),
(12, 'random', '   indah banget   ', '2024-02-09', 3, '2024-02-29 00:00:00', '', 2),
(14, 'Indonesia\r\n', 'pemandangan yang bagus dan indah', '2024-02-26', 3, '2024-03-04 10:58:37', '', 1);

--
-- Trigger `album`
--
DELIMITER $$
CREATE TRIGGER `soal_4` BEFORE INSERT ON `album` FOR EACH ROW SET new.tanggal_buat = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL,
  `judul_foto` varchar(255) NOT NULL,
  `deskripsi_foto` text NOT NULL,
  `tanggal_unggah` date NOT NULL,
  `lokasi_file` varchar(255) NOT NULL,
  `album_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`foto_id`, `judul_foto`, `deskripsi_foto`, `tanggal_unggah`, `lokasi_file`, `album_id`, `user_id`) VALUES
(13, 'logo kelompok', 'bagus buangett', '2024-02-09', '65dc978d11e36.png', 12, 3),
(14, 'gojo', 'anime keren', '2024-02-22', 'gojo.webp', 12, 3),
(17, 'gojo', 'ganteng cuy', '2024-02-29', '65e079f08c979.jpg', 3, 1),
(18, 'inumaki', 'cool', '2024-02-29', '65e07a3f041b1.jpg', 3, 1),
(19, 'kmy', 'serius', '2024-02-29', '65e07a526f18d.jpeg', 3, 1),
(20, 'Raja empat', 'laut biru yang indah', '2024-02-29', '65e07b8147977.jpg', 14, 3),
(21, 'Gunung rajawali', 'bagussss', '2024-02-29', '65e07b972547c.jpg', 14, 3),
(22, 'politik', 'banyak 1', '2024-03-04', '65e546c644ea8.png', 14, 3);

--
-- Trigger `foto`
--
DELIMITER $$
CREATE TRIGGER `soal_3` AFTER INSERT ON `foto` FOR EACH ROW UPDATE album
    SET tgl_edit = NOW()
    WHERE album_id = NEW.album_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `soal_3 a` BEFORE UPDATE ON `foto` FOR EACH ROW UPDATE album
    SET tgl_edit = NOW()
    WHERE album_id = NEW.album_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `soal_3 b` BEFORE DELETE ON `foto` FOR EACH ROW UPDATE album
    SET tgl_edit = NOW()
    WHERE album_id = old.album_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar_foto`
--

CREATE TABLE `komentar_foto` (
  `komentar_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` date NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komentar_foto`
--

INSERT INTO `komentar_foto` (`komentar_id`, `foto_id`, `user_id`, `isi_komentar`, `tanggal_komentar`, `album_id`) VALUES
(77, 14, 6, 'halo', '2024-03-04', 12),
(78, 17, 6, 'halo', '2024-03-04', 3),
(79, 17, 6, 'halo', '2024-03-04', 3),
(80, 17, 6, 'halo', '2024-03-04', 3),
(81, 17, 6, 'halo', '2024-03-04', 3),
(82, 17, 6, 'p', '2024-03-04', 3),
(83, 17, 6, 'halo', '2024-03-04', 3),
(84, 17, 6, 'halo', '2024-03-04', 3),
(85, 17, 6, 'p', '2024-03-04', 3),
(86, 17, 6, 'p', '2024-03-04', 3),
(87, 14, 6, 'halo', '2024-03-04', 12),
(88, 22, 3, 'halo', '2024-03-04', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `like_foto`
--

CREATE TABLE `like_foto` (
  `like_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `like_foto`
--

INSERT INTO `like_foto` (`like_id`, `foto_id`, `user_id`, `tanggal_like`) VALUES
(44, 14, 6, '2024-03-04'),
(62, 22, 3, '2024-03-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `lokasi_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `lokasi_file`) VALUES
(1, 'admin', '$2y$10$0S.e6o.fJ5rQ5h8zs4L18eLi4mavvKx4r2f1oA9IHUpSVUB4AlSZ.', 'aldinot56@gmail.com', 'Aldi sidoarjo', 'admin', '65e075403e43a.jpg'),
(2, 'tiyo', '$2y$10$nfmE/Xi671FT7kAOBqJWRem6sEXwdeIzVJ3SADPWcXM1WwnwzkYmi', 'tiyo', 'ytio', 'tiyo', ''),
(3, 'maulana', '$2y$10$zD71j9W7kQr/7CMGZR6oxOSxie4rwEyj7cVJrpdz/bsqwDawwzmLW', 'aldigaming166@gamil.com', 'maulana', 'prambon', ''),
(4, 'owner', '$2y$10$.R0TVcFAFy6.j3VKJWAFSe8DtariONboMN1K7eozPNY.eoFzcBH/q', 'aldigaming166@gamil.com', 'yaya', 'prambon', ''),
(5, 'reza', '$2y$10$7QiLPd0uAjR9gP6WeZOqtuuYzJGttOVBBFvgaCQWWN84wZDNjLA1K', 'aldigaming166@gamil.com', 'Reza', 'Desa Gedangrowo Kec.Prambon Kab.sidoarjo', ''),
(6, 'fahri', '$2y$10$.3AdEGCWK5Nc5RO9VM.CHuv8g8tGMssdWU2ebXrJU/lvZSlc2vyhW', 'cyntiaapriliasari123@gmail.com', 'fahri', 'prambon', '65e52fb502852.jpg'),
(7, 'aldi', '$2y$10$jjtCmntgdjuB41n2px8P5u/a4CyOmVc7Izqy/dM5N07kwtKc7eUEi', 'cyntiaapriliasari123@gmail.com', 'iii', 'prambon', '65e54650ee743.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `album_id` (`album_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `foto_id` (`foto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `like_foto`
--
ALTER TABLE `like_foto`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `foto_id` (`foto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `komentar_foto`
--
ALTER TABLE `komentar_foto`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `like_foto`
--
ALTER TABLE `like_foto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD CONSTRAINT `komentar_foto_ibfk_1` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `komentar_foto_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `like_foto`
--
ALTER TABLE `like_foto`
  ADD CONSTRAINT `like_foto_ibfk_1` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_foto_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
