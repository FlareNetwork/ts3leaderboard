-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 11. Mrz 2018 um 22:46
-- Server-Version: 10.0.32-MariaDB-0+deb8u1
-- PHP-Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `test`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ts3_timetable`
--

CREATE TABLE `ts3_timetable` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `uid` text NOT NULL,
  `ip` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `ts3_timetable`
--

INSERT INTO `ts3_timetable` (`id`, `username`, `uid`, `ip`, `time`) VALUES
(1, 'Flare', 'HxTpel2dIhf18oqZCAUbCyjMbXw=', '185.35.216.48', 15),
(2, 'serveradmin from 127.0.0.1:36226', 'serveradmin', '', 10);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ts3_timetable`
--
ALTER TABLE `ts3_timetable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `ts3_timetable`
--
ALTER TABLE `ts3_timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
