-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2024 at 08:46 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labrak`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `pelaporan`
--

CREATE TABLE `pelaporan` (
  `nomor_register` varchar(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nik` varchar(50) NOT NULL,
  `nama_pelapor` varchar(50) NOT NULL,
  `alamat_pelapor` varchar(100) NOT NULL,
  `pekerjaan_pelapor` varchar(50) NOT NULL,
  `hub_peldankor` varchar(50) NOT NULL,
  `nomor_pelapor` varchar(15) NOT NULL,
  `nama_korban` varchar(50) NOT NULL,
  `jk_korban` varchar(50) NOT NULL,
  `alamat_korban` varchar(100) NOT NULL,
  `pekerjaan_korban` varchar(50) NOT NULL,
  `nomor_korban` varchar(15) NOT NULL,
  `jenis_kasus` varchar(50) NOT NULL,
  `kronologi` text NOT NULL,
  `tindak_lanjut` text NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Menunggu Konfirmasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelaporan`
--

INSERT INTO `pelaporan` (`nomor_register`, `tanggal`, `nik`, `nama_pelapor`, `alamat_pelapor`, `pekerjaan_pelapor`, `hub_peldankor`, `nomor_pelapor`, `nama_korban`, `jk_korban`, `alamat_korban`, `pekerjaan_korban`, `nomor_korban`, `jenis_kasus`, `kronologi`, `tindak_lanjut`, `status`) VALUES
('29072024001', '2024-07-29 02:20:58', '7105328983', 'Gaby Paparang', 'SMA 7 Lingkungan 5', 'THL', 'Ibu dan Anak', '088765432', 'Olivia', 'Perempuan', 'SMA 7 Lingkungan 5', 'Sekolah', '08773841', 'KDRT', 'Olivia pulang sekolah di pukuli dengan dodutu rica di bagian kepala belakang membuat olivia sekarang menjadi bogo-bogo.', 'Diharapkan supaya ayah korban menceraikan saya dan saya bisa menikah lagi.', 'Selesai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelaporan`
--
ALTER TABLE `pelaporan`
  ADD PRIMARY KEY (`nomor_register`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
