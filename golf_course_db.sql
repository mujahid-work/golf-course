-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2020 at 06:00 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u289140853_golfcourseios`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins_tbl`
--

CREATE TABLE `admins_tbl` (
  `id` int(10) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins_tbl`
--

INSERT INTO `admins_tbl` (`id`, `full_name`, `email`, `password`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Parker Rosan', 'parkerrosan001@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '12345678', '2020-07-16 13:22:58', '2020-07-29 11:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `areas_tbl`
--

CREATE TABLE `areas_tbl` (
  `id` int(10) NOT NULL,
  `area_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas_tbl`
--

INSERT INTO `areas_tbl` (`id`, `area_title`, `area_status`, `area_image`, `created_at`, `updated_at`) VALUES
(1, 'Course', 'Active', 'images.png', '2020-07-28 08:29:27', '2020-07-29 06:48:18'),
(3, 'Main Bar', 'Active', 'images_(4).jfif', '2020-07-29 06:49:24', '0000-00-00 00:00:00'),
(4, 'Harry\'s', 'Active', 'images_(4)1.jfif', '2020-07-29 06:49:42', '0000-00-00 00:00:00'),
(5, 'Restaurant', 'Active', 'Restaurants-512.webp', '2020-07-29 06:50:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items_tbl`
--

CREATE TABLE `cart_items_tbl` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `item_id` int(10) DEFAULT NULL,
  `item_price` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_quantity` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_total` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items_tbl`
--

INSERT INTO `cart_items_tbl` (`id`, `user_id`, `item_id`, `item_price`, `item_quantity`, `item_total`, `created_at`, `updated_at`) VALUES
(14, 6, 8, '35', '2', '70', '2020-07-27 06:24:46', '0000-00-00 00:00:00'),
(20, 6, 14, '10', '2', '20', '2020-07-27 10:55:07', '0000-00-00 00:00:00'),
(21, 27, 19, '30', '40', '1200', '2020-07-27 10:59:33', '2020-07-27 13:23:00'),
(22, 27, 8, '35', '10', '350', '2020-07-27 11:01:56', '2020-07-27 11:02:05'),
(23, 27, 15, '34', '36', '1224', '2020-07-27 11:20:10', '2020-07-27 11:21:37'),
(24, 27, 11, '20', '13', '260', '2020-07-27 11:20:56', '0000-00-00 00:00:00'),
(25, 27, 5, '25', '10', '250', '2020-07-27 11:22:09', '2020-07-27 12:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `items_tbl`
--

CREATE TABLE `items_tbl` (
  `id` int(10) NOT NULL,
  `main_catg_id` int(10) NOT NULL,
  `sub_catg_id` int(10) NOT NULL,
  `item_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_price` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_availability` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items_tbl`
--

INSERT INTO `items_tbl` (`id`, `main_catg_id`, `sub_catg_id`, `item_title`, `item_description`, `item_price`, `item_availability`, `item_status`, `item_image`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Brown Ale', 'Test short description', '10', 'Yes', 'Active', 'download_(8).jfif', '2020-07-20 16:58:46', '2020-07-22 10:42:17'),
(2, 2, 1, 'Porter Beer', 'Test short description.', '20', 'Yes', 'Active', '18028da3e35d2cdbcfd8d2b9d5fcafea.png', '2020-07-20 17:26:26', '2020-07-22 10:43:59'),
(3, 2, 1, 'Wheat Beer', 'Test short description.', '30', 'Yes', 'Active', 'download_(9).jfif', '2020-07-20 18:02:11', '2020-07-22 10:46:09'),
(5, 2, 2, 'White Wine', 'test short description.', '25', 'Yes', 'Active', 'white_wine.jpg', '2020-07-23 07:04:45', '2020-07-23 07:09:14'),
(6, 2, 2, 'Red Wine', 'Test short description.', '30', 'Yes', 'Active', 'red_wine.jpg', '2020-07-23 07:07:08', '2020-07-23 07:09:32'),
(7, 2, 2, 'Rose Wine', 'Test short description.', '35', 'Yes', 'Active', 'images_(1).jfif', '2020-07-23 07:11:23', '0000-00-00 00:00:00'),
(8, 2, 3, 'Whiskey', 'Test short description.', '35', 'Yes', 'Active', 'download_(10).jfif', '2020-07-23 07:13:49', '0000-00-00 00:00:00'),
(9, 2, 3, 'Vodka', 'Test short description.', '45', 'Yes', 'Active', 'download_(11).jfif', '2020-07-23 07:15:03', '0000-00-00 00:00:00'),
(10, 2, 3, 'Tequila', 'Test short description', '50', 'Yes', 'Active', 'download_(12).jfif', '2020-07-23 07:16:09', '0000-00-00 00:00:00'),
(11, 1, 6, 'Macaroni salad', 'Test short description.', '20', 'Yes', 'Active', '345px-Macaroni_salad.jpg', '2020-07-24 12:07:31', '0000-00-00 00:00:00'),
(12, 1, 6, 'Pasta salad', 'Test short description.', '50', 'Yes', 'Active', '375px-Pasta_salad_closeup.jfif', '2020-07-24 12:09:16', '0000-00-00 00:00:00'),
(13, 1, 6, 'French fries', 'Test short description.', '10', 'Yes', 'Active', 'Fries_2.jpg', '2020-07-24 12:10:09', '0000-00-00 00:00:00'),
(14, 1, 6, 'Potato salad', 'Test short description.', '10', 'Yes', 'Active', '330px-Potato_salad_with_egg_and_mayonnaise.jpg', '2020-07-24 12:10:56', '0000-00-00 00:00:00'),
(15, 1, 5, 'Beaf Steak', 'Test short description.', '34', 'Yes', 'Active', 'download_(13).jfif', '2020-07-24 12:13:49', '0000-00-00 00:00:00'),
(16, 1, 5, 'Sushi', 'Test short description.', '50', 'Yes', 'Active', 'download_(14).jfif', '2020-07-24 12:15:16', '0000-00-00 00:00:00'),
(17, 1, 5, 'Buffalo wing', 'Test short description.', '60', 'Yes', 'Active', 'download_(15).jfif', '2020-07-24 12:16:32', '2020-07-24 12:18:07'),
(18, 1, 5, 'Chicken Thighs', 'Test short description.', '45', 'Yes', 'Active', 'download_(16).jfif', '2020-07-24 12:17:50', '0000-00-00 00:00:00'),
(19, 1, 7, 'Banana Pudding', 'Test short description', '30', 'Yes', 'Active', 'landscape-1520794644-640-perfectbananapudding3-1.jpg', '2020-07-24 12:20:19', '0000-00-00 00:00:00'),
(20, 1, 7, 'Margarita Cupcakes', 'Test short description.', '25', 'Yes', 'Active', 'delish-margarita-cupcakes-horizontal-1521140944.jpg', '2020-07-24 12:21:09', '0000-00-00 00:00:00'),
(21, 1, 7, 'Brownie', 'Test short description.', '10', 'Yes', 'Active', 'brownies-horizontal-1547669250.png', '2020-07-24 12:22:13', '0000-00-00 00:00:00'),
(22, 1, 7, 'Cheesecake', 'Test short description.', '55', 'Yes', 'Active', '1510699995-delish-pecan-pie-cheesecake-still1-1538060872.jpg', '2020-07-24 12:23:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `main_categories_tbl`
--

CREATE TABLE `main_categories_tbl` (
  `id` int(10) NOT NULL,
  `main_catg_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_catg_status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_catg_image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_categories_tbl`
--

INSERT INTO `main_categories_tbl` (`id`, `main_catg_title`, `main_catg_status`, `main_catg_image`, `created_at`, `updated_at`) VALUES
(1, 'Foods', 'Active', 'images.jfif', '2020-07-20 14:11:11', '0000-00-00 00:00:00'),
(2, 'Drinks', 'Active', 'download.png', '2020-07-20 14:11:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_tbl`
--

CREATE TABLE `notifications_tbl` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `order_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications_tbl`
--

INSERT INTO `notifications_tbl` (`id`, `user_id`, `order_no`, `description`, `is_read`, `created_at`, `updated_at`) VALUES
(3, 15, 'ord-1596101840', 'I have placed an order by ID <br> <b>ord-1596101840</b>, please have a look.', 'No', '2020-07-30 09:37:22', '2020-08-04 07:03:32'),
(4, 15, 'ord-1596101428', 'I have placed an order by ID <br> <b>ord-1596101428</b>, please have a look.', 'No', '2020-07-30 10:47:03', '2020-08-04 07:03:41'),
(6, 15, 'ord-1595834474', 'I have placed an order by ID <br> <b>ord-1595834474</b>, please have a look.', 'No', '2020-07-30 11:46:52', '2020-08-04 07:03:45'),
(7, 15, 'ord-1595495553', 'I have placed an order by ID <br> <b>ord-1595495553</b>, please have a look.', 'No', '2020-07-30 11:48:32', '2020-08-04 07:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_items_tbl`
--

CREATE TABLE `sales_order_items_tbl` (
  `id` int(10) NOT NULL,
  `order_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` int(10) DEFAULT NULL,
  `item_price` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_quantity` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_total` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_order_items_tbl`
--

INSERT INTO `sales_order_items_tbl` (`id`, `order_no`, `item_id`, `item_price`, `item_quantity`, `item_total`, `created_at`, `updated_at`) VALUES
(1, 'ord-1595495553', 2, '20', '3', '60', '2020-07-23 09:12:33', '0000-00-00 00:00:00'),
(3, 'ord-1595496012', 3, '20', '3', '60', '2020-07-23 09:20:13', '2020-07-27 10:57:53'),
(5, 'ord-1595506918', 2, '20', '3', '60', '2020-07-23 12:21:59', '0000-00-00 00:00:00'),
(6, 'ord-1595507532', 2, '20', '3', '60', '2020-07-23 12:32:13', '0000-00-00 00:00:00'),
(7, 'ord-1595507868', 3, '20', '3', '60', '2020-07-23 12:37:48', '2020-07-27 10:58:58'),
(8, 'ord-1595834474', 2, '20', '3', '60', '2020-07-27 07:21:16', '0000-00-00 00:00:00'),
(11, 'ord-1596010731', 2, '20', '5', '100', '2020-07-29 08:18:53', '0000-00-00 00:00:00'),
(12, 'ord-1596101428', 2, '20', '1', '20', '2020-07-30 09:30:29', '0000-00-00 00:00:00'),
(13, 'ord-1596101840', 2, '20', '2', '40', '2020-07-30 09:37:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_tbl`
--

CREATE TABLE `sales_order_tbl` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `area_id` int(10) DEFAULT NULL,
  `seat_type_id` int(10) DEFAULT NULL,
  `seat_id` int(10) DEFAULT NULL,
  `order_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `discount_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'amount',
  `discount_amount` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `tax` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `tax_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'amount',
  `tax_amount` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `grand_total` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_order_tbl`
--

INSERT INTO `sales_order_tbl` (`id`, `user_id`, `area_id`, `seat_type_id`, `seat_id`, `order_no`, `sub_total`, `discount`, `discount_type`, `discount_amount`, `tax`, `tax_type`, `tax_amount`, `grand_total`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 15, 3, 1, 1, 'ord-1595495553', '60', '0', 'amount', '0', '0', 'amount', '0', '60', 'Submitted', '2020-07-23 09:12:33', '2020-07-30 07:56:48'),
(3, 6, 3, 2, 9, 'ord-1595496012', '60', '0', 'amount', '0', '0', 'amount', '0', '60', 'Accepted', '2020-07-23 09:20:12', '2020-07-30 07:56:18'),
(5, 15, 3, 1, 3, 'ord-1595506918', '60', '0', 'amount', '0', '0', 'amount', '0', '60', 'Ready', '2020-07-23 12:21:59', '2020-07-29 12:32:39'),
(6, 15, 3, 1, 3, 'ord-1595507532', '60', '0', 'amount', '0', '0', 'amount', '0', '60', 'Ready', '2020-07-23 12:32:12', '2020-07-30 06:02:17'),
(7, 15, 1, 1, 3, 'ord-1595507868', '60', '0', 'amount', '0', '0', 'amount', '0', '60', 'Accepted', '2020-07-23 12:37:48', '2020-08-04 10:57:36'),
(8, 6, 4, 1, 3, 'ord-1595834474', '60', '10', 'percentage', '6', '20', 'percentage', '12', '66', 'Accepted', '2020-07-27 07:21:16', '2020-08-04 13:35:12'),
(11, 15, 5, 1, 3, 'ord-1596010731', '100', '0', 'amount', '0', '0', 'amount', '0', '100', 'Accepted', '2020-07-29 08:18:53', '2020-08-04 07:51:44'),
(12, 15, 1, 5, 3, 'ord-1596101428', '20', '0', 'amount', '0', '0', 'amount', '0', '20', 'Accepted', '2020-07-30 09:30:29', '2020-08-04 13:34:10'),
(13, 15, 1, 5, 3, 'ord-1596101840', '40', '0', 'amount', '0', '0', 'amount', '0', '40', 'Accepted', '2020-07-30 09:37:21', '2020-08-04 13:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `seats_tbl`
--

CREATE TABLE `seats_tbl` (
  `id` int(10) NOT NULL,
  `seat_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_id` int(10) DEFAULT NULL,
  `seat_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats_tbl`
--

INSERT INTO `seats_tbl` (`id`, `seat_no`, `area_id`, `seat_type`, `created_at`, `updated_at`) VALUES
(1, 'Seat-1', 1, '1', '2020-07-20 07:03:00', '2020-07-28 10:12:49'),
(2, 'Seat-2', 1, '1', '2020-07-20 07:03:00', '2020-07-28 10:12:49'),
(3, 'Seat-3', 1, '1', '2020-07-20 07:03:38', '2020-07-28 10:12:49'),
(4, 'Seat-4', 1, '1', '2020-07-20 07:03:38', '2020-07-28 10:12:49'),
(5, 'Seat-5', 1, '1', '2020-07-20 07:04:05', '2020-07-28 10:12:49'),
(6, 'Seat-6', 1, '2', '2020-07-20 07:04:05', '2020-07-29 07:44:30'),
(7, 'Seat-7', 1, '2', '2020-07-21 06:31:39', '2020-07-29 07:46:16'),
(8, 'Seat-8', 1, '2', '2020-07-21 06:31:39', '2020-07-28 10:12:49'),
(9, 'Seat-9', 1, '2', '2020-07-21 06:35:31', '2020-07-28 10:12:49'),
(10, 'Seat-10', 1, '2', '2020-07-21 06:35:31', '2020-07-28 10:12:49'),
(11, 'Seat-11', 1, '5', '2020-07-21 06:36:19', '2020-07-29 09:09:29'),
(12, 'Seat-12', 1, '5', '2020-07-21 06:36:19', '2020-07-29 09:09:43'),
(13, 'Seat-13', 1, '5', '2020-07-21 06:36:19', '2020-07-29 09:10:03'),
(14, 'Seat-14', 1, '5', '2020-07-21 06:36:19', '2020-07-29 09:10:19'),
(15, 'Seat-15', 1, '5', '2020-07-21 06:36:19', '2020-07-28 10:12:49'),
(16, 'Seat-16', 5, '14', '2020-07-21 06:49:54', '2020-07-29 09:10:59'),
(17, 'Seat-17', 5, '14', '2020-07-21 06:49:54', '2020-07-29 09:12:03'),
(18, 'Seat-18', 5, '14', '2020-07-21 06:51:05', '2020-07-29 09:12:16'),
(19, 'Seat-19', 5, '14', '2020-07-21 06:51:05', '2020-07-29 09:12:28'),
(21, 'Seat-20', 5, '14', '2020-07-23 07:19:38', '2020-07-29 09:12:49'),
(23, 'Seat-21', 5, '15', '2020-07-29 09:14:13', '2020-07-29 09:14:55'),
(24, 'Seat-22', 5, '15', '2020-07-29 09:14:41', '0000-00-00 00:00:00'),
(25, 'Seat-23', 5, '15', '2020-07-29 09:15:12', '0000-00-00 00:00:00'),
(26, 'Seat-24', 5, '15', '2020-07-29 09:15:28', '2020-07-29 09:15:45'),
(27, 'Seat-25', 5, '15', '2020-07-29 09:16:03', '0000-00-00 00:00:00'),
(28, 'Seat-26', 5, '16', '2020-07-29 09:16:29', '0000-00-00 00:00:00'),
(29, 'Seat-27', 5, '16', '2020-07-29 09:16:44', '0000-00-00 00:00:00'),
(30, 'Seat-28', 5, '16', '2020-07-29 09:17:02', '0000-00-00 00:00:00'),
(31, 'Seat-29', 5, '16', '2020-07-29 09:17:25', '0000-00-00 00:00:00'),
(32, 'Seat-30', 5, '16', '2020-07-29 09:17:48', '0000-00-00 00:00:00'),
(33, 'Seat-31', 4, '17', '2020-07-29 09:18:12', '0000-00-00 00:00:00'),
(34, 'Seat-32', 4, '17', '2020-07-29 09:18:29', '0000-00-00 00:00:00'),
(35, 'Seat-33', 4, '17', '2020-07-29 09:18:44', '0000-00-00 00:00:00'),
(36, 'Seat-34', 4, '17', '2020-07-29 09:18:59', '2020-07-29 09:19:14'),
(37, 'Seat-35', 4, '17', '2020-07-29 09:19:38', '0000-00-00 00:00:00'),
(38, 'Seat-36', 4, '18', '2020-07-29 09:19:58', '0000-00-00 00:00:00'),
(39, 'Seat-37', 4, '18', '2020-07-29 09:20:19', '0000-00-00 00:00:00'),
(40, 'Seat-38', 4, '18', '2020-07-29 09:20:45', '0000-00-00 00:00:00'),
(41, 'Seat-39', 4, '18', '2020-07-29 09:21:02', '0000-00-00 00:00:00'),
(42, 'Seat-40', 4, '18', '2020-07-29 09:21:24', '0000-00-00 00:00:00'),
(43, 'Seat-41', 4, '19', '2020-07-29 09:22:02', '0000-00-00 00:00:00'),
(44, 'Seat-42', 4, '19', '2020-07-29 09:22:35', '0000-00-00 00:00:00'),
(45, 'Seat-43', 4, '19', '2020-07-29 09:23:33', '0000-00-00 00:00:00'),
(46, 'Seat-44', 4, '19', '2020-07-29 09:23:49', '0000-00-00 00:00:00'),
(47, 'Seat-45', 4, '19', '2020-07-29 09:24:09', '0000-00-00 00:00:00'),
(48, 'Seat-46', 3, '13', '2020-07-29 09:24:40', '0000-00-00 00:00:00'),
(49, 'Seat-47', 3, '13', '2020-07-29 09:25:03', '0000-00-00 00:00:00'),
(50, 'Seat-48', 3, '13', '2020-07-29 09:25:31', '0000-00-00 00:00:00'),
(51, 'Seat-49', 3, '13', '2020-07-29 09:25:47', '0000-00-00 00:00:00'),
(52, 'Seat-50', 3, '13', '2020-07-29 09:26:05', '0000-00-00 00:00:00'),
(53, 'Seat-51', 3, '11', '2020-07-29 09:26:33', '0000-00-00 00:00:00'),
(54, 'Seat-52', 3, '11', '2020-07-29 09:26:51', '0000-00-00 00:00:00'),
(55, 'Seat-53', 3, '11', '2020-07-29 09:27:11', '0000-00-00 00:00:00'),
(56, 'Seat-54', 3, '11', '2020-07-29 09:27:28', '0000-00-00 00:00:00'),
(57, 'Seat-55', 3, '11', '2020-07-29 09:28:01', '0000-00-00 00:00:00'),
(58, 'Seat-56', 3, '12', '2020-07-29 09:28:34', '0000-00-00 00:00:00'),
(59, 'Seat-57', 3, '12', '2020-07-29 09:29:07', '0000-00-00 00:00:00'),
(60, 'Seat-58', 3, '12', '2020-07-29 09:29:25', '0000-00-00 00:00:00'),
(61, 'Seat-59', 3, '12', '2020-07-29 09:29:46', '0000-00-00 00:00:00'),
(62, 'Seat-60', 3, '12', '2020-07-29 09:30:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `seat_types_tbl`
--

CREATE TABLE `seat_types_tbl` (
  `id` int(10) NOT NULL,
  `area_id` int(10) DEFAULT NULL,
  `seat_type_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seat_type_status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seat_type_image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seat_types_tbl`
--

INSERT INTO `seat_types_tbl` (`id`, `area_id`, `seat_type_title`, `seat_type_status`, `seat_type_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Course\'s Bar Seats', 'Active', 'barchair', '2020-07-22 12:54:42', '2020-07-29 07:18:12'),
(2, 1, 'Course\'s TV Seats', 'Active', 'tvchair', '2020-07-22 12:55:24', '2020-07-29 07:18:17'),
(5, 1, 'Course\'s Garden Seats', 'Active', 'gardenchair', '2020-07-23 07:42:02', '2020-07-29 07:18:22'),
(11, 3, 'Main Bar\'s TV Seats', 'Active', 'tvchair', '2020-07-29 07:18:02', '0000-00-00 00:00:00'),
(12, 3, 'Main Bar\'s Bar Seats', 'Active', 'barchair', '2020-07-29 07:18:02', '0000-00-00 00:00:00'),
(13, 3, 'Main Bar\'s Garden Seats', 'Active', 'gardenchair', '2020-07-29 07:18:02', '0000-00-00 00:00:00'),
(14, 5, 'Restaurant\'s Bar Seats', 'Active', 'barchair', '2020-07-29 07:20:00', '0000-00-00 00:00:00'),
(15, 5, 'Restaurant\'s TV Seats', 'Active', 'tvchair', '2020-07-29 07:20:00', '0000-00-00 00:00:00'),
(16, 5, 'Restaurant\'s Garden Seats', 'Active', 'tvchair', '2020-07-29 07:20:00', '0000-00-00 00:00:00'),
(17, 4, 'Harry\'s Bar Seats', 'Active', 'barchair', '2020-07-29 07:26:32', '0000-00-00 00:00:00'),
(18, 4, 'Harry\'s Garden Seats', 'Active', 'gardenchair', '2020-07-29 07:26:32', '0000-00-00 00:00:00'),
(19, 4, 'Harry\'s TV Seats', 'Active', 'tvchair', '2020-07-29 07:26:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories_tbl`
--

CREATE TABLE `sub_categories_tbl` (
  `id` int(10) NOT NULL,
  `main_catg_id` int(10) DEFAULT NULL,
  `sub_catg_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_catg_status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_catg_image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories_tbl`
--

INSERT INTO `sub_categories_tbl` (`id`, `main_catg_id`, `sub_catg_title`, `sub_catg_status`, `sub_catg_image`, `created_at`, `updated_at`) VALUES
(1, 2, 'Beers', 'Active', 'download_(5).jfif', '2020-07-20 14:15:43', '2020-07-22 10:33:58'),
(2, 2, 'Wines', 'Active', 'download_(6).jfif', '2020-07-20 14:16:29', '2020-07-22 10:38:45'),
(3, 2, 'Spirits', 'Active', 'download_(7).jfif', '2020-07-20 14:17:09', '2020-07-22 10:40:13'),
(5, 1, 'Mains', 'Active', 'Afghan_cuisine.jpg', '2020-07-20 14:26:01', '2020-07-24 12:18:36'),
(6, 1, 'Sides', 'Active', 'images_(2).jfif', '2020-07-20 14:26:47', '2020-07-24 12:05:30'),
(7, 1, 'Desserts', 'Active', '173px-Desserts.jpg', '2020-07-20 14:27:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `id` int(10) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `tokken` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`id`, `full_name`, `email`, `password`, `phone`, `status`, `tokken`, `created_at`, `updated_at`) VALUES
(6, 'Bryan', 'bryan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+123456789', 'Active', '179bbea6121ca9dddcc3c6dc2efc2416', '2020-07-16 10:59:50', '2020-07-29 12:06:27'),
(15, 'Parker', 'parker@email.com', 'e10adc3949ba59abbe56e057f20f883e', '+123456789', 'Active', 'a56af0a01e137f61a44a93398195f5db', '2020-07-20 06:41:28', '2020-07-29 12:15:54'),
(16, 'David', 'david@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+12345566', 'Active', NULL, '2020-07-20 06:48:39', '2020-07-29 12:06:27'),
(19, 'james', 'james@gmail.om', '827ccb0eea8a706c4c34a16891f84e7b', '+12345678', 'Active', NULL, '2020-07-20 07:08:16', '2020-07-29 12:06:27'),
(20, 'Alice', 'alice@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+1224252', 'Active', NULL, '2020-07-20 07:10:45', '2020-07-29 12:06:27'),
(21, 'Niki', 'niki@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+1223342534', 'Active', NULL, '2020-07-20 07:20:35', '2020-07-29 12:06:27'),
(22, 'Tom', 'tom@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+12345', 'Active', NULL, '2020-07-20 07:26:00', '2020-07-29 12:06:27'),
(24, 'Rosan', 'roan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+122343423', 'Active', NULL, '2020-07-20 07:30:22', '2020-07-29 12:06:27'),
(25, 'Wells', 'wells@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+13124342', 'Active', NULL, '2020-07-20 07:31:58', '2020-07-29 12:06:27'),
(26, 'Bredan', 'bredan@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+13342353', 'Active', NULL, '2020-07-20 07:46:19', '2020-07-29 12:06:27'),
(27, 'James', 'james@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+13143425', 'Active', '142576945dc352544a56797f26c6be7c', '2020-07-20 07:54:11', '2020-08-04 14:39:33'),
(28, 'James', 'james1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+1985943', 'Active', '8afd1b0c7298a4c16782cae56f723399', '2020-07-20 09:26:20', '2020-07-29 12:06:27'),
(29, 'James', 'james2@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+1985943', 'Active', '8744894d913adf4f41d4fd4f7278a2af', '2020-07-20 09:27:56', '2020-07-29 12:06:27'),
(30, 'James', 'james3@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+1985943', 'Active', '7bd64d4da2bd28c795e47e46fc2ceb78', '2020-07-20 09:28:26', '2020-07-29 12:06:27'),
(31, 'Alice', 'alice1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '+11234', 'Active', '649872438ae77fd7ec5737e9bdb8317b', '2020-07-20 09:30:43', '2020-07-30 07:16:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins_tbl`
--
ALTER TABLE `admins_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas_tbl`
--
ALTER TABLE `areas_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items_tbl`
--
ALTER TABLE `cart_items_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_tbl`
--
ALTER TABLE `items_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_categories_tbl`
--
ALTER TABLE `main_categories_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_tbl`
--
ALTER TABLE `notifications_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_order_items_tbl`
--
ALTER TABLE `sales_order_items_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_order_tbl`
--
ALTER TABLE `sales_order_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats_tbl`
--
ALTER TABLE `seats_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seat_types_tbl`
--
ALTER TABLE `seat_types_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories_tbl`
--
ALTER TABLE `sub_categories_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins_tbl`
--
ALTER TABLE `admins_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `areas_tbl`
--
ALTER TABLE `areas_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_items_tbl`
--
ALTER TABLE `cart_items_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `items_tbl`
--
ALTER TABLE `items_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `main_categories_tbl`
--
ALTER TABLE `main_categories_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications_tbl`
--
ALTER TABLE `notifications_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sales_order_items_tbl`
--
ALTER TABLE `sales_order_items_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sales_order_tbl`
--
ALTER TABLE `sales_order_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `seats_tbl`
--
ALTER TABLE `seats_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `seat_types_tbl`
--
ALTER TABLE `seat_types_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sub_categories_tbl`
--
ALTER TABLE `sub_categories_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
