-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2018 at 03:22 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masjid`
--

-- --------------------------------------------------------

--
-- Table structure for table `masjid_scroll`
--

CREATE TABLE `masjid_scroll` (
  `scroll_id` int(10) NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `paparkan` enum('0','1') COLLATE utf8_bin NOT NULL,
  `giliran` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `masjid_scroll`
--

INSERT INTO `masjid_scroll` (`scroll_id`, `text`, `paparkan`, `giliran`) VALUES
(2, 'Sistem Paparan Digital untuk Masjid', '1', 0),
(4, 'Tambahan 1 2 3', '1', 1),
(5, 'Percubaan', '1', 2),
(6, ' satu dua tiga', '0', 3);

-- --------------------------------------------------------

--
-- Table structure for table `masjid_slider`
--

CREATE TABLE `masjid_slider` (
  `slider_id` int(10) NOT NULL,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `paparkan` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '0',
  `giliran` int(11) NOT NULL DEFAULT '0',
  `jenis` enum('gambar','video','template','event') COLLATE utf8_bin NOT NULL DEFAULT 'gambar',
  `slide_duration` int(11) NOT NULL DEFAULT '0',
  `kandungan` text COLLATE utf8_bin,
  `tajuk` varchar(255) COLLATE utf8_bin NOT NULL,
  `mula` date NOT NULL,
  `tamat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `masjid_slider`
--

--------------------------------------------------------

--
-- Table structure for table `masjid_umum`
--

CREATE TABLE `masjid_umum` (
  `umum_id` int(10) NOT NULL,
  `nama_tempat` varchar(100) COLLATE utf8_bin NOT NULL,
  `alamat` varchar(255) COLLATE utf8_bin NOT NULL,
  `saiz` int(11) NOT NULL,
  `slide_utama` varchar(255) COLLATE utf8_bin NOT NULL,
  `jeda_slide` varchar(10) COLLATE utf8_bin NOT NULL,
  `effect` varchar(100) COLLATE utf8_bin NOT NULL,
  `hijrah_adjustment` varchar(10) COLLATE utf8_bin NOT NULL,
  `iqamah_subuh` int(11) NOT NULL,
  `iqamah_zohor` int(11) NOT NULL,
  `iqamah_asar` int(11) NOT NULL,
  `iqamah_maghrib` int(11) NOT NULL,
  `iqamah_isyak` int(11) NOT NULL,
  `solat_subuh` int(11) NOT NULL,
  `solat_zohor` int(11) NOT NULL,
  `solat_asar` int(11) NOT NULL,
  `solat_maghrib` int(11) NOT NULL,
  `solat_isyak` int(11) NOT NULL,
  `lokasiID` varchar(10) COLLATE utf8_bin NOT NULL,
  `negeri` varchar(100) COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jumaat_azan` int(10) NOT NULL,
  `jumaat_khutbah` int(11) NOT NULL,
  `jumaat_solat` int(11) NOT NULL,
  `template` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `masjid_umum`
--

INSERT INTO `masjid_umum` (`umum_id`, `nama_tempat`, `alamat`, `saiz`, `slide_utama`, `jeda_slide`, `effect`, `hijrah_adjustment`, `iqamah_subuh`, `iqamah_zohor`, `iqamah_asar`, `iqamah_maghrib`, `iqamah_isyak`, `solat_subuh`, `solat_zohor`, `solat_asar`, `solat_maghrib`, `solat_isyak`, `lokasiID`, `negeri`, `last_update`, `jumaat_azan`, `jumaat_khutbah`, `jumaat_solat`, `template`) VALUES
(1, 'Masjid Muhammad Al-Fateh', 'Taman Mutiara, Sungai Kob, Kulim, Kedah', 17, 'default.jpg', '3', 'random', '-1', 15, 10, 10, 10, 10, 15, 15, 15, 15, 15, 'BRN01', 'Brunei', '2018-05-02 01:26:06', 10, 30, 15, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `masjid_scroll`
--
ALTER TABLE `masjid_scroll`
  ADD PRIMARY KEY (`scroll_id`);

--
-- Indexes for table `masjid_slider`
--
ALTER TABLE `masjid_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `masjid_umum`
--
ALTER TABLE `masjid_umum`
  ADD PRIMARY KEY (`umum_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `masjid_scroll`
--
ALTER TABLE `masjid_scroll`
  MODIFY `scroll_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `masjid_slider`
--
ALTER TABLE `masjid_slider`
  MODIFY `slider_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `masjid_umum`
--
ALTER TABLE `masjid_umum`
  MODIFY `umum_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
