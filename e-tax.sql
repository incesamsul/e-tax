-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2023 at 02:17 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-tax`
--

-- --------------------------------------------------------

--
-- Table structure for table `lampiran`
--

CREATE TABLE `lampiran` (
  `id` int NOT NULL,
  `id_notifikasi` int NOT NULL,
  `file` varchar(100) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int NOT NULL,
  `id_pajak` int NOT NULL,
  `deadline` date NOT NULL,
  `id_user` int NOT NULL,
  `verifikasi` enum('0','1','2') NOT NULL,
  `alasan` varchar(300) DEFAULT NULL,
  `email_sended` enum('0','1') NOT NULL
) ;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `id_pajak`, `deadline`, `id_user`, `verifikasi`, `alasan`, `email_sended`) VALUES
(16, 7, '2023-05-15', 76, '0', NULL, '1'),
(17, 7, '2023-05-15', 77, '0', NULL, '1'),
(18, 3, '2023-05-15', 76, '0', NULL, '1'),
(19, 2, '2023-05-15', 77, '0', NULL, '1'),
(20, 1, '2023-05-15', 76, '0', NULL, '1'),
(21, 2, '2023-05-15', 77, '0', NULL, '1'),
(22, 1, '2023-05-15', 76, '0', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `pajak`
--

CREATE TABLE `pajak` (
  `id` int NOT NULL,
  `nama_pajak` varchar(100) NOT NULL,
  `lampiran` varchar(100) NOT NULL,
  `sample` varchar(255) NOT NULL
) ;

--
-- Dumping data for table `pajak`
--

INSERT INTO `pajak` (`id`, `nama_pajak`, `lampiran`, `sample`) VALUES
(1, 'SPT', 'Daftar nominatif biaya promosi', 'public/storage/contoh_lampiran/SPT.xlsx'),
(2, 'PPh 23', 'rekapan pajak', 'public/storage/contoh_lampiran/PPh 23.xlsx'),
(3, 'PPh 4 ayat 2', 'rekapan pajak', 'public/storage/contoh_lampiran/PPh 4 ayat 2.xlsx'),
(4, 'PPN', 'daftar save deposit box', 'public/storage/contoh_lampiran/PPN.xlsx'),
(7, 'test', 'test', 'public/storage/contoh_lampiran/test.xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(120) NOT NULL,
  `nrik` varchar(100) NOT NULL,
  `role` varchar(120) NOT NULL,
  `no_hp` varchar(120) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `date_created` int NOT NULL,
  `soft_delete` int NOT NULL
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `nrik`, `role`, `no_hp`, `email`, `password`, `foto`, `date_created`, `soft_delete`) VALUES
(71, 'tami', 'perpajakan', 'akuntansi', '089764525327', 'tami@mail.com', '$2y$10$g.rHIFEZI/XDRg/hnQpic.g99JAc24l3SILw3FMNuUjt6XbnMO0Pq', '', 1682488555, 0),
(73, 'admin', 'admin', 'admin', '087653253253', 'admin@mail.com', '$2y$10$rFELZX./app3xE4p6Zd1HeXb9qGsgYHjnzxpgbOxuPJAE5LhtcXWC', '', 1682521763, 0),
(76, 'cabang jepang', 'cabang', 'cabang', '0327328', 'ince.samsul89@gmail.com', '$2y$10$PoS/FVRF/Xc0Lq0UVWlTguX./GTkV9FtCUo00W2XiSsne6tjpMbJq', '', 1682577280, 0),
(77, 'KCP SUDIRMAN', 'cabangs', 'cabang', '0895324670360', 'ince.eduwork@gmail.com', '$2y$10$z/IF3Fo9HxgOX.LJmUWrUeqFahzHRAtJMc.jS/tWQ5o899V3Zd7My', '', 1682695642, 0),
(79, 'sam', '100', 'akuntansi', '012192', 'sam@mail.com', '$2y$10$wfwCHH7UB7f3RQBi.nnAuOVB312tvmfDo9F2XcXrLBRb/6gPcf/0C', '', 1684144028, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_id_notifikasi` (`id_notifikasi`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_id_pajak` (`id_pajak`);

--
-- Indexes for table `pajak`
--
ALTER TABLE `pajak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pajak`
--
ALTER TABLE `pajak`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD CONSTRAINT `foreign_id_notifikasi` FOREIGN KEY (`id_notifikasi`) REFERENCES `notifikasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `foreign_id_pajak` FOREIGN KEY (`id_pajak`) REFERENCES `pajak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
