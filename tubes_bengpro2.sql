-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 02:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes_bengpro2`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar_reguler`
--

CREATE TABLE `pendaftar_reguler` (
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nama_siswa` text NOT NULL,
  `ttl` text NOT NULL,
  `jk` enum('laki-laki','perempuan') NOT NULL,
  `alamat` mediumtext NOT NULL,
  `telp_siswa` text NOT NULL,
  `agama` enum('islam','protestan','katolik','hindu','buddha','konghucu') NOT NULL,
  `asal_sekolah` varchar(200) NOT NULL,
  `ijazah` text NOT NULL,
  `rapor` text NOT NULL,
  `nama_ortu` text NOT NULL,
  `pekerjaan` varchar(200) NOT NULL,
  `telp_ortu` text NOT NULL,
  `pendidikan` enum('SD','SMP','SMA/SMK','D3','S1/D4','S2','S3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `status` enum('ADMIN','GURU') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `username`, `password`, `status`) VALUES
(1, 'Fabian Rifqi Ilmany', 'bian', 'bian', 'ADMIN'),
(3, 'Nuril Amri Ependi', 'nuril', 'nuril', 'GURU'),
(4, 'Qka Alleicia Dalliana', 'qka', 'qka', 'GURU'),
(5, 'Alya Khalisa Nadira', 'nadira', 'nadira', 'GURU');

-- --------------------------------------------------------

--
-- Table structure for table `user_pendaftar`
--

CREATE TABLE `user_pendaftar` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_pendaftar`
--

INSERT INTO `user_pendaftar` (`id`, `nama_lengkap`, `username`, `password`) VALUES
(13, 'Fabian Rifqi Ilmany', 'bian', '$2y$10$4PPqhIxW4gqhWNLCx9oO8OKvY8RmGEX4HW3oZ9476Uu6ryZAOxFAS'),
(14, 'Alya Khalisa Nadira', 'nadira', '$2y$10$VliezPW2WaPxlCyUlrJyw.R8zXQ3LtSs30NuZxmG0e5/br6poFWq6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftar_reguler`
--
ALTER TABLE `pendaftar_reguler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_pendaftar`
--
ALTER TABLE `user_pendaftar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftar_reguler`
--
ALTER TABLE `pendaftar_reguler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_pendaftar`
--
ALTER TABLE `user_pendaftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftar_reguler`
--
ALTER TABLE `pendaftar_reguler`
  ADD CONSTRAINT `pendaftar_reguler_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
