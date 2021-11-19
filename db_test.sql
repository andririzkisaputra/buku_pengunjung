-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2021 at 08:26 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `anggota_id` int(45) NOT NULL,
  `nomor_anggota` varchar(7) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0 suspend\r\n1 aktif',
  `created_by` int(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`anggota_id`, `nomor_anggota`, `nama`, `gambar`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(151, '78776', 'Andri Rizki Saputra', 'andri-rizki-saputra-78776-2021-11-02.jpeg', '1', 26, '2021-11-02 11:29:34', '2021-11-02 13:21:06'),
(203, '24329', 'Andri Rizki E S', 'andri-rizki-e-s.jpg', '1', 26, '2021-11-16 11:11:56', '2021-11-16 11:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `email_sent`
--

CREATE TABLE `email_sent` (
  `email_sent_id` int(45) NOT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `pre_title` varchar(255) DEFAULT NULL,
  `msg_title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `button` varchar(255) DEFAULT NULL,
  `attach` varchar(255) DEFAULT NULL,
  `is_sent` enum('0','1') DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_on` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `kehadiran_id` int(45) NOT NULL,
  `anggota_id` int(45) DEFAULT NULL,
  `created_by` int(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(45) NOT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `client_secret` varchar(40) DEFAULT NULL,
  `expires_in` varchar(255) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0. Hapus\r\n1. Aktif',
  `auth_key` varchar(45) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `token_type` varchar(255) DEFAULT NULL,
  `scope` varchar(255) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `client_id`, `client_secret`, `expires_in`, `nama`, `username`, `email`, `password_hash`, `status`, `auth_key`, `password_reset_token`, `access_token`, `token_type`, `scope`, `created_at`, `updated_at`) VALUES
(26, '2uRt_lnGceBW4HU', '59ONAdxoSxcT4kCTo3avCNcvtjMw2hQfAyTZqxiT', '2021-12-12 14:48:26', 'Udin', 'udin', 'udin@gmail.com', '$2y$13$4enrY.nUUHcN9vdiNWTfvemaEwHQSjPlnNg9XowTm753vMz7DRlfy', '1', '0i8Xq6pO57WpJIgs7n4vG1sz7q62RPIi', NULL, 'UQxCAHUw360dktQrVd6P-aiD3C0ATucuyXPT0hK0', 'Bearer', 'app', '1635493257', '2021-11-12 14:48:26'),
(39, '2uRt_lnGceBW4HG', '59ONAdxoSxcT4kCTo3avCNcvtjMw2hQfAyTZqx1X', '2021-12-12 14:16:50', 'andri', 'andri', 'andri.rizki007@gmail.com', '$2y$13$RWTbgTwjyb8e43ViyPcpr.gFoLr4gWvYtgp2Crdk7oprlxupcvh7O', '1', '5Ex-M5tjUSyS2rKK5rfYi7mTJ0Ytb6sK', 'IiGVtCVwqptcL9bsOHOF_Cclf1d0ZBO7_1636689836', 'ed4x2VWVah_Q31EQVXo4gf-IY_K9hLzvUzLWLL7-', 'Bearer', 'app', '1635914938', '2021-11-12 14:16:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`anggota_id`),
  ADD UNIQUE KEY `nomor_anggota` (`nomor_anggota`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `email_sent`
--
ALTER TABLE `email_sent`
  ADD PRIMARY KEY (`email_sent_id`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`kehadiran_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `anggota_id` (`anggota_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `anggota_id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `email_sent`
--
ALTER TABLE `email_sent`
  MODIFY `email_sent_id` int(45) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `kehadiran_id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `kehadiran_ibfk_2` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
