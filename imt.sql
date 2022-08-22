-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 08:03 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imt`
--

-- --------------------------------------------------------

--
-- Table structure for table `data-imt`
--

CREATE TABLE `data-imt` (
  `id` int(11) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `tinggi_badan` varchar(222) DEFAULT NULL,
  `berat_badan` varchar(222) DEFAULT NULL,
  `usia` varchar(222) DEFAULT NULL,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data-imt`
--

INSERT INTO `data-imt` (`id`, `id_member`, `tinggi_badan`, `berat_badan`, `usia`, `created`) VALUES
(4, 2, '170', '60', '12', '2022-08-01'),
(5, 4, '12', '12', '12', '2022-08-01'),
(6, 6, '267', '60', '35', '2022-08-01'),
(7, 6, '125', '25', '20', '2022-08-03'),
(10, 10, '125', '25', '20', '2022-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `id` int(11) NOT NULL,
  `instansi` varchar(222) NOT NULL,
  `alamat` varchar(222) NOT NULL,
  `code_instansi` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id`, `instansi`, `alamat`, `code_instansi`) VALUES
(2, 'Puskesmas Mawar Indah Jombang', 'Kec. Tambak Beras Kab. Jombang', 'PS_MI'),
(3, 'Puskesmas Citra Abadi Malang', 'Kec. Ngantang Kab. Malang', 'PS_CA'),
(5, 'Universitas KH. Abdul Wahab Hasbullah Jombang', 'Tambak Beras Jombang', 'UNWAHA'),
(6, 'DINSOS Jombang', 'Kabupaten Jombang', 'D_J'),
(10, 'In sint a quia quid', 'Quo et dolore occaec', 'Quia cillum');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `id_rfid` varchar(255) NOT NULL,
  `nama` varchar(222) DEFAULT NULL,
  `jenis_kelamin` varchar(222) DEFAULT NULL,
  `tgl_lahir` varchar(222) DEFAULT NULL,
  `code_instansi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `id_rfid`, `nama`, `jenis_kelamin`, `tgl_lahir`, `code_instansi`) VALUES
(2, '32423414', 'Dandi Kurniawan', 'Laki-laki', '1999-10-26', 2),
(4, '234123', 'Aji Restu Maharani', 'Laki-laki', '1998-02-26', 3),
(6, '324823743', 'Izar Gian', 'Laki-laki', '2022-08-03', 1),
(9, '3445353', 'Alfian', 'Laki-laki', '2000-02-07', 2),
(18, '65', 'Nama', 'Laki-laki', '2022-06-08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengukuran`
--

CREATE TABLE `pengukuran` (
  `id` int(11) NOT NULL,
  `uid_biodata` int(222) NOT NULL,
  `tinggi_badan` double NOT NULL,
  `berat_badan` double NOT NULL,
  `tgljam_ukur` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengukuran`
--

INSERT INTO `pengukuran` (`id`, `uid_biodata`, `tinggi_badan`, `berat_badan`, `tgljam_ukur`) VALUES
(7, 1324567, 435, 45, '2022-08-03 16:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `pengukuran_berat_badan`
--

CREATE TABLE `pengukuran_berat_badan` (
  `id` int(11) NOT NULL,
  `value` varchar(225) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengukuran_berat_badan`
--

INSERT INTO `pengukuran_berat_badan` (`id`, `value`, `date`) VALUES
(1, '324', '2022-07-31 05:56:18'),
(2, '350', '2022-07-31 05:57:41'),
(3, '312', '2022-07-31 06:45:14'),
(4, '20', '2022-07-31 06:53:57'),
(5, '25', '2022-07-31 06:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `pengukuran_tinggi_badan`
--

CREATE TABLE `pengukuran_tinggi_badan` (
  `id` int(11) NOT NULL,
  `value` varchar(225) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengukuran_tinggi_badan`
--

INSERT INTO `pengukuran_tinggi_badan` (`id`, `value`, `date`) VALUES
(1, '125', '2022-07-31 06:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `rfid`
--

CREATE TABLE `rfid` (
  `id` int(11) NOT NULL,
  `value` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rfid`
--

INSERT INTO `rfid` (`id`, `value`) VALUES
(17, '21-12-4b'),
(19, '26-5e-21-12-4b'),
(20, '26-5e-21-12-4b'),
(21, '26-5e-21-12-4b');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(222) NOT NULL,
  `jenis` varchar(222) DEFAULT NULL,
  `email` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `alamat` varchar(222) DEFAULT NULL,
  `code_instansi` varchar(222) DEFAULT NULL,
  `photo` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `jenis`, `email`, `password`, `alamat`, `code_instansi`, `photo`) VALUES
(1, 'Dandi Kurniawan', 'Teknisi', 'dandi@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Universitas', '2', NULL),
(2, 'Fuja Harmoko', 'Petugas', 'saiful@gmail.com', '', 'RSUD Kertosono', '2', '171149273_465361941408017_3098362658758715739_n.jpg'),
(3, 'Fajar Shadeq', 'Petugas', 'fajar@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Puskesmas Mawar Indah', '3', NULL),
(4, 'Haris Ubaidillah', 'Pemerintah', 'haris@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'DINSOS Kab. Jombang', '3', NULL),
(5, 'Aji Restu Maharani', 'Admin', 'aji@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Universitas UNP Kediri', '2', NULL),
(7, 'Aji Restu Maharani', 'Petugas', 'restu@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Puskesmas Citra Abadi', '3', NULL),
(9, 'Izar Gian', 'Teknisi', 'izargian@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'DINSOS Jombang', '3', NULL),
(19, 'Commodo rerum commod', 'Pemerintah', 'dibivihe@mailinator.com', '', 'Quos eos dolore ver', '2', NULL),
(20, 'Nulla magna velit la', 'Teknisi', 'xubenobewu@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'Facere aut assumenda', '2', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data-imt`
--
ALTER TABLE `data-imt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code_instansi`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengukuran`
--
ALTER TABLE `pengukuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengukuran_berat_badan`
--
ALTER TABLE `pengukuran_berat_badan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengukuran_tinggi_badan`
--
ALTER TABLE `pengukuran_tinggi_badan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data-imt`
--
ALTER TABLE `data-imt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pengukuran`
--
ALTER TABLE `pengukuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengukuran_berat_badan`
--
ALTER TABLE `pengukuran_berat_badan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengukuran_tinggi_badan`
--
ALTER TABLE `pengukuran_tinggi_badan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
