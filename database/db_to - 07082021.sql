-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2021 at 05:19 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_to`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modul_program`
--

CREATE TABLE if not exists `tbl_modul_program` (
  `id_program` int(11) NOT NULL,
  `peserta_program` text NOT NULL COMMENT 'serialize nis',
  `pelajaran_program` int(12) NOT NULL COMMENT 'id_pelajaran',
  `waktu_pengerjaan` int(12) NOT NULL,
  `jns_program` varchar(255) NOT NULL,
  `aktif` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 = tidak aktif\r\n1 = aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_modul_program`
--

INSERT INTO `tbl_modul_program` (`id_program`, `peserta_program`, `pelajaran_program`, `waktu_pengerjaan`, `jns_program`, `aktif`) VALUES
(1, 'a:5:{i:0;s:7:\"2019638\";i:1;s:7:\"2019637\";i:2;s:7:\"2019565\";i:3;s:7:\"2019644\";i:4;s:7:\"2019639\";}', 52, 120, 'online', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soal_program`
--

CREATE TABLE if not exists `tbl_soal_program` (
  `soal_id` bigint(20) NOT NULL,
  `soal_program_id` bigint(20) NOT NULL,
  `soal_detail` text DEFAULT NULL COMMENT '1=pilgan,2=truefalse,3=esay,4=jawabansingkat, 5=mencocokan jawaban',
  `soal_tipe` smallint(4) NOT NULL,
  `soal_pg` text DEFAULT NULL COMMENT 'untuk pilgan ',
  `soal_kunci` text DEFAULT NULL COMMENT 'jawaban untuk true false,pilgan, dan mencocokan jawaban ',
  `soal_lampiran` text DEFAULT NULL COMMENT 'gambar, audio,video '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_soal_program`
--

INSERT INTO `tbl_soal_program` (`soal_id`, `soal_program_id`, `soal_detail`, `soal_tipe`, `soal_pg`, `soal_kunci`, `soal_lampiran`) VALUES
(1, 1, 'sadassad', 2, NULL, 'true', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_modul_program`
--
ALTER TABLE `tbl_modul_program`
  ADD PRIMARY KEY (`id_program`);

--
-- Indexes for table `tbl_soal_program`
--
ALTER TABLE `tbl_soal_program`
  ADD PRIMARY KEY (`soal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_modul_program`
--
ALTER TABLE `tbl_modul_program`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_soal_program`
--
ALTER TABLE `tbl_soal_program`
  MODIFY `soal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
