-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2026 at 05:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_backend_practice`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`) VALUES
(1, 'Wireless Keyboard', 2200, 'Accessories'),
(2, 'Ergonomic Mouse', 1800, 'Accessories'),
(3, 'Mechanical Gaming Keyboard', 4500, 'Accessories'),
(4, 'External Hard Drive 1TB', 3800, 'Storage'),
(5, 'Portable SSD 512GB', 3200, 'Storage'),
(6, 'Laptop Stand', 900, 'Accessories'),
(7, 'Webcam HD 1080p', 2500, 'Accessories'),
(8, 'USB Hub 4-Port', 650, 'Accessories'),
(9, 'Noise-Cancelling Headphones', 5200, 'Accessories'),
(10, 'MicroSD Card 128GB', 1100, 'Storage'),
(11, 'Bluetooth Speaker', 2700, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `token`, `email`, `role`) VALUES
(1, 'admin', '$2y$10$UmeEK/iG4G6K9TFIsTxavutRsAk5KIAU5BTa1BckppZClcFrxLMP.', 'e9252a47bed5719b4aaac9386689ee53', '', 'admin'),
(2, 'Dev.Rrrrr', '$2y$10$OaygxAwf3JMUK6694ITSHeJj4kkKY4hSSlh3m2ASii0G22RopA.Pm', '', '', ''),
(3, 'test', '$2y$10$zEwsIi.5RqrnK26s15/bc.2NsllsAZlzVYqAq/JFfQ0MUlUeHf/ny', '', '', ''),
(4, 'dev', '$2y$10$xE7ZJtIgGpD9Ca402lzxJupRMlX.J6GFwVOcRuonLTiv.8s.7geAC', '', 'dev@gmail.com', '');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
