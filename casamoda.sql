-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2018 at 05:02 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `casamoda`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `identifier` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `identifier`, `created_at`, `updated_at`) VALUES
(1, 'Sample Category', 'sample_category', '2018-08-06 15:30:17', '2018-08-06 16:05:08'),
(2, 'Category Sample', 'category_sample', '2018-08-08 04:36:16', '2018-08-08 04:37:02'),
(3, 'Test Yong', 'test_yong', '2018-08-08 04:41:13', '0000-00-00 00:00:00'),
(4, 'Sample Yong', 'sample_yong', '2018-08-08 04:41:37', '0000-00-00 00:00:00'),
(5, 'Sample&* Yongs', 'sample_yongs', '2018-08-08 04:41:56', '0000-00-00 00:00:00'),
(6, 'Sample Task', 'sample_task', '2018-08-08 04:43:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `is_featured` int(11) DEFAULT NULL,
  `is_best` int(11) DEFAULT NULL,
  `is_available` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `image`, `description`, `quantity`, `is_featured`, `is_best`, `is_available`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Sample Product', 1, '15037122_1344938775516949_8356180343562194768_n.jpg', 'Sample Description', 1, 1, 1, 1, 100, '2018-08-08 15:15:28', '2018-08-09 17:09:21'),
(2, 'Sample Product Sample', 1, NULL, 'Sample Description', 1, NULL, NULL, 1, 100, '2018-08-08 15:54:30', '2018-08-08 15:57:59'),
(3, 'Sample Add', 2, NULL, 'ssadasdasdasdasda', 9, NULL, NULL, 1, 1000, '2018-08-08 16:08:01', '2018-08-08 16:17:29'),
(4, 'Sample Product With Image', 1, '1.PNG', 'dasdasdasdasd', 9, 1, 1, 1, 99, '2018-08-09 16:35:58', '2018-08-09 17:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_group` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_group`, `created_at`, `updated_at`) VALUES
(1, 'Casa Moda', 'admin', '2c9341ca4cf3d87b9e4eb905d6a3ec45', '1', '2018-08-03 14:47:33', '2018-08-06 02:32:08'),
(3, 'Sample Yong', 'sampleyonh', '66916216511cb09e5f31bbbf5775e9ce', '1', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
