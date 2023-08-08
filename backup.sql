-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Aug 2023 um 08:40
-- Server-Version: 10.4.18-MariaDB
-- PHP-Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `fakeuseravatar`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `api_key` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fake_users`
--

CREATE TABLE `fake_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `fake_users`
--

INSERT INTO `fake_users` (`id`, `first_name`, `last_name`, `email`, `avatar_url`, `created_at`, `updated_at`) VALUES
(61, 'Creola', 'Rodriguez', 'jakubowski.flo@yahoo.com', 'https://via.placeholder.com/360x360.png/0055aa?text=person+ut', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(62, 'Sallie', 'Erdman', 'lkuphal@hotmail.com', 'https://via.placeholder.com/360x360.png/003355?text=person+facilis', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(63, 'Ralph', 'Wintheiser', 'ulices.ryan@gmail.com', 'https://via.placeholder.com/360x360.png/002222?text=person+in', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(64, 'Tod', 'Nader', 'laisha.bode@walker.org', 'https://via.placeholder.com/360x360.png/0088aa?text=person+nesciunt', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(65, 'Gerson', 'Schultz', 'jordan.nitzsche@yahoo.com', 'https://via.placeholder.com/360x360.png/0099bb?text=person+est', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(66, 'Rodger', 'Von', 'lillie.kilback@nolan.com', 'https://via.placeholder.com/360x360.png/004488?text=person+praesentium', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(67, 'Seth', 'Robel', 'kenneth.feil@yahoo.com', 'https://via.placeholder.com/360x360.png/00aa11?text=person+sit', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(68, 'Anibal', 'Runolfsson', 'keeling.emelie@yahoo.com', 'https://via.placeholder.com/360x360.png/00dd55?text=person+quia', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(69, 'Montana', 'Jones', 'zieme.reilly@doyle.com', 'https://via.placeholder.com/360x360.png/002244?text=person+atque', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(70, 'Jessy', 'Turner', 'barbara52@yahoo.com', 'https://via.placeholder.com/360x360.png/00eedd?text=person+modi', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(71, 'Kayden', 'Schoen', 'ekulas@yahoo.com', 'https://via.placeholder.com/360x360.png/00cc00?text=person+consectetur', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(72, 'Jettie', 'Gutmann', 'fisher.freda@hotmail.com', 'https://via.placeholder.com/360x360.png/002233?text=person+ipsa', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(73, 'Devan', 'Gleichner', 'zschimmel@nienow.com', 'https://via.placeholder.com/360x360.png/0066cc?text=person+ratione', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(74, 'Thurman', 'Breitenberg', 'hettinger.flossie@lockman.org', 'https://via.placeholder.com/360x360.png/005588?text=person+sit', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(75, 'Jaquan', 'Conroy', 'rohan.vernon@wintheiser.com', 'https://via.placeholder.com/360x360.png/00ffdd?text=person+officiis', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(76, 'Lenny', 'Kuhlman', 'morar.shanna@hotmail.com', 'https://via.placeholder.com/360x360.png/004444?text=person+voluptatibus', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(77, 'Valentin', 'Marvin', 'reyes16@halvorson.info', 'https://via.placeholder.com/360x360.png/006644?text=person+nesciunt', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(78, 'Modesto', 'Stracke', 'deontae77@ernser.net', 'https://via.placeholder.com/360x360.png/00dd00?text=person+ad', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(79, 'Kira', 'Breitenberg', 'ariane.auer@harvey.com', 'https://via.placeholder.com/360x360.png/00bbdd?text=person+qui', '2023-08-08 04:08:24', '2023-08-08 04:08:24'),
(80, 'Ned', 'Ritchie', 'beverly.harvey@yahoo.com', 'https://via.placeholder.com/360x360.png/003355?text=person+totam', '2023-08-08 04:08:24', '2023-08-08 04:08:24');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(16, 'mohammad', 'mohammad@joubeh.com', '$2y$10$X8M0w6B9dIqFQJ5QdAEvhu5H.W/uQagg3yZ8a6IZnzFpy2XOfK7La', '2023-08-08 04:08:24', '2023-08-08 04:08:24');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_key` (`api_key`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `fake_users`
--
ALTER TABLE `fake_users`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `fake_users`
--
ALTER TABLE `fake_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `api_keys`
--
ALTER TABLE `api_keys`
  ADD CONSTRAINT `api_keys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
