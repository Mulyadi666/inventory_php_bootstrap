-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 02:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(22, 'Elektronik', NULL, '2025-02-03 13:15:45'),
(23, 'Alat Tulis', NULL, '2025-02-03 13:15:45'),
(24, 'Makanan', NULL, '2025-02-03 13:15:45'),
(25, 'Minuman', NULL, '2025-02-03 13:15:45'),
(26, 'Peralatan Rumah Tangga', NULL, '2025-02-03 13:15:45'),
(27, 'Pakaian', NULL, '2025-02-03 13:15:45'),
(28, 'Peralatan Dapur', NULL, '2025-02-03 13:15:45'),
(29, 'Peralatan Kantor', NULL, '2025-02-03 13:15:45'),
(30, 'Mainan', NULL, '2025-02-03 13:15:45'),
(31, 'Aksesoris', NULL, '2025-02-03 13:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `category_id`, `quantity`, `description`, `created_at`) VALUES
(1, 'Laptop ASUS', 22, 10, 'Laptop gaming dengan spesifikasi tinggi', '2025-02-03 13:22:47'),
(2, 'Blender Philips', 23, 15, 'Blender serbaguna untuk dapur', '2025-02-03 13:22:47'),
(3, 'Pulpen Pilot', 24, 50, 'Pulpen gel warna hitam', '2025-02-03 13:22:47'),
(4, 'Kemeja Pria', 25, 20, 'Kemeja formal bahan katun', '2025-02-03 13:22:47'),
(5, 'Sepatu Sneakers', 26, 25, 'Sepatu casual untuk pria & wanita', '2025-02-03 13:22:47'),
(6, 'Lipstik Maybelline', 27, 30, 'Lipstik matte tahan lama', '2025-02-03 13:22:47'),
(7, 'Boneka Teddy Bear', 28, 18, 'Boneka ukuran besar warna coklat', '2025-02-03 13:22:47'),
(8, 'Meja Belajar', 29, 10, 'Meja minimalis dengan bahan kayu', '2025-02-03 13:22:47'),
(9, 'Headphone Bluetooth', 30, 12, 'Headphone wireless dengan noise cancelling', '2025-02-03 13:22:47'),
(10, 'Matras Yoga', 31, 22, 'Matras olahraga untuk yoga dan pilates', '2025-02-03 13:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `items_out`
--

CREATE TABLE `items_out` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_out` int(11) NOT NULL,
  `date_out` timestamp NOT NULL DEFAULT current_timestamp(),
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(2, 'admin', '$2y$10$C3D2OmPRuG87iYDMp69ISOGWq.r03pejoPVYqPZLiibgW56pcr3be', 'admin', '2025-01-18 11:50:32'),
(3, 'raka', '$2y$10$XB3X76YrW9UiXp.37tDZIewEH09Z0ECn1n1lixPq3c6wFwZoLtWki', 'user', '2025-01-18 11:51:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `items_out`
--
ALTER TABLE `items_out`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items_out`
--
ALTER TABLE `items_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
