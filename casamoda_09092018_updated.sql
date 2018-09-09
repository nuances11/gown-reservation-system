-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2018 at 05:36 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.16

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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_archive` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `identifier`, `created_at`, `updated_at`, `is_archive`) VALUES
(1, 'Sample Category', 'sample_category', '2018-08-06 15:30:17', '2018-09-09 15:07:14', 0),
(2, 'Category Sample', 'category_sample', '2018-08-08 04:36:16', '2018-08-08 04:37:02', 0),
(3, 'Test Yong', 'test_yong', '2018-08-08 04:41:13', '0000-00-00 00:00:00', 0),
(4, 'Sample Yong', 'sample_yong', '2018-08-08 04:41:37', '0000-00-00 00:00:00', 0),
(5, 'Sample&* Yongs', 'sample_yongs', '2018-08-08 04:41:56', '0000-00-00 00:00:00', 0),
(6, 'Sample Task', 'sample_task', '2018-08-08 04:43:29', '2018-09-09 15:09:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `dress_count` int(11) NOT NULL,
  `is_available` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `dress_count`, `is_available`, `price`, `created_at`, `updated_at`) VALUES
(1, 'sadasdasd1111', 9, 1, 99, '2018-08-23 16:10:35', '2018-09-09 12:05:40'),
(2, 'My Sample Category', 9, 1, 99, '2018-08-23 16:10:35', '2018-09-09 12:05:40');

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
  `is_available` int(11) DEFAULT '0',
  `price` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `is_archive` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `image`, `description`, `is_available`, `price`, `size_id`, `qty`, `is_archive`, `created_at`, `updated_at`) VALUES
(1, 'Sample Product 1', 1, '1.jpg', 'Sample Description', 1, 99, 2, 9, 0, '2018-08-26 10:03:53', '2018-09-09 14:21:26'),
(2, 'Sample Product 2', 2, '1.jpg', 'Sample Description', 1, 99, 2, 19, 0, '2018-08-26 10:04:41', '2018-09-02 15:07:17'),
(3, 'Sample Product 3', 3, '1.jpg', 'sdfsfsdfsdfsd', 1, 99, 3, 20, 0, '2018-08-26 10:05:25', '2018-09-02 01:36:34'),
(4, 'My Sample Archive Product', 4, '1.jpg', 'Sample Description', 1, 99, 2, 8, 1, '2018-09-09 14:45:40', '2018-09-09 14:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `products_sizes`
--

CREATE TABLE `products_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `size` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `size`, `created_at`, `updated_at`) VALUES
(1, 'XXS', '2018-08-21 16:37:52', '0000-00-00 00:00:00'),
(2, 'XS', '2018-08-21 16:37:52', '0000-00-00 00:00:00'),
(3, 'S', '2018-08-21 16:37:52', '0000-00-00 00:00:00'),
(4, 'M', '2018-08-21 16:37:52', '0000-00-00 00:00:00'),
(5, 'L', '2018-08-21 16:37:52', '0000-00-00 00:00:00'),
(6, 'XL', '2018-08-21 16:37:52', '0000-00-00 00:00:00'),
(7, 'XXL', '2018-08-21 16:37:52', '0000-00-00 00:00:00'),
(8, 'XXL', '2018-08-21 16:37:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_no` varchar(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `company-name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `town_city` varchar(255) DEFAULT NULL,
  `product_type` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_no`, `firstname`, `lastname`, `email`, `phone`, `company-name`, `address`, `town_city`, `product_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'N7EP4MJ', 'My Name', 'My Last name', 'sample1@sample.com', '09982812771', '', '', '', NULL, 2, '2018-09-02 15:34:11', '2018-09-09 06:59:27'),
(2, 'NRUIYST', 'dasdasdas', 'dasdasdasd', 'sample1@sample.com', '09927171661', '', '', '', NULL, 1, '2018-09-02 15:35:18', '2018-09-09 09:58:34'),
(3, 'GSJ4HBU', 'Sample', 'My Last name', 'sample@sample1.com', '09982818227', '', '', '', NULL, 2, '2018-09-03 07:10:57', '2018-09-09 10:04:30'),
(4, 'MUABAMN', 'Sample', 'Transaction 1', 'sample1@sample.com', '09982712663', '', '', '', NULL, 3, '2018-09-09 08:20:57', '2018-09-09 08:23:17'),
(5, 'ZO7Y9EY', 'Sample', 'Transaction 2', 'sample1@sample.com', '09982712773', '', '', '', NULL, 2, '2018-09-09 08:22:16', '2018-09-09 09:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL,
  `transaction_no` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `res_date` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_no`, `product_id`, `qty`, `price`, `subtotal`, `res_date`, `created_at`, `updated_at`) VALUES
(1, 'N7EP4MJ', 1, 2, 99, 198, '09/03/2018', '2018-09-02 15:34:11', '0000-00-00 00:00:00'),
(2, 'NRUIYST', 1, 2, 99, 198, '09/03/2018', '2018-09-02 15:35:18', '0000-00-00 00:00:00'),
(3, 'GSJ4HBU', 1, 2, 99, 198, '09/03/2018', '2018-09-03 07:10:58', '0000-00-00 00:00:00'),
(4, 'MUABAMN', 1, 1, 99, 99, '09/10/2018', '2018-09-09 08:20:57', '0000-00-00 00:00:00'),
(5, 'ZO7Y9EY', 1, 1, 99, 99, '09/10/2018', '2018-09-09 08:22:16', '0000-00-00 00:00:00');

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_group`, `created_at`, `updated_at`) VALUES
(1, 'Casa Moda', 'admin', '2c9341ca4cf3d87b9e4eb905d6a3ec45', '1', '2018-08-03 14:47:33', '2018-08-06 02:32:08'),
(3, 'Sample Yong', 'sampleyonh', '66916216511cb09e5f31bbbf5775e9ce', '1', NULL, NULL),
(4, 'My Sample name', 'sample', '66916216511cb09e5f31bbbf5775e9ce', '2', NULL, '2018-09-09 13:36:41'),
(5, 'My Sample Name', 'sample1', '66916216511cb09e5f31bbbf5775e9ce', '2', '2018-09-09 12:59:08', '2018-09-09 13:38:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_sizes`
--
ALTER TABLE `products_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
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
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products_sizes`
--
ALTER TABLE `products_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
