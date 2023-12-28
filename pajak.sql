-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 28, 2023 at 03:27 PM
-- Server version: 8.0.30
-- PHP Version: 8.0.0

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
-- Table structure for table `pajak`
--

CREATE TABLE `pajak` (
  `id` int NOT NULL,
  `nama_pajak` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lampiran` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sample` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pajak`
--

INSERT INTO `pajak` (`id`, `nama_pajak`, `full_name`, `lampiran`, `sample`) VALUES
(1, 'SPT', 'SPT', 'Daftar nominatif biaya promosi', 'public/storage/contoh_lampiran/SPT.xlsx'),
(2, 'PPh23', 'PPH 23', 'rekapan pajak', 'public/storage/contoh_lampiran/PPh 23.xlsx'),
(3, 'PPh4ayat2', 'PPH 4 AYAT 2', 'rekapan pajak', 'public/storage/contoh_lampiran/PPh 4 ayat 2.xlsx'),
(4, 'PPN', 'PPN', 'daftar save deposit box', 'public/storage/contoh_lampiran/PPN.xlsx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pajak`
--
ALTER TABLE `pajak`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pajak`
--
ALTER TABLE `pajak`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
