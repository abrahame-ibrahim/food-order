-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 02:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-fusion`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_feedback`
--

CREATE TABLE `customer_feedback` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_feedback`
--

INSERT INTO `customer_feedback` (`id`, `customer_name`, `rating`, `comment`, `submitted_at`) VALUES
(1, 'ibrahim', 2, 'good service', '2025-04-23 21:40:54'),
(2, 'luxe', 5, 'great!', '2025-04-23 22:49:53'),
(3, 'Ibrahim', 5, 'I loved the food', '2025-04-24 01:02:35'),
(4, 'Ibrahim', 5, 'I loved the food', '2025-04-24 11:43:26'),
(5, 'ibrahim', 1, 'Goodwork!', '2025-04-24 23:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_description` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `amount`, `phone`, `created_at`, `transaction_description`, `status`) VALUES
(1, '3.00', '0728251935', '2024-11-28 14:15:49', 'Test Payment', 'Payment in Progress.'),
(2, '3.00', '+254728251935', '2024-11-28 14:35:44', 'Test Payment', 'Payment in Progress.'),
(3, '3.00', '0728251935', '2024-11-28 14:39:44', 'Test Payment', 'Payment in Progress.'),
(4, '1.00', '0723456789', '2024-12-02 10:13:18', NULL, 'Not Paid'),
(5, '1.00', '0728251935', '2024-12-02 10:13:51', NULL, 'Not Paid'),
(6, '1.00', '0728251935', '2024-12-02 10:15:34', NULL, 'Not Paid'),
(7, '1.00', '0728251935', '2024-12-02 10:20:16', NULL, 'Not Paid'),
(9, '1.00', '0723456789', '2024-12-02 10:29:14', NULL, 'Not Paid'),
(10, '1.00', '0728251935', '2024-12-02 10:29:34', NULL, 'Not Paid'),
(11, '1.00', '0728251935', '2024-12-02 10:30:55', NULL, 'Not Paid'),
(12, '2.00', '0728251935', '2024-12-02 10:31:51', NULL, 'Not Paid'),
(13, '2.00', '0728251935', '2024-12-02 13:44:48', NULL, 'Not Paid'),
(14, '2.00', '254728251935', '2024-12-02 13:50:50', NULL, 'Not Paid'),
(15, '2.00', '254728251935', '2024-12-02 13:51:08', NULL, 'Not Paid'),
(16, '2.00', '0723456789', '2024-12-02 14:01:00', NULL, 'Not Paid'),
(17, '2.00', '0723456789', '2024-12-02 14:11:28', NULL, 'Not Paid'),
(18, '2.00', '0728251935', '2024-12-02 14:12:34', NULL, 'Not Paid'),
(19, '1.00', '0723456789', '2024-12-02 14:13:38', NULL, 'Not Paid'),
(20, '4.00', '0728251935', '2024-12-02 14:49:04', NULL, 'Not Paid'),
(21, '3.00', '0723456789', '2024-12-02 14:58:04', NULL, 'Not Paid'),
(22, '3.00', '0723456789', '2024-12-02 15:05:56', NULL, 'Not Paid'),
(23, '100.00', '0723456789', '2024-12-02 15:22:07', NULL, 'Not Paid'),
(24, '2.00', '0723456789', '2024-12-02 15:39:55', NULL, 'Not Paid'),
(25, '900.00', '0723456789', '2024-12-02 15:45:41', NULL, 'Not Paid'),
(26, '7.00', '0723456789', '2024-12-02 18:12:23', NULL, 'Not Paid'),
(27, '9.00', '0728251935', '2024-12-02 18:18:40', NULL, 'Not Paid'),
(28, '0.00', '0723456789', '2024-12-03 19:37:37', NULL, 'Not Paid'),
(29, '0.00', '0728251935', '2024-12-03 19:38:31', NULL, 'Not Paid'),
(30, '0.00', '0728251935', '2024-12-03 19:44:00', NULL, 'Not Paid'),
(31, '0.00', '0728251935', '2024-12-03 19:44:00', NULL, 'Not Paid'),
(32, '0.00', '0728251935', '2024-12-03 19:44:18', NULL, 'Not Paid'),
(33, '0.00', '0723456789', '2024-12-04 06:25:46', NULL, 'Not Paid'),
(34, '3470.00', '254728251935', '2024-12-04 10:47:01', NULL, 'Paid'),
(35, '2410.00', '0728251935', '2024-12-04 11:05:48', NULL, 'Not Paid'),
(36, '2410.00', '0728251935', '2024-12-04 11:06:39', NULL, 'Not Paid'),
(37, '9640.00', '254728251935', '2024-12-04 11:08:41', NULL, 'Paid'),
(38, '700.00', '0114270614', '2025-01-03 22:44:04', NULL, 'Not Paid'),
(39, '2130.00', '254114270614', '2025-01-03 22:47:30', NULL, 'Paid'),
(40, '3930.00', '254114270614', '2025-01-04 04:50:10', NULL, 'Paid'),
(41, '120.00', '254728251935', '2025-01-10 22:41:28', NULL, 'Paid'),
(42, '120.00', '254728251935', '2025-01-10 22:42:26', NULL, 'Paid'),
(43, '1950.00', '0728251935', '2025-03-29 21:08:13', NULL, 'Not Paid'),
(44, '1950.00', '0728251935', '2025-03-29 21:08:28', NULL, 'Not Paid'),
(45, '1950.00', '0728251935', '2025-03-29 21:08:41', NULL, 'Not Paid'),
(46, '1950.00', '0728251935', '2025-03-29 21:12:45', NULL, 'Not Paid'),
(47, '1950.00', '0796748431', '2025-03-29 21:13:08', NULL, 'Not Paid'),
(48, '3020.00', '0728251935', '2025-03-29 21:24:57', NULL, 'Not Paid'),
(49, '3020.00', '0728251935', '2025-04-15 18:24:20', NULL, 'Not Paid'),
(50, '2400.00', '728251935', '2025-04-15 19:02:57', NULL, 'Not Paid'),
(51, '2400.00', '254728251935', '2025-04-15 19:03:19', NULL, 'Paid'),
(52, '2400.00', '254728251935', '2025-04-15 19:07:35', NULL, 'Paid'),
(53, '2400.00', '254728251935', '2025-04-15 19:08:10', NULL, 'Paid'),
(54, '2400.00', '254728251935', '2025-04-15 19:09:58', NULL, 'Paid'),
(55, '2400.00', '254796748431', '2025-04-15 19:37:35', NULL, 'Paid'),
(56, '2400.00', '254796748431', '2025-04-15 19:37:35', NULL, 'Not Paid'),
(57, '2400.00', '254796748431', '2025-04-16 21:25:48', NULL, 'Paid'),
(58, '2400.00', '254796748431', '2025-04-16 21:26:10', NULL, 'Paid'),
(59, '2400.00', '254728251935', '2025-04-16 22:02:04', NULL, 'Paid'),
(60, '2400.00', '254728251935', '2025-04-16 22:02:35', NULL, 'Not Paid'),
(61, '520.00', '254728251935', '2025-04-23 18:21:06', NULL, 'Not Paid'),
(62, '520.00', '254728251935', '2025-04-23 18:22:03', NULL, 'Paid'),
(63, '520.00', '254728251935', '2025-04-23 18:22:31', NULL, 'Paid'),
(64, '520.00', '254728251935', '2025-04-23 18:23:57', NULL, 'Paid'),
(65, '526.00', '254728251935', '2025-04-23 21:54:00', NULL, 'Paid'),
(66, '1040.00', '254728251935', '2025-04-23 21:56:22', NULL, 'Paid'),
(67, '1490.00', '254728251935', '2025-04-23 22:32:40', NULL, 'Paid'),
(68, '1490.00', '254728251935', '2025-04-23 22:35:14', NULL, 'Paid'),
(69, '1490.00', '254728251935', '2025-04-23 22:35:31', NULL, 'Paid'),
(70, '1490.00', '254707560414', '2025-04-23 22:48:17', NULL, 'Paid'),
(71, '1490.00', '254707560414', '2025-04-24 00:29:30', NULL, 'Paid'),
(72, '450.00', '254728251935', '2025-04-24 14:16:48', NULL, 'Paid'),
(73, '450.00', '254707560414', '2025-04-24 15:39:38', NULL, 'Paid'),
(74, '450.00', '254728251935', '2025-04-24 16:40:01', NULL, 'Paid'),
(75, '450.00', '254728251935', '2025-04-24 17:04:41', NULL, 'Paid'),
(76, '450.00', '254728251935', '2025-04-24 23:31:20', NULL, 'Paid'),
(77, '450.00', '254728251935', '2025-04-24 23:33:12', NULL, 'Paid'),
(78, '450.00', '254728251935', '2025-04-24 23:34:20', NULL, 'Paid'),
(79, '450.00', '254796748431', '2025-04-24 23:51:42', NULL, 'Paid'),
(80, '450.00', '254728251935', '2025-04-25 00:33:50', NULL, 'Paid'),
(81, '450.00', '254728251935', '2025-04-25 12:19:02', NULL, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(58, 'Abrahame ', 'Rahim', '81dc9bdb52d04dc20036dbd8313ed055'),
(61, 'Ibrahim M', 'Ibrahim', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(36, 'momo', 'Food_category_427.jpg', 'Yes', 'Yes'),
(38, 'pizza', 'Food_category_898.jpg', 'Yes', 'Yes'),
(43, 'Burger', 'Food_category_86.jpg', 'Yes', 'Yes'),
(44, 'African Dishes', 'Food_category_592.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(4, 'Best Burger', 'Burger with Ham, Pineapple and lots of Cheese', '350.00', 'Food-Name-499.jpg', 39, 'Yes', 'Yes'),
(11, 'Dumplings Specials', 'Chicken Dumplings with herbs from Mountains', '450.00', 'Food-Name-96.jpg', 36, 'Yes', 'Yes'),
(13, 'Smoky BBQ Pizza', 'Best Firewood Pizza in Town', '620.00', 'Food-Name-434.jpg', 38, 'Yes', 'Yes'),
(21, 'Bufallo Chicken Pizza', 'with shredded cooked chicken\r\nball mozzarella, torn blue cheese', '980.00', 'Food-Name-283.jpg', 38, 'Yes', 'Yes'),
(22, 'Chicken Ranch', 'chicken bacon ranch pizza with homemade dough, ranch dressing, mozzarella cheese, chicken, bacon, and scallions', '1200.00', 'Food_Name_4746.jpg', 38, 'Yes', 'Yes'),
(23, 'Hawaiian Pizza', 'with mozzarella cheese, pizza sauce, pineapple tidbits, and Canadian bacon', '1250.00', 'Food_Name_8514.jpg', 38, 'Yes', 'Yes'),
(24, 'Chicken Momos', ' with Steamed Chicken Dumplings b', '760.00', 'Food_Name_7065.jpg', 36, 'Yes', 'Yes'),
(25, 'Fried Vegetable MoMos ', 'Fried Vegetable MoMos with Spicy Red Chutney - BeExtraVegant', '800.00', 'Food_Name_6839.webp', 36, 'Yes', 'Yes'),
(26, 'Steamed Momos', 'Steamed Momos with (Sikkimese Dumplings', '670.00', 'Food_Name_950.jpg', 36, 'Yes', 'Yes'),
(27, 'BURGER COMBO W/CHEESE', 'BURGER COMBO W/CHEESE, FRIES CAN SODA ', '520.00', 'Food_Name_5262.webp', 39, 'Yes', 'Yes'),
(29, 'Beef And Pork', 'Hamburger  Beef And Pork |', '720.00', 'Food_Name_3562.webp', 39, 'Yes', 'Yes'),
(30, 'Eggs ', 'eggs with lemon spray', '120.00', 'Food-Name-883.jpg', 42, 'Yes', 'Yes'),
(31, 'brocolli', 'fried sauce', '200.00', 'Food_Name_2496.webp', 43, 'Yes', 'Yes'),
(32, 'bread crumbs', 'bread drumplings ', '100.00', 'Food_Name_4931.jpg', 43, 'Yes', 'Yes'),
(33, 'buffalo', 'made  with chicken', '900.00', 'Food_Name_4090.jpg', 38, 'No', 'No'),
(35, 'platter for two', 'chicken, chips, rice', '450.00', 'Food_Name_3687.jpg', 44, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(20, 'Best Burger', '350.00', 1, '350.00', '2024-11-25 18:21:43', 'delivered', 'Abraham Mwangi', '0722173238', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(21, 'Dumplings Specials', '450.00', 1, '450.00', '2024-12-04 15:15:14', 'Ordered', 'Abraham Mwangi', '07324561789', 'abrahameibrahim@gmail.com', 'thika'),
(22, 'Dumplings Specials', '450.00', 1, '450.00', '2024-12-04 15:17:19', 'Ordered', 'Abraham Mwangi', '07324561789', 'abrahameibrahim@gmail.com', 'thika'),
(23, 'Dumplings Specials', '450.00', 1, '450.00', '2024-12-09 14:18:15', 'Ordered', 'Abraham Mwangi', '3456789', 'abrahameibrahim@gmail.com', 'thika'),
(24, 'Hawaiian Pizza', '1250.00', 1, '1250.00', '2024-12-09 14:18:15', 'Ordered', 'Abraham Mwangi', '3456789', 'abrahameibrahim@gmail.com', 'thika'),
(25, 'Best Burger', '350.00', 1, '350.00', '2025-01-04 14:49:10', 'on delivery', 'isma isma isma', '12345678', 'ismaillaimangiru@gmail.com', 'wertyu'),
(26, 'Beef And Pork', '720.00', 1, '720.00', '2025-01-10 10:47:53', 'on delivery', 'Abraham Mwangi', '783456', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(27, 'Beef And Pork', '720.00', 1, '720.00', '2025-01-10 11:13:21', 'Ordered', 'Abraham Mwangi', '783456', 'abrahameibrahim@gmail.com', '342-01000 NAIROBI'),
(28, 'Beef And Pork', '720.00', 1, '720.00', '2025-01-10 13:02:42', 'Ordered', 'Abraham Mwangi', '22', 'abrahameibrahim@gmail.com', '342-01000 nrb'),
(29, 'Smoky BBQ Pizza', '6.00', 1, '6.00', '2025-01-10 13:02:42', 'Ordered', 'Abraham Mwangi', '22', 'abrahameibrahim@gmail.com', '342-01000 nrb'),
(30, 'Smoky BBQ Pizza', '6.00', 2, '12.00', '2025-01-10 13:04:33', 'cancelled', 'Abraham Mwangi', '0722173238', 'abrahameibrahim@gmail.com', '342-01000 nrb'),
(31, 'Smoky BBQ Pizza', '6.00', 2, '12.00', '2025-01-10 16:07:30', 'Ordered', 'hurr', '0707560414', 'hurr@gmail.com', 'utawala'),
(32, 'Eggs ', '120.00', 1, '120.00', '2025-01-10 16:07:30', 'Ordered', 'hurr', '0707560414', 'hurr@gmail.com', 'utawala'),
(33, 'Smoky BBQ Pizza', '620.00', 1, '620.00', '2025-01-10 16:16:15', 'Ordered', 'wambui', '0707560414', 'hurr@gmail.com', 'juja'),
(34, 'Bufallo Chicken Pizza', '980.00', 1, '980.00', '2025-01-10 16:16:15', 'Ordered', 'wambui', '0707560414', 'hurr@gmail.com', 'juja'),
(35, 'Chicken Ranch', '1200.00', 1, '1200.00', '2025-01-10 16:16:15', 'Ordered', 'wambui', '0707560414', 'hurr@gmail.com', 'juja'),
(36, 'Hawaiian Pizza', '1250.00', 1, '1250.00', '2025-01-10 16:16:15', 'Ordered', 'wambui', '0707560414', 'hurr@gmail.com', 'juja'),
(37, 'Dumplings Specials', '450.00', 1, '450.00', '2025-01-10 16:22:21', 'Ordered', 'Abraham Mwangi', '0722173238', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(38, 'Best Burger', '350.00', 1, '350.00', '2025-01-10 17:01:09', 'Ordered', 'hurr', '0707560414', 'hurr@gmail.com', 'utawala'),
(39, 'BURGER COMBO W/CHEESE', '520.00', 1, '520.00', '2025-01-10 17:01:09', 'Ordered', 'hurr', '0707560414', 'hurr@gmail.com', 'utawala'),
(40, 'Beef And Pork', '720.00', 1, '720.00', '2025-01-10 17:01:09', 'Ordered', 'hurr', '0707560414', 'hurr@gmail.com', 'utawala'),
(41, 'Best Burger', '350.00', 1, '350.00', '2025-01-10 17:18:23', 'Ordered', 'Abraham Mwangi', '0722173238', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(42, 'BURGER COMBO W/CHEESE', '520.00', 1, '520.00', '2025-01-10 17:18:23', 'Ordered', 'Abraham Mwangi', '0722173238', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(43, 'Beef And Pork', '720.00', 1, '720.00', '2025-01-10 17:18:23', 'Ordered', 'Abraham Mwangi', '0722173238', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(44, 'Best Burger', '350.00', 1, '350.00', '2025-01-10 23:32:29', 'Ordered', 'hurr', '0707560414', 'hurr@gmail.com', 'utawala'),
(45, 'BURGER COMBO W/CHEESE', '520.00', 1, '520.00', '2025-01-10 23:32:29', 'Ordered', 'hurr', '0707560414', 'hurr@gmail.com', 'utawala'),
(46, 'Beef And Pork', '720.00', 1, '720.00', '2025-01-10 23:32:29', 'Ordered', 'hurr', '0707560414', 'hurr@gmail.com', 'utawala'),
(47, 'Eggs ', '120.00', 1, '120.00', '2025-01-10 23:34:25', 'Ordered', 'Abraham Mwangi', '0722128533', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(48, 'Dumplings Specials', '450.00', 1, '450.00', '2025-03-29 22:08:05', 'Ordered', 'late late', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(49, 'BURGER COMBO W/CHEESE', '520.00', 1, '520.00', '2025-03-29 22:08:05', 'Ordered', 'late late', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(50, 'Bufallo Chicken Pizza', '980.00', 1, '980.00', '2025-03-29 22:08:05', 'Ordered', 'late late', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(51, 'Dumplings Specials', '450.00', 2, '900.00', '2025-03-29 22:24:45', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(52, 'BURGER COMBO W/CHEESE', '520.00', 1, '520.00', '2025-03-29 22:24:45', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(53, 'Bufallo Chicken Pizza', '980.00', 1, '980.00', '2025-03-29 22:24:45', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(54, 'Smoky BBQ Pizza', '620.00', 1, '620.00', '2025-03-29 22:24:45', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(55, 'Dumplings Specials', '450.00', 2, '900.00', '2025-04-15 20:24:09', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(56, 'BURGER COMBO W/CHEESE', '520.00', 1, '520.00', '2025-04-15 20:24:09', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(57, 'Bufallo Chicken Pizza', '980.00', 1, '980.00', '2025-04-15 20:24:09', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(58, 'Smoky BBQ Pizza', '620.00', 1, '620.00', '2025-04-15 20:24:09', 'ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(59, 'Dumplings Specials', '450.00', 2, '900.00', '2025-04-15 21:02:41', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(60, 'BURGER COMBO W/CHEESE', '520.00', 1, '520.00', '2025-04-15 21:02:41', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(61, 'Bufallo Chicken Pizza', '980.00', 1, '980.00', '2025-04-15 21:02:41', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(62, 'Dumplings Specials', '450.00', 2, '900.00', '2025-04-15 21:37:13', 'Ordered', 'Abraham Mwangi', '254796748431', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(63, 'BURGER COMBO W/CHEESE', '520.00', 1, '520.00', '2025-04-15 21:37:13', 'Ordered', 'Abraham Mwangi', '254796748431', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(64, 'Bufallo Chicken Pizza', '980.00', 1, '980.00', '2025-04-15 21:37:13', 'Ordered', 'Abraham Mwangi', '254796748431', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(65, 'Dumplings Specials', '450.00', 2, '900.00', '2025-04-17 00:01:41', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(66, 'BURGER COMBO W/CHEESE', '520.00', 1, '520.00', '2025-04-17 00:01:41', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(67, 'Bufallo Chicken Pizza', '980.00', 1, '980.00', '2025-04-17 00:01:41', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(68, 'BURGER COMBO W/CHEESE', '520.00', 1, '520.00', '2025-04-23 20:20:56', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(69, 'BURGER COMBO W/CHEESE', '520.00', 1, '520.00', '2025-04-23 23:53:50', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(70, 'Smoky BBQ Pizza', '6.00', 1, '6.00', '2025-04-23 23:53:50', 'ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(71, 'BURGER COMBO W/CHEESE', '520.00', 2, '1040.00', '2025-04-23 23:56:15', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(72, 'BURGER COMBO W/CHEESE', '520.00', 2, '1040.00', '2025-04-24 00:26:42', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(73, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-24 00:26:42', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(74, 'BURGER COMBO W/CHEESE', '520.00', 2, '1040.00', '2025-04-24 01:32:32', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(75, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-24 01:32:32', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(76, 'BURGER COMBO W/CHEESE', '520.00', 2, '1040.00', '2025-04-24 01:35:04', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(78, 'BURGER COMBO W/CHEESE', '520.00', 2, '1040.00', '2025-04-24 01:47:58', 'on delivery', 'luxe', '0707560414', 'luxe@gmail.com', '319-00100 Nairobi'),
(79, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-24 01:47:58', 'on delivery', 'luxe', '0707560414', 'luxe@gmail.com', '319-00100 Nairobi'),
(80, 'BURGER COMBO W/CHEESE', '520.00', 2, '1040.00', '2025-04-24 03:29:16', 'cancelled', 'luxe', '0707560414', 'luxe@gmail.com', '342-01000 Thika'),
(81, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-24 03:29:16', 'ordered', 'luxe', '0707560414', 'luxe@gmail.com', '342-01000 Thika'),
(82, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-24 17:16:39', 'delivered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(83, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-24 18:39:16', 'delivered', 'luxe', '0707560414', 'luxe@gmail.com', '342-01000 Thika'),
(84, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-24 19:39:40', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(85, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-24 19:39:51', 'delivered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(86, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-24 20:04:29', 'delivered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(87, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-25 02:31:07', 'Ordered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(88, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-25 02:33:03', 'delivered', 'luxe', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(89, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-25 02:51:25', 'delivered', 'susan', '0796748431', 'njokisuz17@gmail.com', '342-01000 Thika'),
(90, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-25 03:33:40', 'delivered', 'Abraham Mwangi', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika'),
(91, 'Dumplings Specials', '450.00', 1, '450.00', '2025-04-25 15:18:51', 'delivered', 'luxe', '0728251935', 'abrahameibrahim@gmail.com', '342-01000 Thika');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `contact`) VALUES
(1, 'qubeta', 'ibrahim@gmail.com', '$2y$10$lwsOzbyy.QvraQ5GQtBjM..w95oMzTwHDcjMPOGAGVz7.yODcVore', '783456'),
(2, 'qubeta', 'abrahameibrahim@gmail.com', '$2y$10$KkVrDFa3lhcQvimngjOoz.2ujyFWWtTVJ85NaWd2W8c0W9tDGzAN6', '783456'),
(3, 'qubeta', 'abrahameibrahim@gmail.com', '$2y$10$RJvfWdikCr4OPHjArEVYaeq65RILHMLPZloKLZolZZwRRvjs6.3p2', '783456'),
(4, 'qubeta', 'abrahameibrahim@gmail.com', '$2y$10$1f4N7DNT9T.pyLegsH5cD.swTcW3L9LUIOxFqALbIlRy3jVHXW/uK', '783456'),
(5, 'qubeta', 'ibrahim@gmail.com', '$2y$10$kQw0mLWwivV9Zifgi8DVjuZw2dg0gf24rH1d6PhOGOFni6mAjJYpy', '783456'),
(6, 'qubeta', 'ibrahim@gmail.com', '$2y$10$2.UIZ8eBklZ7ITaBpAjZbeysLF44IlsURCavgEzVae7ohReXiU1jC', '783456'),
(7, 'qubeta', 'ibrahim@gmail.com', '$2y$10$22zwDV43zLd3FsXKPe08GeVpSEUn11MNKtvjjzCO79x7wKUy1HnpG', '783456'),
(8, 'qubeta', 'ibrahim@gmail.com', '$2y$10$LaYQw/pibCVcYow0UuV9cOU2/Lv5eVph6FjwPr73kgr/2loj2lqPq', '783456'),
(9, 'qubeta', 'ibrahim@gmail.com', '$2y$10$qDja8qsTGHzzlKLDEdNp.OqDb3uWdj9YBepAqW7ObXFduVY2bEXf2', '783456'),
(10, 'qubeta', 'abrahameibrahim@gmail.com', '$2y$10$USkZzgIYn/J5Vjtitj7OE.cuWabfF6B8n4oU4ZUPrUlIwLntK/XDG', '783456'),
(11, 'qubeta', 'abrahameibrahim@gmail.com', '$2y$10$0oIEO4bYN8nx6EKiTj8iEuxdaRmRNRXgnf3TnqcbDmVi5wXZDkh0O', '783456'),
(12, 'ibrahim', 'rahim@gmail.com', '$2y$10$RMNqd3/ZgRLO26aPagnY1.Q/vUJdEV2SPX8AzDfeFYC27YwxDV7jG', '0722173238'),
(13, 'ibrahim', 'rahim@gmail.com', '$2y$10$uJGw9bTuSk/GVZC.UvkGAujghwdfEYoQ/at0JFvtDu/YWXJNIJium', '0722128533'),
(14, 'qubeta', 'abrahameibrahim@gmail.com', '$2y$10$ASb.Dh9FKPJhxukGuZpAOu0SujcxnR9fHKWqdXanr3/x2kzRScfdu', '783456'),
(15, 'Rahim', 'abrahameibrahim@gmail.com', '$2y$10$ibzvIMfQ9R2GmO1Mr6Re9O5tr5zgug8DBq.Z1e1GhqLpE2zdkCr76', '0707908789'),
(16, 'Rahim', 'mwa@gmail.com', '$2y$10$/isqQx5e6Yq6o1y3LhNGauvB3JyyXoOI7A.ultle9qyHNC2sxEO5.', '0745678987'),
(17, 'Rahim', 'abrahameibrahim@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0712345678'),
(18, 'obeyia', 'o@g.com', '81dc9bdb52d04dc20036dbd8313ed055', '234567890'),
(19, 'Rahim', 'r@g.com', '81dc9bdb52d04dc20036dbd8313ed055', '098765432'),
(20, 'rahim', 'abrahameibrahim@gmail.com', '$2y$10$9rcUKQODpwA7YsJUeLcWi.d3CW3sKj8fuTTL/Fvdc1rTGYpnBQDdm', '07324561789'),
(21, 'obeyia', 'o@g.com', '1234', '074567890-'),
(22, 'mimo', 'a@gmail.com', '$2y$10$IR5TkzWeHEy/HanOQS6XpunqMGFx9vfPe0VGWpqNweEKaynh3Gr1y', '1234545'),
(23, 'abu', 'ilaimangiru@gmail.com', '$2y$10$6uV3O3qeN3PT9FEPHfEph.Y7lq.vwR5yHnHwqPB2jOQsRtkboCn8W', '0987654321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_feedback`
--
ALTER TABLE `customer_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
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
-- AUTO_INCREMENT for table `customer_feedback`
--
ALTER TABLE `customer_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
