-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost
-- Čas generovania: Pi 05.Aug 2022, 11:47
-- Verzia serveru: 10.4.22-MariaDB
-- Verzia PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+02:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--

--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `street_address` varchar(200) DEFAULT NULL,
  `address_number` varchar(100) DEFAULT NULL,
  `zip_code` varchar(100) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `iban` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `street_address`, `address_number`, `zip_code`, `city`, `iban`, `created_at`, `updated_at`) VALUES
(1, 'Juraj', 'Smatana', 'Ruzova', '178/4', 93201, 'Velky Meder', 'GR9608100010000001234567890', '2022-08-04 02:41:40', '2022-08-04 02:41:40'),
(2, 'Peter', 'Mrak', 'Na grbe', '6334', 92330, 'Bratislava', 'GR9608100010000001234567890', '2022-08-04 02:42:40', '2022-08-04 02:11:30'),
(3, 'Juraj', 'Smatana', 'ruzova', '178/4', 93021, 'velky meder', 'GR9608100010000001234567890', '2022-08-05 09:22:19', '2022-08-05 09:44:33');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
