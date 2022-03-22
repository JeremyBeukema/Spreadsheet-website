-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 mrt 2022 om 16:35
-- Serverversie: 10.4.22-MariaDB
-- PHP-versie: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spreadsheets`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `companies`
--

CREATE TABLE `companies` (
  `id` int(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `discount` int(30) NOT NULL,
  `notes` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `companies`
--

INSERT INTO `companies` (`id`, `name`, `phone`, `location`, `contact`, `discount`, `notes`) VALUES
(12, 'Test', '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rtkservicecontract`
--

CREATE TABLE `rtkservicecontract` (
  `name` varchar(50) NOT NULL,
  `passwords` varchar(30) NOT NULL,
  `company` varchar(50) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `price` decimal(30,0) DEFAULT NULL,
  `sr` varchar(50) NOT NULL,
  `firstdate` date NOT NULL,
  `notes` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `rtkservicecontract`
--

INSERT INTO `rtkservicecontract` (`name`, `passwords`, `company`, `startdate`, `enddate`, `price`, `sr`, `firstdate`, `notes`, `id`) VALUES
('Test002', '12345', 'Test', '2022-03-22', '2022-03-29', '850', 'Test002', '2022-03-22', '', 182);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `servicecontract`
--

CREATE TABLE `servicecontract` (
  `name` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `price` decimal(30,0) NOT NULL,
  `sr` varchar(50) NOT NULL,
  `firstdate` date NOT NULL,
  `notes` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `servicecontract`
--

INSERT INTO `servicecontract` (`name`, `company`, `startdate`, `enddate`, `price`, `sr`, `firstdate`, `notes`, `id`) VALUES
('Test001', 'Test', '2022-03-22', '2022-04-28', '850', 'test001', '2022-03-22', '', 73);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexen voor tabel `rtkservicecontract`
--
ALTER TABLE `rtkservicecontract`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `servicecontract`
--
ALTER TABLE `servicecontract`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `rtkservicecontract`
--
ALTER TABLE `rtkservicecontract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT voor een tabel `servicecontract`
--
ALTER TABLE `servicecontract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
