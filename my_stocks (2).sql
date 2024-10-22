-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2024 at 02:45 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_stocks`
--

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `user_id` int NOT NULL,
  `stock_id` int NOT NULL,
  `stock_symbol` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `average_price` decimal(10,2) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `account_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`user_id`, `stock_id`, `stock_symbol`, `quantity`, `average_price`, `username`, `account_number`) VALUES
(1, 1, 'AAPL', 10, 170.00, 'john_doe', 'ACC0001'),
(1, 2, 'GOOGL', 3, 2850.00, 'john_doe', 'ACC0001'),
(2, 1, 'AAPL', 0, 0.00, 'jane_smith', 'ACC0002'),
(2, 2, 'GOOGL', 5, 2800.00, 'jane_smith', 'ACC0002'),
(3, 3, 'AMZN', 2, 3400.00, 'alice_brown', 'ACC0003');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int NOT NULL,
  `stock_symbol` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stock_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `current_price` decimal(10,2) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `stock_symbol`, `stock_name`, `current_price`, `updated_at`, `description`) VALUES
(1, 'AAPL', 'Apple Inc.', 236.58, '2024-10-21 19:59:59', ''),
(2, 'GOOGL', 'Alphabet Inc.', 164.15, '2024-10-21 19:59:58', ''),
(3, 'AMZN', 'Amazon.com Inc.', 189.04, '2024-10-21 19:59:49', ''),
(4, 'test', 'test', 1234.00, '2024-08-28 12:38:04', ''),
(5, 'test', 'test', 1234.00, '2024-08-28 12:38:07', ''),
(6, 'test', 'test', 1234.00, '2024-08-28 12:39:29', ''),
(7, 'test', 'test', 1234.00, '2024-09-28 00:14:05', ''),
(8, 'test', 'test', 1234.00, '2024-08-28 12:47:59', ''),
(9, 'test', 'test', 1234.00, '2024-08-28 12:48:13', ''),
(10, 'test', 'test', 123.00, '2024-08-28 12:48:20', ''),
(11, 'test', 'test', 123.00, '2024-08-28 12:55:23', '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_prices`
--

CREATE TABLE `stock_prices` (
  `price_id` int NOT NULL,
  `stock_symbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `price_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_prices`
--

INSERT INTO `stock_prices` (`price_id`, `stock_symbol`, `price`, `price_date`) VALUES
(7, 'AAPL', 150.00, '2024-08-27 08:31:51'),
(8, 'AAPL', 150.00, '2024-08-27 08:31:51'),
(9, 'AAPL', 200.00, '2024-08-27 08:49:33'),
(10, 'GOOGL', 2750.00, '2024-08-27 08:49:33'),
(12, 'AAPL', 200.00, '2024-08-27 08:50:53'),
(13, 'GOOGL', 2750.00, '2024-08-27 08:50:53'),
(14, 'AMZN', 700.00, '2024-08-27 08:50:53'),
(15, 'AAPL', 200.00, '2024-08-27 08:57:25'),
(16, 'GOOGL', 2750.00, '2024-08-27 08:57:25'),
(17, 'AMZN', 700.00, '2024-08-27 08:57:25'),
(18, 'AMZN', 174.47, '2024-08-27 09:05:41'),
(19, 'AMZN', 174.42, '2024-08-27 09:05:42'),
(20, 'AAPL', 225.77, '2024-08-27 09:05:43'),
(21, 'GOOGL', 165.65, '2024-08-27 09:05:44'),
(22, 'AMZN', 174.47, '2024-08-27 09:05:45'),
(23, 'AAPL', 225.73, '2024-08-27 09:05:49'),
(24, 'AMZN', 174.41, '2024-08-27 09:05:50'),
(25, 'AMZN', 174.42, '2024-08-27 09:05:51'),
(26, 'AMZN', 174.40, '2024-08-27 09:05:52'),
(27, 'AMZN', 174.45, '2024-08-27 09:05:53'),
(28, 'AMZN', 174.40, '2024-08-27 09:05:54'),
(29, 'AAPL', 225.79, '2024-08-27 09:05:55'),
(30, 'GOOGL', 165.63, '2024-08-27 09:05:56'),
(31, 'AMZN', 174.47, '2024-08-27 09:05:57'),
(32, 'AMZN', 174.40, '2024-08-27 09:05:58'),
(33, 'AAPL', 225.86, '2024-08-27 09:05:59'),
(34, 'GOOGL', 165.60, '2024-08-27 09:06:00'),
(35, 'AAPL', 225.86, '2024-08-27 09:06:01'),
(36, 'AMZN', 174.44, '2024-08-27 09:06:02'),
(37, 'AMZN', 174.47, '2024-08-27 09:06:03'),
(38, 'AMZN', 174.47, '2024-08-27 09:06:04'),
(39, 'AAPL', 236.52, '2024-10-21 19:57:08'),
(40, 'AMZN', 189.04, '2024-10-21 19:57:15'),
(41, 'AMZN', 189.02, '2024-10-21 19:57:18'),
(42, 'AMZN', 189.00, '2024-10-21 19:57:25'),
(43, 'AMZN', 189.01, '2024-10-21 19:57:28'),
(44, 'AMZN', 189.02, '2024-10-21 19:57:29'),
(45, 'AAPL', 236.50, '2024-10-21 19:57:32'),
(46, 'AAPL', 236.55, '2024-10-21 19:57:35'),
(47, 'AAPL', 236.52, '2024-10-21 19:57:36'),
(48, 'AMZN', 189.00, '2024-10-21 19:57:37'),
(49, 'AAPL', 236.55, '2024-10-21 19:57:48'),
(50, 'AMZN', 189.01, '2024-10-21 19:57:49'),
(51, 'AMZN', 189.04, '2024-10-21 19:57:51'),
(52, 'AAPL', 236.53, '2024-10-21 19:57:52'),
(53, 'AMZN', 189.03, '2024-10-21 19:57:56'),
(54, 'AAPL', 236.48, '2024-10-21 19:57:57'),
(55, 'AAPL', 236.53, '2024-10-21 19:58:00'),
(56, 'AMZN', 189.03, '2024-10-21 19:58:01'),
(57, 'AMZN', 189.01, '2024-10-21 19:58:04'),
(58, 'AMZN', 189.03, '2024-10-21 19:58:09'),
(59, 'AAPL', 236.48, '2024-10-21 19:58:11'),
(60, 'AAPL', 236.48, '2024-10-21 19:58:12'),
(61, 'AAPL', 236.55, '2024-10-21 19:58:17'),
(62, 'AAPL', 236.55, '2024-10-21 19:58:18'),
(63, 'AMZN', 189.00, '2024-10-21 19:58:20'),
(64, 'AMZN', 189.02, '2024-10-21 19:58:22'),
(65, 'AMZN', 189.02, '2024-10-21 19:58:27'),
(66, 'AAPL', 236.55, '2024-10-21 19:58:30'),
(67, 'AAPL', 236.52, '2024-10-21 19:58:31'),
(68, 'GOOGL', 164.10, '2024-10-21 19:58:35'),
(69, 'AAPL', 236.48, '2024-10-21 19:58:42'),
(70, 'AMZN', 189.02, '2024-10-21 19:58:44'),
(71, 'AMZN', 189.00, '2024-10-21 19:58:51'),
(72, 'AAPL', 236.50, '2024-10-21 19:58:52'),
(73, 'AMZN', 189.02, '2024-10-21 19:58:53'),
(74, 'AAPL', 236.50, '2024-10-21 19:58:58'),
(75, 'AMZN', 189.04, '2024-10-21 19:59:00'),
(76, 'AMZN', 189.04, '2024-10-21 19:59:03'),
(77, 'AAPL', 236.50, '2024-10-21 19:59:05'),
(78, 'AAPL', 236.51, '2024-10-21 19:59:09'),
(79, 'GOOGL', 164.12, '2024-10-21 19:59:11'),
(80, 'AAPL', 236.54, '2024-10-21 19:59:13'),
(81, 'AMZN', 189.04, '2024-10-21 19:59:15'),
(82, 'AAPL', 236.53, '2024-10-21 19:59:17'),
(83, 'AMZN', 189.00, '2024-10-21 19:59:19'),
(84, 'AMZN', 189.00, '2024-10-21 19:59:24'),
(85, 'GOOGL', 164.14, '2024-10-21 19:59:25'),
(86, 'AAPL', 236.57, '2024-10-21 19:59:26'),
(87, 'AAPL', 236.53, '2024-10-21 19:59:27'),
(88, 'AAPL', 236.57, '2024-10-21 19:59:28'),
(89, 'GOOGL', 164.12, '2024-10-21 19:59:31'),
(90, 'AMZN', 189.00, '2024-10-21 19:59:33'),
(91, 'AMZN', 189.00, '2024-10-21 19:59:34'),
(92, 'GOOGL', 164.13, '2024-10-21 19:59:35'),
(93, 'AAPL', 236.53, '2024-10-21 19:59:36'),
(94, 'AAPL', 236.53, '2024-10-21 19:59:39'),
(95, 'AAPL', 236.48, '2024-10-21 19:59:42'),
(96, 'AMZN', 189.04, '2024-10-21 19:59:47'),
(97, 'AMZN', 189.00, '2024-10-21 19:59:48'),
(98, 'AMZN', 189.04, '2024-10-21 19:59:50'),
(99, 'AAPL', 236.48, '2024-10-21 19:59:51'),
(100, 'AAPL', 236.53, '2024-10-21 19:59:54'),
(101, 'AAPL', 236.57, '2024-10-21 19:59:58'),
(102, 'GOOGL', 164.15, '2024-10-21 19:59:59'),
(103, 'AAPL', 236.58, '2024-10-21 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int NOT NULL,
  `stock_id` int NOT NULL,
  `transaction_type` enum('BUY','SELL') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `price_per_share` decimal(10,2) NOT NULL,
  `transaction_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `account_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `stock_id`, `transaction_type`, `quantity`, `price_per_share`, `transaction_date`, `username`, `account_number`) VALUES
(1, 1, 'BUY', 10, 170.00, '2024-08-21 10:02:06', 'john_doe', 'ACC0001'),
(2, 2, 'BUY', 5, 2800.00, '2024-08-21 10:02:06', 'jane_smith', 'ACC0002'),
(3, 3, 'BUY', 2, 3400.00, '2024-08-21 10:02:06', 'alice_brown', 'ACC0003'),
(4, 2, 'BUY', 3, 2850.00, '2024-08-21 10:02:06', 'john_doe', 'ACC0001'),
(5, 1, 'SELL', 2, 180.00, '2024-08-21 10:02:06', 'jane_smith', 'ACC0002');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `account_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `created_at`, `account_number`, `updated_at`, `is_admin`) VALUES
(1, 'admin', 'test@gmail.com', 'admin', '2024-08-21 10:01:36', 'ACC0001', '2024-10-21 19:48:18', 0),
(2, 'jane_smith', 'jane@example.com', 'password_hash_2', '2024-08-21 10:01:36', 'ACC0002', '2024-10-21 19:48:18', 0),
(3, 'alice_brown', 'alice@example.com', 'password_hash_3', '2024-08-21 10:01:36', 'ACC0003', '2024-10-21 19:48:18', 0),
(4, 'Hugo Montreuil', 'montreuilhugo@gmail.com', '$2y$10$mjG2ZTmgg9wgUi0GwTuJJ.QaX1wVJUYaKr6pDeCSe6bTOuOx7ZG0O', '2024-10-21 19:50:09', NULL, '2024-10-21 23:50:09', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`user_id`,`stock_id`),
  ADD KEY `stock_id` (`stock_id`),
  ADD KEY `stock_symbol` (`stock_symbol`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `stock_symbol` (`stock_symbol`);

--
-- Indexes for table `stock_prices`
--
ALTER TABLE `stock_prices`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `stock_id` (`stock_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `account_number` (`account_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stock_prices`
--
ALTER TABLE `stock_prices`
  MODIFY `price_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `portfolio_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `portfolio_ibfk_2` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`stock_id`),
  ADD CONSTRAINT `portfolio_ibfk_3` FOREIGN KEY (`stock_symbol`) REFERENCES `stock` (`stock_symbol`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`stock_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
