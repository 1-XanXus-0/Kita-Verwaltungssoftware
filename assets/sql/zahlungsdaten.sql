-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Mrz 2021 um 11:20
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mydb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungsdaten`
--

CREATE TABLE `zahlungsdaten` (
  `ZahlungsID` int(11) NOT NULL,
  `Vorname` varchar(50) DEFAULT NULL,
  `Nachname` varchar(50) DEFAULT NULL,
  `IBAN` varchar(50) DEFAULT NULL,
  `BIC` varchar(50) DEFAULT NULL,
  `Jan` varchar(50) DEFAULT NULL,
  `Feb` varchar(50) DEFAULT NULL,
  `Mar` varchar(50) DEFAULT NULL,
  `Apr` varchar(50) DEFAULT NULL,
  `Mai` varchar(50) DEFAULT NULL,
  `Jun` varchar(50) DEFAULT NULL,
  `Jul` varchar(50) DEFAULT NULL,
  `Aug` varchar(50) DEFAULT NULL,
  `Sep` varchar(50) DEFAULT NULL,
  `Okt` varchar(50) DEFAULT NULL,
  `Nov` varchar(50) DEFAULT NULL,
  `Dez` varchar(50) DEFAULT NULL,
  `KindID` int(11) DEFAULT NULL,
  `ElternID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `zahlungsdaten`
--

INSERT INTO `zahlungsdaten` (`ZahlungsID`, `Vorname`, `Nachname`, `IBAN`, `BIC`, `Jan`, `Feb`, `Mar`, `Apr`, `Mai`, `Jun`, `Jul`, `Aug`, `Sep`, `Okt`, `Nov`, `Dez`, `KindID`, `ElternID`) VALUES
(1, 'Herr', 'Neumann', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 1, 1),
(2, 'Herr', 'Neumann', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 2, 1),
(3, 'Frau', 'Schmidt', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'bezahlt', 'bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 4, 4),
(4, 'Herr', 'Müller', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'bezahlt', 'bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 5, 5),
(5, 'Herr', 'Hrubesch', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'bezahlt', 'bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 6, 7),
(6, 'Herr', 'Marschall', 'DE96500105179795933213', 'INGDDEFFXXX', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 7, 9),
(7, 'Frau', 'Marek', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'bezahlt', 'bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 8, 12),
(8, 'Herr', 'Vertreter', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'bezahlt', 'bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 9, NULL),
(9, 'Frau', 'Lustig', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 10, 16),
(10, 'Herr', 'Seifert', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'bezahlt', 'bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 11, 17),
(11, 'Herr', 'Kilicci', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 12, 19),
(12, 'Herr', 'Gesierich', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'bezahlt', 'bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 13, 21),
(13, 'Frau', 'Wagner', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 14, 24),
(14, 'Herr', 'Kingsley', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 15, 25),
(15, 'Herr', 'Mantas', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 16, 27),
(16, 'Herr', 'Sinikoska', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 17, 29),
(17, 'Herr', 'Chennai', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 18, 31),
(18, 'Frau', 'Sivan', 'DE96500105179795933213', 'INGDDEFFXXX', 'bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 'bezahlt', 19, 34),
(19, 'Herr', 'Black', 'DE96500105179795933213', 'INGDDEFFXXX', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 'nicht bezahlt', 20, 35);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `zahlungsdaten`
--
ALTER TABLE `zahlungsdaten`
  ADD PRIMARY KEY (`ZahlungsID`),
  ADD KEY `KindID` (`KindID`),
  ADD KEY `ElternID` (`ElternID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `zahlungsdaten`
--
ALTER TABLE `zahlungsdaten`
  MODIFY `ZahlungsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `zahlungsdaten`
--
ALTER TABLE `zahlungsdaten`
  ADD CONSTRAINT `zahlungsdaten_ibfk_1` FOREIGN KEY (`KindID`) REFERENCES `kinderdaten` (`KindID`),
  ADD CONSTRAINT `zahlungsdaten_ibfk_2` FOREIGN KEY (`ElternID`) REFERENCES `elterndaten` (`ElternID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
