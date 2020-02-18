-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Feb 2020 um 14:15
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `itwc20`
--
CREATE DATABASE IF NOT EXISTS `itwc20` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `itwc20`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `appointment`
--

CREATE TABLE `appointment` (
  `aid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `start` date NOT NULL,
  `finish` date NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `company`
--

CREATE TABLE `company` (
  `cid` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `contact` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `company`
--

INSERT INTO `company` (`cid`, `name`, `contact`, `email`) VALUES
(1, 'SAP', 'Janine Steidelmüller', 'janine.steidelmueller@sap.com'),
(2, 'MMS', 'Kristin Renger', 'kristin.renger@t-systems.com'),
(3, 'Communardo', 'Julia Kullmann', 'julia.kullmann@communardo.de');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event`
--

CREATE TABLE `event` (
  `eid` int(11) NOT NULL,
  `start` date NOT NULL,
  `finish` date NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `type` varchar(255) COLLATE utf8_bin NOT NULL,
  `place` varchar(255) COLLATE utf8_bin NOT NULL,
  `size` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `event`
--

INSERT INTO `event` (`eid`, `start`, `finish`, `title`, `description`, `type`, `place`, `size`, `cid`, `uid`) VALUES
(1, '2020-02-17', '2020-02-21', 'Event1', 'Das ist Event1, es ist eine Schulung zu bla bla bla', 'Schulung', 'Riesaer Straße 5', 10, 1, 0),
(2, '2020-02-24', '2020-02-25', 'Event2', 'Event2 ist ein anonymes Treffen von Kampfhubschraubern', 'Treffen', 'Riesaer Straße 7', 5, 2, 0),
(3, '2020-02-26', '2020-02-28', 'Event3', 'Event3 ist eine Besprechung zur Gewinnmaximierung', 'Besprechung', 'SAP Gebäude Staßburger Platz', 7, 2, 0),
(4, '2020-03-02', '2020-02-07', 'Event4', 'Event4 ist ein Kundenmmeting mit 1&1. Heute bestellt, gestern da. Einfach smart.', 'Meeting', 'Riesaer Straße 7', 4, 2, 0),
(5, '2020-02-24', '2020-02-24', 'Event5', 'Zu Event5 kommt der Datenschutzbeauftragter. Was ein Nerd, wer braucht denn noch Datenschutz?', 'Besprechung', 'Kleiststraße 10a', 2, 3, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `participant`
--

CREATE TABLE `participant` (
  `pnr` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `eid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE `role` (
  `rid` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`rid`, `label`) VALUES
(0, 'Admin'),
(1, 'Ausbilder'),
(2, 'Lernender'),
(3, 'Mitarbeiter');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `rid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `start` date NOT NULL,
  `finish` date NOT NULL,
  `salutation` varchar(4) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `name`, `lastname`, `email`, `password`, `rid`, `cid`, `label`, `status`, `created`, `updated`, `start`, `finish`, `salutation`) VALUES
(1, 'admin', 'admin', 'admin@example.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 0, 1, 'Admin', 1, '2020-02-18 12:55:41', '2020-02-18 13:14:03', '2019-11-04', '2020-08-08', 'Herr');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`aid`);

--
-- Indizes für die Tabelle `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`cid`);

--
-- Indizes für die Tabelle `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eid`);

--
-- Indizes für die Tabelle `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`rid`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `appointment`
--
ALTER TABLE `appointment`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `event`
--
ALTER TABLE `event`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
