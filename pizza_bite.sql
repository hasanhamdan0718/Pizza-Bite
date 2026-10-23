-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2026 at 12:16 PM
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
-- Database: `pizza bite`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `about_id` int(50) UNSIGNED NOT NULL,
  `about_title` varchar(150) NOT NULL,
  `about_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`about_id`, `about_title`, `about_description`) VALUES
(3, 'Fresh Ingredients', 'We use the freshest ingredients.'),
(4, 'Fast Delivery', 'Get your pizza hot and fresh.'),
(5, 'Great Taste', 'Our recipes made with passion.'),
(6, '24/7 Support', 'We\'re always here to help you.');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(50) UNSIGNED NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `created_at`) VALUES
(5, 'Meat Lovers', '2026-10-21 15:30:48'),
(7, 'Classic', '2026-10-21 16:55:37'),
(8, 'Vegeterian', '2026-10-23 10:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `hero-section`
--

CREATE TABLE `hero-section` (
  `hero_id` int(50) UNSIGNED NOT NULL,
  `hero_title` varchar(150) NOT NULL,
  `hero_description` varchar(255) NOT NULL,
  `hero_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hero-section`
--

INSERT INTO `hero-section` (`hero_id`, `hero_title`, `hero_description`, `hero_image`) VALUES
(1, 'Enjoy OurDelicious Pizza', 'At Pizza Bite, we make fresh pizzas with the bestingredients. Perfect for family, friends, and any occassion.', 'hero_6ad79546c43f19.83907256.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pizzas`
--

CREATE TABLE `pizzas` (
  `pizza_id` int(50) UNSIGNED NOT NULL,
  `pizza_name` varchar(150) NOT NULL,
  `pizza_description` varchar(255) NOT NULL,
  `pizza_image` varchar(255) NOT NULL,
  `pizza_price` double NOT NULL,
  `category_id` int(50) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizzas`
--

INSERT INTO `pizzas` (`pizza_id`, `pizza_name`, `pizza_description`, `pizza_image`, `pizza_price`, `category_id`, `created_at`) VALUES
(5, 'Pepperoni Pizza', 'Classic pepperoni, mozzarella cheese, tomato sauce.', 'pizza_6ada0939bca483.91760660.avif', 10.99, 5, '2026-10-22 13:01:45'),
(6, 'Meat Lovers Pizza', 'Pepperoni, sausage, bacon, mozzarella cheese.', 'pizza_6ada095d9b8305.52295544.jpg', 12.99, 5, '2026-10-22 13:02:21'),
(7, 'Margherita Pizza', 'Fresh tomatoes, mozzarella cheese, basil.', 'pizza_6ada097e5f42a1.71412325.jpg', 8.99, 7, '2026-10-23 10:05:53'),
(8, 'BBQ Chicken Pizza', 'Grilled chicken, red onions, BBQ sauce, mozzarella cheese.', 'pizza_6ada099dd1abd1.53750710.webp', 11.99, 7, '2026-10-22 13:03:25'),
(10, 'Vegeterian Pizza', 'Bell peppers, olives, onions, mushrooms, mozzarella cheese.', 'pizza_6ada444e7e50b9.13034020.avif', 9.99, 8, '2026-10-22 17:13:50'),
(11, 'Mushroom Pizza', 'Fresh Mushrooms, mozzarella cheese, tomato sauce.', 'pizza_6ada446fd0a078.64852583.jpg', 9.99, 8, '2026-10-22 17:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(50) UNSIGNED NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_role` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_role`, `password`) VALUES
(6, 'Hasan', 'admin', '$2y$10$ReeTuTSZkSvpCW5GlLvzfuUPXtx4nhVv/r2SZFprWDdl4yV9rRcHe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `hero-section`
--
ALTER TABLE `hero-section`
  ADD PRIMARY KEY (`hero_id`);

--
-- Indexes for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`pizza_id`),
  ADD KEY `relation45` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hero-section`
--
ALTER TABLE `hero-section`
  MODIFY `hero_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `pizza_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD CONSTRAINT `relation45` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
