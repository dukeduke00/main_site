-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 07:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(128) NOT NULL,
  `product_id` int(128) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `quantity` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--



-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `brand` varchar(64) NOT NULL,
  `category` varchar(64) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_name` varchar(128) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(64) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `description`, `brand`, `category`, `image`, `image_name`, `price`, `quantity`, `entry_date`) VALUES
(7, 'Victorinox Noz', 'Multifunkcionalni noz', 'Victorinox', 'Nozevi', 'uploads/victorinox.jpg', 'victorinox.jpg', 39.99, 22, '2024-06-09 22:49:30'),
(8, 'Zwilling Set 3/1', 'Set kuhinjskih nozeva 3/1', 'Zwilling', 'Nozevi', 'uploads/zwilling.jpg', 'zwilling.jpg', 29.99, 22, '2024-06-09 22:54:20'),
(9, 'Jabuka', 'Crvena neprskana jabuka', 'A', 'Voce', 'uploads/apple.jpg', 'apple.jpg', 1.99, 0, '2024-06-09 23:09:03'),
(10, 'Banana', 'Zuta banana', 'A', 'Voce', 'uploads/banana.jpg', 'banana.jpg', 3.59, 2, '2024-06-09 23:10:14'),
(11, 'Lubenica', 'Zrela lubenica bez kospica', 'A', 'Povrce', 'uploads/lubenica.jpg', 'lubenica.jpg', 12.50, 4, '2024-06-09 23:12:26'),
(12, 'Victorinox Masat', 'Najbolji masat', 'Victorinox', 'Ostraci', 'uploads/victorinox_masat.jpg', 'victorinox_masat.jpg', 22.99, 33, '2024-06-12 21:57:19'),
(13, 'Zwilling Masat', 'Najbolji masat', 'Zwilling', 'Ostraci', 'uploads/zwilling_masat.jpg', 'zwilling_masat.jpg', 49.90, 2, '2024-06-12 22:00:18'),
(14, 'Zwilling Noz 5cm', 'Zwilling Noz 5cm', 'Zwilling', 'Nozevi', 'uploads/zwilling3.jpg', 'zwilling3.jpg', 22.99, 3, '2024-06-13 00:20:15'),
(15, 'Zwilling Noz 13cm', 'Zwilling Noz 13cm', 'Victorinox', 'Nozevi', 'uploads/zwilling4.jpg', 'zwilling4.jpg', 21.99, 22, '2024-06-13 00:21:44'),
(16, 'Zwilling Noz 14cm', 'Zwilling Noz 14cm', 'Zwilling', 'Nozevi', 'uploads/zwilling5.jpg', 'zwilling5.jpg', 22.00, 1, '2024-06-13 00:23:14'),
(17, 'Zwilling Noz 18cm', 'Zwilling Noz 18cm', 'Zwilling', 'Nozevi', 'uploads/zwilling6.jpg', 'zwilling6.jpg', 23.00, 1, '2024-06-13 00:23:26'),
(18, 'Zwilling Noz 22cm', 'Zwilling Noz 22cm', 'Zwilling', 'Nozevi', 'uploads/zwilling7.jpg', 'zwilling7.jpg', 23.00, 4, '2024-06-13 00:23:36'),
(19, 'Zwilling Noz 11cm', 'Zwilling Noz 11cm', 'Zwilling', 'Nozevi', 'uploads/zwilling8.jpg', 'zwilling8.jpg', 31.99, 4, '2024-06-13 00:23:49'),
(20, 'Zwilling Set 5/1', ' Zwilling Set 5/1', 'Zwilling', 'Nozevi', 'uploads/zwilling9.jpg', 'zwilling9.jpg', 131.99, 4, '2024-06-13 00:24:29'),
(21, 'Zwilling Set 4/1', 'Zwilling Set 4/1', 'Zwilling', 'Nozevi', 'uploads/zwilling10.jpg', 'zwilling10.jpg', 39.99, 3, '2024-06-13 00:25:11'),
(22, 'Swibo Noz 14cm', '- Duzina sjeciva 14cm \n- Najbolje sjecivo na trzistu\n- Noz najbolje koristiti za otkostavanje i moze se koristiti za jos mnogo toga\n- Najbolji noz', 'Swibo', 'Nozevi', 'uploads/swibo.jpg', 'swibo.jpg', 22.99, 2, '2024-06-15 14:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
