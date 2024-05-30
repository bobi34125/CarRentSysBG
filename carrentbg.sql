-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 30 май 2024 в 12:32
-- Версия на сървъра: 10.4.24-MariaDB
-- Версия на PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `carrentbg`
--

-- --------------------------------------------------------

--
-- Структура на таблица `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$uNwxXVhQ/ol4ZDqkb4AFJe2fecdn1HWdGt3XDlktezSW9Bz4CexHi');

-- --------------------------------------------------------

--
-- Структура на таблица `automobiles`
--

CREATE TABLE `automobiles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `fuel_type` varchar(20) DEFAULT NULL,
  `engine_type` varchar(20) DEFAULT NULL,
  `horsepower` int(11) DEFAULT NULL,
  `width` float DEFAULT NULL,
  `length` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `extras` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `automobiles`
--

INSERT INTO `automobiles` (`id`, `name`, `fuel_type`, `engine_type`, `horsepower`, `width`, `length`, `height`, `weight`, `extras`, `image`) VALUES
(2, 'Audi A8', 'Disel', 'diesel', 287, 1946, 5303, 1486, 2001, 'Blah blah blah :DDD', 'images/audii.jpg');

-- --------------------------------------------------------

--
-- Структура на таблица `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `automobile_id` int(11) NOT NULL,
  `rental_start_date` date NOT NULL,
  `rental_end_date` date NOT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `return_location` varchar(255) NOT NULL,
  `rental_days` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `rentals`
--

INSERT INTO `rentals` (`id`, `customer_name`, `customer_phone`, `customer_email`, `automobile_id`, `rental_start_date`, `rental_end_date`, `pickup_location`, `return_location`, `rental_days`, `created_at`) VALUES
(2, 'Azgvzx', '0895621948', 'azxx@abv.bg', 2, '2023-11-24', '2023-12-01', 'ASk', 'asadf', 7, '2023-11-24 19:05:14'),
(3, 'Asdzx', '0895621948', 'assdz@abv.bg', 2, '2023-11-27', '2023-12-08', 'Jk Mladost 2', 'Jk Lulin 3', 11, '2023-11-27 16:46:03'),
(4, 'Asen Iliev', '0899745621', 'Asen123@abv.bg', 2, '2024-03-26', '2024-03-29', 'Jk Mladost 2', 'Jk Lulin 3', 3, '2024-03-26 18:29:28'),
(5, 'Asen Iliev', '0899745621', 'Asen123@abv.bg', 2, '2024-03-26', '2024-03-29', 'Jk Mladost 2', 'Jk Lulin 3', 3, '2024-03-26 18:30:23');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user', '$2y$10$JpbYuLTgA8Eb9IDn5NRVM.tg7YXc6CkCWIkqOXtbcWJksiNyfchbe');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Индекси за таблица `automobiles`
--
ALTER TABLE `automobiles`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `automobile_id` (`automobile_id`);

--
-- Индекси за таблица `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `automobiles`
--
ALTER TABLE `automobiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`automobile_id`) REFERENCES `automobiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
