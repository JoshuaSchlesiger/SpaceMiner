-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Okt 2023 um 19:15
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

-- Daten für Tabelle `methods`
--

INSERT INTO `methods` (`id`, `name`, `factorYield`, `factorCosts`, `factorTime`) VALUES
(1, 'Cormack', 0.665, 4, 0.016),
(2, 'Dinyx Solvention', 0.95, 2, 0.8),
(3, 'Electrostarolysis', 0.808, 4, 0.066),
(4, 'Ferron Exchange', 0.95, 4, 0.266),
(5, 'Gaskin Process', 0.808, 12, 0.033),
(6, 'Kazen Winnowing', 0.665, 2, 0.05),
(7, 'Pyrometric Chromalysis', 0.95, 12, 0.133),
(8, 'Thermonatic Deposition', 0.808, 2, 0.2),
(9, 'XCR Reaction', 0.665, 12, 0.008);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `methods`
--
ALTER TABLE `methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `methods`
--
ALTER TABLE `methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
