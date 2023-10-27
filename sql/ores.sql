-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Okt 2023 um 18:09
-- Server-Version: 11.1.2-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `laravel`
--

-- --------------------------------------------------------


--
-- Daten für Tabelle `ores`
--

INSERT INTO `ores` (`id`, `name`, `rawValue`, `refinedValue`) VALUES
(1, 'Quantainium', 4400.00, 24400.00),
(2, 'Gold', 320.00, 7368.00),
(3, 'Taranite', 1629.00, 3417.00),
(4, 'Bexalite', 2250.00, 3464.00),
(5, 'Diamond', 368.00, 4302.00),
(6, 'Borase', 1629.00, 2180.00),
(7, 'Laranite', 1551.00, 2851.00),
(8, 'Agricium', 1375.00, 2613.00),
(9, 'Hephaestanite', 738.00, 1603.00),
(10, 'Beryl', 221.00, 2815.00),
(11, 'Titan', 447.00, 476.00),
(12, 'Quartz', 78.00, 413.00),
(13, 'Copper', 287.00, 208.00),
(14, 'Iron', 347.00, 0.00),
(15, 'Tungsten', 205.00, 406.00),
(16, 'Corundum', 135.00, 379.00),
(17, 'Aluminum', 67.00, 317.00),
(18, 'Inert', 0.00, 0.00);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ores`
--
ALTER TABLE `ores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `ores`
--
ALTER TABLE `ores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
