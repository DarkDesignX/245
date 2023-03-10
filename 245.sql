-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Erstellungszeit: 08. Mrz 2023 um 17:27
=======
-- Erstellungszeit: 09. Mrz 2023 um 22:19
>>>>>>> 10571c31b697ea17f560df668775fa9412bf661c
-- Server-Version: 10.4.25-MariaDB
-- PHP-Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `245`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `parking`
--

CREATE TABLE `parking` (
  `id` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `parking`
--

INSERT INTO `parking` (`id`, `position`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `parking_reservations`
--

CREATE TABLE `parking_reservations` (
  `parking_reservation_id` int(11) NOT NULL,
<<<<<<< HEAD
=======
  `parking_reservation` varchar(100) NOT NULL,
>>>>>>> 10571c31b697ea17f560df668775fa9412bf661c
  `parking_number` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `comment` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `parking_reservations`
--

<<<<<<< HEAD
INSERT INTO `parking_reservations` (`parking_reservation_id`, `parking_number`, `name`, `time_start`, `time_end`, `comment`) VALUES
(1, 1, 'Björn Hari', '2023-03-06 10:04:34', '2023-03-06 11:00:00', ''),
(2, 2, 'Denis Basler', '2023-03-07 08:00:00', '2023-03-07 16:15:00', ''),
(3, 3, 'Morhaf Alnhlawe', '2023-03-08 08:00:00', '2023-03-08 12:00:00', ''),
(5, 5, 'Eva Scarton', '2023-03-10 10:00:30', '2023-03-10 12:00:00', '');
=======
INSERT INTO `parking_reservations` (`parking_reservation_id`, `parking_reservation`, `parking_number`, `name`, `time_start`, `time_end`, `comment`) VALUES
(2, 'Nachholung English Exam\r\n', 2, 'Denis Basler', '2023-03-07 08:00:00', '2023-03-07 16:15:00', ''),
(3, 'Vertrag unterschreiben', 3, 'Morhaf Alnhlawe', '2023-03-08 08:00:00', '2023-03-08 12:00:00', '');
>>>>>>> 10571c31b697ea17f560df668775fa9412bf661c

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `floor` varchar(10) NOT NULL,
  `seats` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `room`
--

INSERT INTO `room` (`id`, `name`, `description`, `floor`, `seats`) VALUES
(1, 'Rubin', 'Informatikraum', 'EG', 'max. 30 Plätze'),
(2, 'Smaragd ', 'Seminarraum', 'EG', 'max. 30 Plätze'),
(3, 'Harvard', 'Informatikraum', '1. OG', 'max 23 Plätze'),
(4, 'Sorbonne', 'Informatikraum', '1. OG', 'max. 15 Plätze'),
(5, 'Cambridge', 'Informatikraum', '1. OG', 'max. 17 Plätze'),
(6, 'San Diego', 'Labor', '1. OG', ''),
(7, 'Boston', 'Informatikraum', '1. OG', 'max. 17 Plätze'),
(8, 'Eiger', 'Informatikraum', '2. OG', 'max. 20 Plätze'),
(9, 'Blüemisalp', 'Seminarraum', '2. OG', 'max. 20 Plätze'),
(10, 'Opal', 'Pausenraum', 'EG', ''),
(11, 'Oxford', 'Seminarraum', '1. OG', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room_reservations`
--

CREATE TABLE `room_reservations` (
  `room_reservation_id` int(11) NOT NULL,
<<<<<<< HEAD
=======
  `room_reservation` varchar(100) NOT NULL,
>>>>>>> 10571c31b697ea17f560df668775fa9412bf661c
  `room_name` varchar(50) NOT NULL,
  `name` varchar(256) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `comment` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `room_reservations`
--

<<<<<<< HEAD
INSERT INTO `room_reservations` (`room_reservation_id`, `room_name`, `name`, `time_start`, `time_end`, `comment`) VALUES
(1, 'Cambridge', 'Björn Hari', '2023-03-08 13:00:00', '2023-03-08 15:00:00', ''),
(2, 'Sorbonne', 'Denis Basler', '2023-03-10 14:00:00', '2023-03-06 20:00:00', ''),
(3, 'Rubin', 'Morhaf Alnhlawe', '2023-03-09 08:30:00', '2023-03-09 10:00:00', ''),
(6, 'Oxford', 'Manuel Schibli', '2023-03-10 08:30:00', '2023-03-10 16:15:00', '');
=======
INSERT INTO `room_reservations` (`room_reservation_id`, `room_reservation`, `room_name`, `name`, `time_start`, `time_end`, `comment`) VALUES
(3, 'Besprechung mit Herr Müller', 'Rubin', 'Morhaf Alnhlawe', '2023-03-09 08:30:00', '2023-03-09 10:00:00', '');
>>>>>>> 10571c31b697ea17f560df668775fa9412bf661c

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(500) NOT NULL,
  `Usertype` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `Usertype`) VALUES
(5, 'bdm_admin', 'aeae8dc8544324aecedab1ca927fa13d3b9d8f02c0e526c010503ff0b4e9bdc9', 'A');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `parking_reservations`
--
ALTER TABLE `parking_reservations`
  ADD PRIMARY KEY (`parking_reservation_id`);

--
-- Indizes für die Tabelle `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `room_reservations`
--
ALTER TABLE `room_reservations`
  ADD PRIMARY KEY (`room_reservation_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `parking`
--
ALTER TABLE `parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `parking_reservations`
--
ALTER TABLE `parking_reservations`
  MODIFY `parking_reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `room_reservations`
--
ALTER TABLE `room_reservations`
  MODIFY `room_reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
