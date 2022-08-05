-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost
-- Čas generovania: Pi 05.Aug 2022, 11:46
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
-- Štruktúra tabuľky pre tabuľku `ibanvalidate`
--

CREATE TABLE `ibanvalidate` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `valid` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `ibanvalidate`
--

INSERT INTO `ibanvalidate` (`id`, `user_id`, `valid`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-08-05 03:56:30', '2022-08-05 09:46:22'),
(2, 2, 1, '2022-08-05 03:56:32', '2022-08-05 09:46:22'),
(3, 3, 1, '2022-08-05 09:22:19', '2022-08-05 09:46:22');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `ibanvalidate`
--
ALTER TABLE `ibanvalidate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `ibanvalidate`
--
ALTER TABLE `ibanvalidate`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
