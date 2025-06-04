-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2025 at 08:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '$2y$10$LJi1x2LMFiYHqycnuYacpuPSlbuwAVhqRdCOc9M0qgu.buuEpTlS.', 'faisall'),
(23, 'faisa1', '$2y$10$a4GF1J.KP2RzLkPM8zA4Ceeykn/neyf7Laai3X7L1yjuONOF80jpG', 'safiall');

-- --------------------------------------------------------

--
-- Table structure for table `calon`
--

CREATE TABLE `calon` (
  `id_calon` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `visi` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calon`
--

INSERT INTO `calon` (`id_calon`, `nama`, `visi`, `kelas`, `foto`) VALUES
(1, 'Muhamad Faisal', 'Mewujudkan OSIS yang aktif, kreatif, dan berintegritas dalam membangun lingkungan\nsekolah yang inspiratif dan berprestasi.', 'X-3', 'faisal.jpg'),
(2, 'Faiz Nabil Akram', 'Menjadikan OSIS sebagai wadah aspirasi siswa yang berdaya guna dan membentuk\nkarakter pelajar yang unggul serta berwawasan luas.', 'X-3', 'faiz.jpg'),
(3, 'Glenn Marcel', 'Membentuk generasi muda SMK yang cerdas, berakhlak mulia, dan peduli terhadaplingkungan serta masyarakat.', 'X-2', 'glen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id_voting` int(11) NOT NULL,
  `id_calon` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nisn` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`id_voting`, `id_calon`, `waktu`, `nisn`) VALUES
(1, 1, '2025-06-04 04:54:21', 67326),
(2, 1, '2025-06-04 04:54:27', 40978),
(3, 2, '2025-06-04 04:54:57', 73062),
(4, 1, '2025-06-04 04:55:05', 26402),
(5, 1, '2025-06-04 04:55:13', 35067),
(6, 3, '2025-06-04 04:55:24', 39622),
(7, 1, '2025-06-04 04:55:42', 26970),
(8, 3, '2025-06-04 04:55:50', 10481),
(9, 1, '2025-06-04 04:56:06', 35720),
(10, 2, '2025-06-04 04:56:14', 49821),
(11, 2, '2025-06-04 04:56:23', 52611),
(12, 1, '2025-06-04 04:56:40', 36292),
(13, 1, '2025-06-04 04:56:31', 39621),
(14, 1, '2025-06-04 06:05:48', 11111),
(15, 1, '2025-06-04 06:16:40', 12345);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`id_calon`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id_voting`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `calon`
--
ALTER TABLE `calon`
  MODIFY `id_calon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id_voting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
