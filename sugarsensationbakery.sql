-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2025 at 05:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sugarsensationbakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `image`, `name`, `price`, `quantity`) VALUES
(4, 'food-4.png', 'Sandwich', 5.00, 3),
(6, 'chocolatecheesecake.jpg', 'Chocolate Cheesecake', 5.00, 1),
(7, 'milkbun.jpg', 'Milk Bun', 3.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(5, 'Appetizer'),
(6, 'Buns'),
(7, 'Rice'),
(8, 'Drinks'),
(9, 'Desserts'),
(10, 'Cakes');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fname`, `lname`, `email`, `subject`, `message`) VALUES
(1, 'zoona', 'mufeed', 'zoonamufeed@gmail.com', 'chocolate mousse', 'chocolate mousse was the best mousse that i have ever tasted. keep it up.');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_cname` varchar(255) NOT NULL,
  `delivery_address` text NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_time` time NOT NULL,
  `del_status` enum('pending','delivered','cancelled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `order_id`, `order_cname`, `delivery_address`, `contact_no`, `delivery_date`, `delivery_time`, `del_status`) VALUES
(1, 1, 'zoona mufeed', 'Kandy', '0777767249', '2025-02-05', '15:08:00', 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supply_product` varchar(255) NOT NULL,
  `received_date` date NOT NULL,
  `manufacture_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `stock_qty` int(11) NOT NULL,
  `last_restocked_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `supplier_name`, `supply_product`, `received_date`, `manufacture_date`, `expire_date`, `stock_qty`, `last_restocked_date`) VALUES
(1, 'Kumar', 'Fresh Milk', '2025-02-05', '2025-02-02', '2025-02-10', 48, '2025-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(100) NOT NULL,
  `flat` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pin_code` varchar(20) NOT NULL,
  `total_products` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `name`, `number`, `email`, `method`, `flat`, `street`, `city`, `state`, `country`, `pin_code`, `total_products`, `total_price`) VALUES
(1, 'zoona mufeed', '0777767249', 'zoonamufeed@gmail.com', 'cash on delivery', 'Akuarna', 'Bulugohathana', 'Kandy', 'Kandy district ', 'Sri Lanka', '123', 'Vegetable Soup (1) , Submarine (2) ', 21.00),
(2, 'hima', '0777', 'hima@gmail.com', 'cash on delivery', 'Akuarna', 'Bulugohathana', 'Kandy', 'Kandy district ', 'Sri Lanka', '123', 'Sandwich (3) , Chocolate Cheesecake (1) ', 20.00),
(3, 'Hima', '0775543459', 'hima@gmail.com', 'cash on delivery', 'Akuarna', 'Bulugohathana', 'Kandy', 'Kandy district', 'Sri Lanka', '123', 'Sandwich (3) , Chocolate Cheesecake (1) ', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category_id`) VALUES
(24, 'Vegetable Soup', 5.00, 'vegsoup.jpeg', 5),
(26, 'Tomatoe Soup', 5.00, 'tomato.jpeg', 5),
(28, 'Chicken Soup', 6.00, 'chickensoup.jpeg', 5),
(30, 'French Fries', 2.00, 'food-6.png', 5),
(32, 'Potatoe Wedges', 3.00, 'potatoWedges.jpeg', 5),
(42, 'Shrimp Starter', 2.00, 'ShrimpCocktail.jpg', 5),
(43, 'Milk Bun', 3.00, 'milkbun.jpg', 6),
(44, 'Garlic Bread', 2.00, 'garlic bread.jpg', 5),
(45, 'Sandwich', 5.00, 'food-4.png', 6),
(46, 'Burger', 6.00, 'burger.jpg', 6),
(47, 'Submarine', 8.00, 'submarine.jpg', 6),
(48, 'Hot Dog', 5.00, 'hotdog.jpeg', 6),
(49, 'Shawarma', 6.00, 'shawarma.jpg', 6),
(50, 'Fried Rice', 8.00, 'friedrice.jpeg', 7),
(51, 'Singapore Rice', 8.00, 'singapore rice.jpeg', 7),
(52, 'Nasigoreng Rice', 8.00, 'nasigoreng.jpg', 7),
(53, 'Mojito', 2.00, 'bluedrink.jpg', 8),
(54, 'Strawberry Milkshake', 3.00, 'strawberrymilkshake.jpeg', 8),
(55, 'Chocolate Milkshake', 3.00, 'chocolatemilkshake.jpg', 8),
(56, 'Falooda', 3.00, 'falooda.jpg', 8),
(57, 'Vanilla Milkshake', 3.00, 'vanillamilkshake.jpeg', 8),
(58, 'Pizza', 5.00, 'pizza.jpg', 6),
(59, 'BrokenGlass Gello', 2.00, 'brokenglass.jpg', 9),
(60, 'Brownies', 4.00, 'brownies.jpg', 9),
(61, 'Strawberry Cheesecake', 5.00, 'strawberrycheesecake.jpg', 9),
(62, 'Chocolate Cheesecake', 5.00, 'chocolatecheesecake.jpg', 9),
(63, 'Custard Tart', 4.00, 'custard tart.jpeg', 9),
(64, 'Chocolate Mousse', 4.00, 'chocolatemousse.jpg', 9),
(65, 'Chocolate cake', 5.00, 'chocolatecheesecake.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplychain`
--

CREATE TABLE `supplychain` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supply_area` varchar(255) NOT NULL,
  `supply_product` varchar(255) NOT NULL,
  `received_date` date NOT NULL,
  `manufacture_date` date NOT NULL,
  `expire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplychain`
--

INSERT INTO `supplychain` (`id`, `supplier_name`, `supply_area`, `supply_product`, `received_date`, `manufacture_date`, `expire_date`) VALUES
(1, 'Kumar', 'Ambewalal', 'Fresh Milk', '2025-02-05', '2025-02-02', '2025-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `password`) VALUES
(1, 'zoona mufeed', 'zoonamufeed@gmail.com', '0777767249', '49ab8082c9496c124b2a0d218737042a1b459c3c'),
(2, 'Hima', 'hima@gmail.com', '0777767123', 'aea94540066f9f12f3902cf1fbbd6e3a8f94dd8f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `supplychain`
--
ALTER TABLE `supplychain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `supplychain`
--
ALTER TABLE `supplychain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
