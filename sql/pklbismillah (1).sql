-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2021 at 11:53 PM
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
  `status_lapor` enum('diperiksa','disetujui','ditolak') DEFAULT NULL,
  `nama_lapor` varchar(50) NOT NULL,
  `kecamatan` enum('Lowokwaru','Klojen','Blimbing','KedungKandang','Sukun') NOT NULL,
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

INSERT INTO `lapor` (`id_lapor`, `id_kategori`, `id_user`, `status_lapor`, `nama_lapor`, `kecamatan`, `alamat`, `tgl_tragedi`, `judul`, `keterangan`, `foto_tragedi`, `created_at`) VALUES
(1, 7, 1, 'diperiksa', 'HWANG INYEOP', 'Lowokwaru', 'SEOUL,KOREA SELATAN', '2021-01-13 13:13:43', 'JANGAN LUPA NONTON TRUE BEAUTY', 'YOWW NONTON', 'default.jpg', '2021-01-13 14:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `gender`, `telp`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Niken', 'female', '081902609277', 'bakesbang1505@gmail.com', 'default.jpg', '$2y$10$R6S2cRw.zXawO4cje3wB0O3lf8DA2nBYtBsGsfv8ewc4LmP/BH3TK', 1, 1, 1612362638),
(2, 'Ulvia', 'female', '0876543678', 'ulvia@yahoo.com', 'default.jpg', '$2y$10$5CQWALqS0kpbF7oKhJsc.OHrDEj0gfjau3B9Hn.bcjS/6o0aFbvDG', 2, 1, 1612347120),
(3, 'lucyana', 'female', '081330951350', 'lucytiana1504@yahoo.com', 'default.JPG', '$2y$10$wGums5UdnsbEAGiklr6ig.pPzkn.QkFGo3ssD6UUDwbWYWXuFVuCu', 2, 1, 1611485034),
(12, 'analucy', 'female', '0876444478', 'lu1@gmail.com', 'default.jpg', '$2y$10$pBhUIefBHrgs9Fnkdqve5e3.oYQlC5N4xVBoHd9uv9oa2MLdTomDK', 2, 1, 1612371422);

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
(2, 1, 2),
(3, 2, 2),
(10, 1, 3),
(12, 1, 4),
(13, 2, 4);

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
(2, 'User'),
(3, 'Menu'),
(4, 'C_Data');

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
(2, 'user');

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
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Setting Menu', 'menu', 'fas fa-fw fa-caret-square-down', 1),
(10, 3, 'SubMenu', 'menu/submenu', 'fas fa-fw fa-bars', 1),
(12, 1, 'Role_menu', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(13, 4, 'Data Kondisi Wilayah', 'C_Data', 'fas fa-fw fa-file', 1);

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
  MODIFY `id_lapor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lapor`
--
ALTER TABLE `lapor`
  ADD CONSTRAINT `lapor_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `lapor_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
