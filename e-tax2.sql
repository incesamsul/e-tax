-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Waktu pembuatan: 10 Jul 2023 pada 05.37
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-tax2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lampiran`
--

CREATE TABLE `lampiran` (
  `id` int(11) NOT NULL,
  `id_notifikasi` int(11) NOT NULL,
  `file` varchar(100) NOT NULL
) ;

--
-- Dumping data untuk tabel `lampiran`
--

INSERT INTO `lampiran` (`id`, `id_notifikasi`, `file`) VALUES
(17, 34, 'public/storage/lampiran/1688435170Neraca 19 Juni 2023.xlsx'),
(18, 35, 'public/storage/lampiran/1688435717Neraca 19 Juni 2023.xlsx'),
(19, 36, 'public/storage/lampiran/1688436201Neraca 19 Juni 2023.xlsx'),
(20, 37, 'public/storage/lampiran/1688553510Neraca 19 Juni 2023.xlsx'),
(21, 38, 'public/storage/lampiran/1688554234Neraca 19 Juni 2023.xlsx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `id_pajak` int(11) NOT NULL,
  `deadline` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `verifikasi` enum('0','1','2') NOT NULL,
  `alasan` varchar(300) DEFAULT NULL,
  `email_sended` enum('0','1') NOT NULL
) ;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `id_pajak`, `deadline`, `id_user`, `verifikasi`, `alasan`, `email_sended`) VALUES
(25, 1, '2023-05-25', 86, '0', NULL, '0'),
(26, 1, '2023-05-25', 87, '0', NULL, '0'),
(34, 1, '2023-04-25', 82, '0', NULL, '0'),
(35, 2, '2023-07-15', 82, '2', 'kurang a', '1'),
(36, 2, '2023-07-15', 82, '2', 'ada data krg lengkap', '1'),
(37, 2, '2023-05-25', 82, '0', NULL, '0'),
(38, 2, '2023-07-15', 82, '2', 'ada data krg lengkap', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pajak`
--

CREATE TABLE `pajak` (
  `id` int(11) NOT NULL,
  `nama_pajak` varchar(100) NOT NULL,
  `lampiran` varchar(100) NOT NULL,
  `sample` varchar(255) NOT NULL
) ;

--
-- Dumping data untuk tabel `pajak`
--

INSERT INTO `pajak` (`id`, `nama_pajak`, `lampiran`, `sample`) VALUES
(1, 'SPT', 'Daftar nominatif biaya promosi', 'public/storage/contoh_lampiran/SPT.xlsx'),
(2, 'PPh 23', 'rekapan pajak', 'public/storage/contoh_lampiran/PPh 23.xlsx'),
(3, 'PPh 4 ayat 2', 'rekapan pajak', 'public/storage/contoh_lampiran/PPh 4 ayat 2.xlsx'),
(4, 'PPN', 'daftar save deposit box', 'public/storage/contoh_lampiran/PPN.xlsx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL
) ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `nrik` varchar(100) NOT NULL,
  `role` varchar(120) NOT NULL,
  `no_hp` varchar(120) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `date_created` int(11) NOT NULL,
  `soft_delete` int(11) NOT NULL
) ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `nrik`, `role`, `no_hp`, `email`, `password`, `foto`, `date_created`, `soft_delete`) VALUES
(80, 'admin', '001', 'admin', '0895603491084', 'admin@mail.com', '$2y$10$bzL/BMMH7mjYZD8Q52mt3OHOpE7RfuZO4CKjx/MvLGD3CsOR1vxOW', '', 1684250166, 0),
(81, 'grub 1', '002', 'group', '02819281', 'grub1@mail.com', '$2y$10$JS4f/lGJD73scgMa4u9ZKe4vfyIdo/L13yDDnkSzKADPwkRCTtfb2', '', 1684250396, 0),
(82, 'Cabang Otista', '003', 'cabang', '089513251210', 'syintyaf11@gmail.com', '$2y$10$tm7NSwDi2/XGlkThP9n1BuoTD59siUmnOmf/dh.SebkuNGmaIs2Xm', '', 1684250526, 0),
(83, 'Grup Akuntansi & Keuangan', '004', 'akuntansi', '02389238', 'akutan@ms.co', '$2y$10$o/Y6Jcx.s7UcxoGkBSgIJ.1l4bZr6qqjRfefxe/3MbcoIY6mF9Efa', '', 1684250588, 0),
(84, 'Grup Akuntansi', '0001', 'akuntansi', '089513251210', 'hijaborisha345@gmail.com', '$2y$10$q1rArQ0UPeNd0PG7tHsRe.kGIEqYWyglcm6eWwnOlGq9vf.XbVHG6', '', 1684690759, 0),
(85, 'KC Suryopranoto', '0002', 'cabang', '089513251210', 'syintyaf11@gmail.com', '$2y$10$tOdNB1PBjJETeW8O7bcCsuquV93HIicbLltlmRUOMcfYSY2TLhL6C', '', 1684690820, 0),
(86, 'KC Juanda', '0003', 'cabang', '081225360293', 'sunnidyna@gmail.com', '$2y$10$fsWc7G6HA4Ge.cHtOrDJK.p3rBjrsENLEZ6jrNrhqSQa5w3Y35rWm', '', 1684690884, 0),
(87, 'KC Matraman', '0004', 'cabang', '0899877', 'aaaa@gmail.com', '$2y$10$0PY.F6rQB1sbksA8dKqya.Uw1P2m8Y1KldASJsCBiqlfHCRTLpLty', '', 1684690921, 0),
(88, 'Grup Syariah', '0005', 'group', '09987654', 'grupsyariah@gmail.com', '$2y$10$ydVZaSO2W4vuHbzISSlWyu8InyS0iyLC2W/pn9.2xkZjbeZqjt0oa', '', 1684690984, 0),
(89, 'Grup Pengadaan & Pengelolaan Aset', '0006', 'group', '087654', 'gruppengadaan@gmail.com', '$2y$10$Tt0sAUyFiFJqggccQI0tWuMyN6AzGTR0Zvus0ssCL0KyHwdwqsgEC', '', 1684691054, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_id_notifikasi` (`id_notifikasi`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_id_pajak` (`id_pajak`);

--
-- Indeks untuk tabel `pajak`
--
ALTER TABLE `pajak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `pajak`
--
ALTER TABLE `pajak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD CONSTRAINT `foreign_id_notifikasi` FOREIGN KEY (`id_notifikasi`) REFERENCES `notifikasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `foreign_id_pajak` FOREIGN KEY (`id_pajak`) REFERENCES `pajak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
