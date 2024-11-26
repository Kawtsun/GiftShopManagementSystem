-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 26, 2024 at 03:39 PM
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
-- Database: `giftshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `main_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `quantity`, `main_product_id`) VALUES
(132, 4, 1, 3),
(133, 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `main_products`
--

CREATE TABLE `main_products` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_products`
--

INSERT INTO `main_products` (`product_id`, `product_code`, `product_name`, `product_price`, `product_image`) VALUES
(1, 'K001', 'Sambalilong Itim', 250.00, 'images/SambaliloItim.png'),
(2, 'K002', 'Sambalilong Kayumanggi', 250.00, 'images/SambaliloKayumanggi.png'),
(3, 'K003', 'Tasang Kayumanggi', 400.00, 'images/TasangKayumanggi.png'),
(4, 'K004', 'Tasang Kalesa', 420.00, 'images/TasangKalesa.png'),
(5, 'K005', 'Tasang Dyip', 400.00, 'images/TasangDyip.png'),
(6, 'K006', 'Halapot Kahel', 150.00, 'images/HalapotKahel.png'),
(7, 'K007', 'Halapot Asul', 150.00, 'images/HalapotAsul.png'),
(8, 'K008', 'Panabit na Watawat', 100.00, 'images/Panabit.png'),
(9, 'K009', 'Kamisetang Itim', 350.00, 'images/KamisetaItim.png'),
(10, 'K010', 'Kamisetang Abo', 350.00, 'images/KamisetaAbo.png'),
(11, 'K011', 'Dyaket', 1000.00, 'images/Dyaket.png'),
(12, 'K012', 'Tasang Panglakbay', 400.00, 'images/TasaPaglakbay.png'),
(13, 'K013', 'Tasang Pangsiyasat', 400.00, 'images/TasaSiyasat.png'),
(14, 'K014', 'Dyaket na Pilipinas', 1000.00, 'images/DyaketNaPilipinas.png'),
(15, 'K015', 'Barkong Inukit sa Kahoy', 750.00, 'images/InukitNaBarko.png'),
(16, 'K016', 'Rosaryo', 150.00, 'images/Rosaryo.png'),
(17, 'K017', 'Sambalilong Pambabae', 400.00, 'images/SambalilongPambabae.png'),
(18, 'K018', 'Pilipinas Polo', 600.00, 'images/PilipinasPolo.png'),
(19, 'K019', 'Pilipinas Polo v2', 650.00, 'images/PilipinasPoloV2.png'),
(20, 'K020', 'Bayong', 250.00, 'images/Bayong.png'),
(21, 'K021', 'Tsarera', 350.00, 'images/Tsarera.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `name`, `email`, `address`, `payment_method`, `order_date`) VALUES
(5, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Morong', 'cod', '2024-11-24 08:00:33'),
(6, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'refffd', 'cod', '2024-11-24 08:02:29'),
(7, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'rizal', 'cod', '2024-11-24 08:04:14'),
(8, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsdsd', 'cod', '2024-11-24 09:17:34'),
(9, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsada', 'cod', '2024-11-25 08:15:36'),
(10, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'New', 'cod', '2024-11-25 08:17:50'),
(11, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Morong, Rizal', 'cod', '2024-11-25 09:10:32'),
(12, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'ddsd', 'cod', '2024-11-25 09:48:45'),
(13, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsdd', 'credit_card', '2024-11-25 09:59:26'),
(14, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsdad', 'cod', '2024-11-25 10:00:49'),
(15, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'ddsds', 'cod', '2024-11-25 10:03:13'),
(16, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'ddsds', 'cod', '2024-11-25 10:03:25'),
(17, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsd', 'cod', '2024-11-25 10:05:03'),
(18, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'bvbvbb', 'cod', '2024-11-25 10:09:37'),
(19, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'gfdfd', 'cod', '2024-11-25 10:12:08'),
(20, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'sdssdds', 'cod', '2024-11-25 10:13:52'),
(21, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsdsd', 'cod', '2024-11-25 10:14:41'),
(22, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsdsd', 'cod', '2024-11-25 10:18:45'),
(23, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'sdsd', 'cod', '2024-11-25 10:20:48'),
(24, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsd', 'cod', '2024-11-25 10:23:10'),
(25, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsds', 'cod', '2024-11-25 10:23:51'),
(26, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'fdff', 'cod', '2024-11-25 10:37:49'),
(27, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsdd', 'cod', '2024-11-25 10:38:07'),
(28, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'sdsd', 'cod', '2024-11-25 10:39:31'),
(29, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsdsd', 'cod', '2024-11-25 10:40:13'),
(30, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsdsd', 'cod', '2024-11-25 11:53:48'),
(31, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dfdf', 'cod', '2024-11-25 11:56:57'),
(32, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'sddad', 'cod', '2024-11-25 11:59:23'),
(33, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'sdd', 'cod', '2024-11-25 12:00:13'),
(34, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'sddad', 'cod', '2024-11-25 12:00:46'),
(35, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'fdfdfdf', 'cod', '2024-11-25 12:01:35'),
(36, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dffdf', 'cod', '2024-11-25 12:02:11'),
(37, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'fdfdf', 'cod', '2024-11-25 12:02:46'),
(38, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dssd', 'cod', '2024-11-25 12:03:12'),
(39, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsadadad', 'cod', '2024-11-25 12:04:24'),
(40, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsddd', 'cod', '2024-11-25 12:06:24'),
(41, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dfddf', 'cod', '2024-11-25 12:16:07'),
(42, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'xccxcx', 'Cash on Delivery (COD)', '2024-11-25 12:40:05'),
(43, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'sddadada', 'Cash on Delivery (COD)', '2024-11-25 12:41:00'),
(44, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'nnjnjm', 'Cash on Delivery (COD)', '2024-11-25 13:02:34'),
(45, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsdsdd', 'Cash on Delivery (COD)', '2024-11-25 13:05:08'),
(46, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'cxxcxc', 'Cash on Delivery (COD)', '2024-11-25 13:05:33'),
(47, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'sddd', 'Cash on Delivery (COD)', '2024-11-25 13:06:26'),
(48, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dadad', 'Cash on Delivery (COD)', '2024-11-25 13:07:30'),
(49, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsdd', 'Cash on Delivery (COD)', '2024-11-25 13:09:16'),
(50, 4, 'Tomori Kusunoki', 'tomoriru@gmail.com', 'dsdda', 'Cash on Delivery (COD)', '2024-11-25 14:05:31'),
(51, 4, 'Tomori Kusunoki', 'tomoriru@gmail.com', 'dadas', 'Cash on Delivery (COD)', '2024-11-25 14:06:46'),
(52, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dsdadadasd', 'Cash on Delivery (COD)', '2024-11-25 14:20:17'),
(53, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'dfzsfsdfddf', 'Cash on Delivery (COD)', '2024-11-25 14:20:53'),
(54, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 02:36:50'),
(55, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'ssd', 'Cash on Delivery (COD)', '2024-11-26 02:37:07'),
(56, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'sddsdd', 'Cash on Delivery (COD)', '2024-11-26 02:40:11'),
(57, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'weewe', 'Cash on Delivery (COD)', '2024-11-26 03:00:34'),
(58, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:07:19'),
(59, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:09:42'),
(60, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:12:22'),
(61, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:13:04'),
(62, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:13:25'),
(63, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:16:43'),
(64, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:19:02'),
(65, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:20:22'),
(66, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:21:24'),
(67, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:22:20'),
(68, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:22:39'),
(69, 1, 'Morpheus Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:24:35'),
(70, 1, 'Morpheus Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 04:45:20'),
(71, 1, 'Morpheus Francisco', 'kawtsun@gmail.com', 'Rizal', 'Cash on Delivery (COD)', '2024-11-26 07:44:53'),
(72, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Morong, Rizal', 'Cash on Delivery (COD)', '2024-11-26 08:33:11'),
(73, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Morong, Rizal', 'Cash on Delivery (COD)', '2024-11-26 09:32:06'),
(74, 1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Morong, Rizal', 'Cash on Delivery (COD)', '2024-11-26 14:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `main_product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `main_product_id`, `quantity`) VALUES
(1, 5, 2, 1),
(2, 5, 3, 1),
(3, 6, 1, 3),
(4, 6, 3, 1),
(5, 7, 1, 1),
(6, 7, 3, 1),
(7, 8, 2, 3),
(8, 8, 1, 8),
(9, 8, 3, 1),
(10, 9, 2, 8),
(11, 9, 3, 1),
(12, 10, 2, 1),
(13, 10, 3, 1),
(14, 11, 2, 1),
(15, 11, 7, 2),
(16, 11, 3, 1),
(17, 11, 5, 1),
(18, 12, 2, 1),
(19, 12, 3, 1),
(20, 13, 2, 1),
(21, 14, 2, 1),
(22, 15, 2, 1),
(23, 17, 2, 1),
(24, 18, 2, 1),
(25, 19, 2, 1),
(26, 19, 3, 1),
(27, 20, 2, 1),
(28, 20, 3, 1),
(29, 21, 3, 1),
(30, 21, 2, 1),
(31, 22, 2, 1),
(32, 23, 2, 1),
(33, 23, 3, 1),
(34, 24, 2, 3),
(35, 25, 3, 1),
(36, 26, 2, 1),
(37, 26, 3, 1),
(38, 27, 2, 1),
(39, 27, 3, 1),
(40, 28, 2, 1),
(41, 28, 3, 1),
(42, 29, 2, 1),
(43, 29, 3, 1),
(44, 30, 2, 1),
(45, 31, 3, 1),
(46, 32, 2, 1),
(47, 32, 3, 1),
(48, 33, 3, 1),
(49, 34, 2, 1),
(50, 35, 2, 1),
(51, 35, 3, 1),
(52, 36, 2, 1),
(53, 37, 2, 1),
(54, 38, 3, 1),
(55, 39, 3, 2),
(56, 39, 2, 1),
(57, 39, 7, 1),
(58, 39, 4, 1),
(59, 39, 8, 1),
(60, 40, 3, 1),
(61, 40, 2, 1),
(62, 41, 2, 1),
(63, 41, 3, 1),
(64, 42, 3, 2),
(65, 42, 2, 2),
(66, 43, 2, 1),
(67, 43, 3, 1),
(68, 44, 2, 1),
(69, 44, 3, 1),
(70, 45, 2, 1),
(71, 46, 3, 1),
(72, 46, 2, 1),
(73, 47, 3, 1),
(74, 47, 2, 1),
(75, 48, 2, 1),
(76, 49, 2, 1),
(77, 49, 3, 1),
(78, 50, 3, 1),
(79, 51, 3, 1),
(80, 51, 2, 1),
(81, 52, 21, 1),
(82, 53, 2, 1),
(83, 54, 3, 1),
(84, 54, 2, 1),
(85, 55, 3, 1),
(86, 56, 2, 1),
(87, 56, 3, 1),
(88, 57, 2, 1),
(89, 57, 3, 1),
(90, 58, 2, 1),
(91, 58, 3, 1),
(92, 59, 2, 1),
(93, 59, 3, 1),
(94, 60, 2, 1),
(95, 60, 3, 1),
(96, 61, 2, 2),
(97, 61, 3, 1),
(98, 62, 2, 1),
(99, 62, 3, 1),
(100, 63, 2, 1),
(101, 63, 3, 1),
(102, 64, 2, 1),
(103, 64, 3, 1),
(104, 65, 2, 1),
(105, 65, 3, 1),
(106, 66, 2, 1),
(107, 67, 2, 1),
(108, 67, 3, 1),
(109, 68, 2, 1),
(110, 68, 3, 1),
(111, 69, 2, 1),
(112, 70, 2, 1),
(113, 71, 2, 2),
(114, 72, 3, 1),
(115, 73, 2, 1),
(116, 74, 3, 1),
(117, 74, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `main_product_id` int(11) NOT NULL,
  `is_featured` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_code`, `product_name`, `product_price`, `product_image`, `main_product_id`, `is_featured`) VALUES
('K001', 'Sambalilong Itim', 250.00, 'images/SambaliloItim.png', 1, 0),
('K002', 'Sambalilong Kayumanggi', 250.00, 'images/SambaliloKayumanggi.png', 2, 0),
('K003', 'Tasang Kayumanggi', 400.00, 'images/TasangKayumanggi.png', 3, 1),
('K004', 'Tasang Kalesa', 420.00, 'images/TasangKalesa.png', 4, 0),
('K005', 'Tasang Dyip', 400.00, 'images/TasangDyip.png', 5, 0),
('K006', 'Halapot Kahel', 150.00, 'images/HalapotKahel.png', 6, 0),
('K007', 'Halapot Asul', 150.00, 'images/HalapotAsul.png', 7, 1),
('K008', 'Panabit na Watawat', 100.00, 'images/Panabit.png', 8, 0),
('K009', 'Kamisetang Itim', 350.00, 'images/KamisetaItim.png', 9, 0),
('K010', 'Kamisetang Abo', 350.00, 'images/KamisetaAbo.png', 10, 0),
('K011', 'Dyaket', 1000.00, 'images/Dyaket.png', 11, 0),
('K012', 'Tasang Panglakbay', 400.00, 'images/TasaPaglakbay.png', 12, 0),
('K013', 'Tasang Pangsiyasat', 400.00, 'images/TasaSiyasat.png', 13, 0),
('K014', 'Dyaket na Pilipinas', 1000.00, 'images/DyaketNaPilipinas.png', 14, 1),
('K015', 'Barkong Inukit sa Kahoy', 750.00, 'images/InukitNaBarko.png', 15, 0),
('K016', 'Rosaryo', 150.00, 'images/Rosaryo.png', 16, 1),
('K017', 'Sambalilong Pambabae', 400.00, 'images/SambalilongPambabae.png', 17, 1),
('K018', 'Pilipinas Polo', 600.00, 'images/PilipinasPolo.png', 18, 0),
('K019', 'Pilipinas Polo v2', 650.00, 'images/PilipinasPoloV2.png', 19, 1),
('K020', 'Bayong', 250.00, 'images/Bayong.png', 20, 0),
('K021', 'Tsarera', 350.00, 'images/Tsarera.png', 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `shipping_address` text NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `fullname`, `shipping_address`, `email`) VALUES
(1, 1, 'Morpheus Joshua Francisco', 'Morong, Rizal', 'kawtsun@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `username`, `password`) VALUES
(1, 'Morpheus Joshua Francisco', 'kawtsun@gmail.com', 'Kawtsun', '$2y$10$L0otNUCGWQ4wwYnXMwwL.eJzyPyDPNm9oRbmuLrieL3cebYdmU6aa'),
(4, 'Tomori Kusunoki', 'tomoriru@gmail.com', 'Tomoriru', '$2y$10$etiATqM/PCYH8gqcdhSPnOf2sPnKKl/KPRoSsCLycXCXlNmPgoeQK'),
(5, 'Setsuna Yuki', 'setsu@gmail.com', 'Setsu', '$2y$10$aq1TW7j10v5dA9M/FJi8Aemt563HDxZNPyz6qgfWxiPI6DT4B7eJa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `main_product_id` (`main_product_id`);

--
-- Indexes for table `main_products`
--
ALTER TABLE `main_products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `main_product_id` (`main_product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_code`),
  ADD KEY `main_product_id` (`main_product_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `main_products`
--
ALTER TABLE `main_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`main_product_id`) REFERENCES `main_products` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_4` FOREIGN KEY (`main_product_id`) REFERENCES `main_products` (`product_id`),
  ADD CONSTRAINT `cart_ibfk_5` FOREIGN KEY (`main_product_id`) REFERENCES `main_products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`main_product_id`) REFERENCES `main_products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`main_product_id`) REFERENCES `main_products` (`product_id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
