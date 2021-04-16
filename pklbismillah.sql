-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2021 at 06:52 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pklbismillah`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `status`) VALUES
(1, 'ideologi', NULL),
(2, 'politik', NULL),
(3, 'ekonomi', NULL),
(4, 'sosial', NULL),
(5, 'budaya', NULL),
(6, 'pertahanan', NULL),
(7, 'keamanan', NULL),
(8, 'covid 19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lapor`
--

CREATE TABLE `lapor` (
  `id_lapor` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_user` int(50) DEFAULT NULL,
  `nama_lapor` varchar(50) NOT NULL,
  `kecamatan` enum('Lowokwaru','Klojen','Blimbing','KedungKandang','Sukun') NOT NULL,
  `status_lapor` enum('diperiksa','disetujui','ditolak') NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tgl_tragedi` datetime NOT NULL DEFAULT current_timestamp(),
  `judul` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `foto_tragedi` varchar(75) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lapor`
--

INSERT INTO `lapor` (`id_lapor`, `id_kategori`, `id_user`, `nama_lapor`, `kecamatan`, `status_lapor`, `alamat`, `tgl_tragedi`, `judul`, `keterangan`, `foto_tragedi`, `created_at`) VALUES
(16, 1, 30, 'semoga berhasil', 'Lowokwaru', 'ditolak', 'dfghhgf', '2021-03-08 00:00:00', 'kfffef', 'yoi', 'AAIQ8137.JPG,DUFS3058.JPG,DQKY7882.JPG', '2021-03-08 16:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `role_id` int(11) NOT NULL,
  `foto` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `no_telp`, `password`, `nama_lengkap`, `jenis_kelamin`, `is_active`, `role_id`, `foto`, `date_created`) VALUES
(1, 'Bakesbang Kota Malang', 'bakesbangmalang@gmail.com', '081902609277', '$2y$10$IVH.n8RYeWmm3dbU5fiJBOxA5QI7dqzfaPq0J1Pu2Nbeno8/641RS', 'WEB SERVER ADMIN Pusat', 'P', 1, 3, 'bakesbangpol2.png', 1613632092),
(2, 'Anisa', 'lucytiana1504@gmail.com', '234567890', '$2y$10$k5mLHC78WtpsRtBYR5fomuMhVZbA57cQZC2.lTN/CMUCXjmdV8AaK', 'AnisaDamayanti', 'P', 1, 2, 'NBTH4962.JPEG', 1613630952),
(33, 'lusi', 'lucytiana1401@gmail.com', '081330951350', '$2y$10$9IsytD80xn3qlaxvqgKaLuPQCHZvFdpBllbqvgvg2csx7vQ0k2/LO', 'Admin Bakesbang', 'P', 1, 1, 'default.jpg', 1615792642);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(14, 1, 9),
(15, 1, 11),
(16, 1, 12),
(20, 2, 14),
(26, 2, 15),
(28, 3, 2),
(30, 3, 14),
(31, 1, 3),
(34, 3, 16),
(37, 3, 17),
(38, 1, 13),
(41, 1, 5),
(42, 2, 3),
(43, 2, 7),
(44, 2, 6),
(45, 3, 3),
(47, 3, 6),
(48, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Dashboard_Admin'),
(3, 'Profile'),
(4, 'Setting'),
(5, 'C_data'),
(6, 'C_report'),
(7, 'Data'),
(8, 'Data_admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Server Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 3, 'My Profile', 'profile', 'fas fa-fw fa-user', 1),
(3, 3, 'Edit Profile', 'profile/edit', 'fas fa-fw fa-user-edit', 1),
(4, 4, 'Setting Menu', 'setting', 'fas fa-fw fa-caret-square-down', 1),
(10, 4, 'SubMenu', 'setting/submenu', 'fas fa-fw fa-bars', 1),
(12, 1, 'Setting', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(17, 5, 'Laporan', 'C_data/index', 'fas fa-fw fa-file', 1),
(18, 6, 'Tambah Data', 'C_report/index', 'fas fa-fw fa-file', 1),
(19, 5, 'Data User', 'C_data/indexuser', 'fas fa-fw fa-user', 1),
(20, 3, 'Change Password', 'profile/changepassword', 'fas fa-fw fa-key', 1),
(21, 7, 'Data Laporan', 'Data/index', 'fas fa-fw fa-file', 1),
(22, 7, 'Info User', 'Data/indexuser', 'fas fa-fw fa-user', 1),
(23, 8, 'DataKPRM', 'Data_admin/index', 'fas fa-fw fa-file', 1),
(24, 8, 'DataAnggotaKprm', 'Data_admin/indexuser', 'fas fa-fw fa-user', 1),
(25, 2, 'Dashboard Admin', 'Dashboard_Admin/index', 'fas fa-fw fa-key', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `lapor`
--
ALTER TABLE `lapor`
  ADD PRIMARY KEY (`id_lapor`),
  ADD KEY `FK_lapor_kategori` (`id_kategori`),
  ADD KEY `FK_lapor_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lapor`
--
ALTER TABLE `lapor`
  MODIFY `id_lapor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
