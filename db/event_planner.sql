-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2023 at 09:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `event_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `total_price` int(100) NOT NULL,
  `discount_amount` int(200) NOT NULL,
  `total_bill` int(25) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `event_id`, `user_id`, `total_price`, `discount_amount`, `total_bill`, `booking_date`) VALUES
(86, 2, 5, 5432, 652, 4780, '2023-09-02 10:44:07'),
(87, 3, 5, 5005, 0, 5005, '2023-09-02 10:52:19'),
(89, 5, 5, 800, 352, 448, '2023-09-02 19:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(25) NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'Tour'),
(2, 'Educational Conference'),
(3, 'Workshop'),
(4, 'Formal'),
(5, 'Informal');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `event_id` int(25) NOT NULL,
  `coupon_code` varchar(250) NOT NULL,
  `discount_amount` int(50) NOT NULL,
  `expiration_date` date NOT NULL,
  `usage_limit` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `event_id`, `coupon_code`, `discount_amount`, `expiration_date`, `usage_limit`) VALUES
(2, 3, 'aaa', 244, '2023-09-02', 2),
(10, 4, 'aaa', 44, '2023-09-16', 9),
(11, 2, 'aaa', 12, '2023-09-16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `cat_id` int(25) NOT NULL,
  `event_name` varchar(200) NOT NULL,
  `event_dt` date NOT NULL,
  `event_time` time NOT NULL,
  `event_address` varchar(200) NOT NULL,
  `event_fee` int(50) NOT NULL,
  `event_duration` int(25) NOT NULL,
  `event_status` int(25) NOT NULL,
  `event_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `cat_id`, `event_name`, `event_dt`, `event_time`, `event_address`, `event_fee`, `event_duration`, `event_status`, `event_image`) VALUES
(2, 1, 'nathagli', '2023-09-28', '16:32:00', 'dsnsfnsfnsf', 5432, 2, 0, '1692297400.Array'),
(3, 2, 'Future of AI', '2023-08-31', '17:00:00', 'Al hamra hall , islamabad', 5005, 3, 0, '1692297384.Array'),
(4, 3, 'Child Support', '2023-09-07', '14:40:00', 'Fatima Collage of Arts, Lahore', 800, 2, 0, ''),
(5, 5, 'GupShup Corner', '2023-09-01', '21:10:00', 'Cake and Bake , Barkat Market, Lhr', 1500, 4, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `intrested_events`
--

CREATE TABLE `intrested_events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `intrested_events`
--

INSERT INTO `intrested_events` (`id`, `user_id`, `event_id`, `created_at`) VALUES
(6, 5, 0, '2023-08-17 13:34:15'),
(7, 5, 0, '2023-08-17 13:34:17'),
(8, 5, 0, '2023-08-17 13:34:18'),
(9, 5, 0, '2023-08-17 13:34:20'),
(10, 5, 0, '2023-08-17 13:34:20'),
(11, 5, 0, '2023-08-17 13:34:21'),
(12, 5, 0, '2023-08-17 13:35:13'),
(13, 5, 0, '2023-08-17 13:35:14'),
(14, 5, 0, '2023-08-17 13:35:15'),
(15, 5, 0, '2023-08-17 13:36:40'),
(16, 5, 0, '2023-08-17 13:36:42'),
(17, 5, 0, '2023-08-17 13:36:42'),
(18, 5, 0, '2023-08-17 13:36:43'),
(19, 5, 0, '2023-08-17 13:36:44'),
(20, 5, 0, '2023-08-17 13:36:45'),
(21, 5, 0, '2023-08-17 13:36:47'),
(22, 5, 0, '2023-08-17 13:37:10'),
(23, 5, 0, '2023-08-17 13:37:28'),
(24, 5, 0, '2023-08-17 13:39:42'),
(25, 5, 0, '2023-08-17 13:55:02'),
(26, 5, 0, '2023-08-17 13:55:04'),
(28, 5, 0, '2023-08-17 14:07:15'),
(29, 5, 0, '2023-08-17 14:07:16'),
(30, 5, 0, '2023-08-17 14:07:17'),
(31, 5, 0, '2023-08-17 14:07:18'),
(33, 5, 0, '2023-08-17 14:10:07'),
(40, 5, 3, '2023-09-01 17:54:59'),
(41, 5, 4, '2023-09-02 19:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `name`, `email`, `message`) VALUES
(11, 'waqar ahmed', 'admin@gmail.com', 'What is payment process? do you accept credit cards on event site ?'),
(12, 'waqar ahmed', 'asad@gmail.com', 'Great Event organised by your team yesterday. Pleased to be there');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `event_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `event_rating` int(50) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `event_id`, `user_id`, `event_rating`, `feedback`) VALUES
(8, 2, 5, 4, 'DD'),
(9, 5, 5, 4, 'ZX'),
(10, 3, 5, 5, 'xx');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`) VALUES
(1, 'Example1@gmail.com'),
(2, 'example2@gmail.com'),
(3, 'example3@gmail.com'),
(4, 'example4@gmail.com'),
(5, 'example5@gmail.com'),
(6, 'example6@gmail.comx');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `login_id` varchar(50) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `user_type` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `login_id`, `pw`, `email`, `contact`, `address`, `user_type`) VALUES
(1, 'Ahmed Mateen', 'admin', '202cb962ac59075b964b07152d234b70', 'admin@gmail.com', '03454673053', 'rwp', 0),
(5, 'Ali Ahmed', 'ali', '202cb962ac59075b964b07152d234b70', 'ali@gmail.com', '03454673053', 'House No 43- DHA Islamabad', 1),
(7, 'asad ali', 'asad', '202cb962ac59075b964b07152d234b70', 'asad@gmail.com', '03454673053', 'pac kamra', 1),
(8, 'hamza ahmed', 'hamza', '202cb962ac59075b964b07152d234b70', 'admin@gmail.com', '03454673053', 'pac kamra', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `intrested_events`
--
ALTER TABLE `intrested_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `intrested_events`
--
ALTER TABLE `intrested_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
