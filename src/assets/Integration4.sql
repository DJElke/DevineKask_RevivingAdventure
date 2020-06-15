-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Gegenereerd op: 15 jun 2020 om 08:26
-- Serverversie: 5.7.26
-- PHP-versie: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Integration4`
--
CREATE DATABASE IF NOT EXISTS `Integration4` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Integration4`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Card`
--

CREATE TABLE `Card` (
  `id` int(11) NOT NULL,
  `cardtype_id` int(11) DEFAULT NULL,
  `picture_id` longblob,
  `title_id` int(11) DEFAULT NULL,
  `description_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `CardType`
--

CREATE TABLE `CardType` (
  `id` int(11) NOT NULL,
  `description` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `CardType`
--

INSERT INTO `CardType` (`id`, `description`) VALUES
(1, 'Character Card'),
(2, 'Adventure Card'),
(3, 'Item Card');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Card_Description`
--

CREATE TABLE `Card_Description` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `description_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Card_Picture`
--

CREATE TABLE `Card_Picture` (
  `id` int(11) NOT NULL,
  `picture_id` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Card_Title`
--

CREATE TABLE `Card_Title` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Description`
--

CREATE TABLE `Description` (
  `id` int(11) NOT NULL,
  `description` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Design`
--

CREATE TABLE `Design` (
  `id` int(11) NOT NULL,
  `description` varchar(225) NOT NULL,
  `picture_deck1` longblob NOT NULL,
  `picture_deck2` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Picture`
--

CREATE TABLE `Picture` (
  `id` int(11) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Stickers`
--

CREATE TABLE `Stickers` (
  `id` int(11) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Title`
--

CREATE TABLE `Title` (
  `id` int(11) NOT NULL,
  `description` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `picture` longblob,
  `password` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `User`
--

INSERT INTO `User` (`id`, `name`, `email`, `picture`, `password`) VALUES
(1, 'Elke', 'elke@email.com', NULL, ''),
(2, 'Sarah', 'sarah@email.com', NULL, ''),
(3, 'Veronica', 'veronica@email.com', NULL, NULL),
(4, 'Camille', 'camille@email.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `UserRole`
--

CREATE TABLE `UserRole` (
  `id` int(11) NOT NULL,
  `description` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `UserRole`
--

INSERT INTO `UserRole` (`id`, `description`) VALUES
(1, 'Owner'),
(2, 'Editor');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Vacation`
--

CREATE TABLE `Vacation` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `design_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Vacation`
--

INSERT INTO `Vacation` (`id`, `name`, `design_id`) VALUES
(1, 'Zakynthos - Greece', NULL),
(2, 'Malaga - Spanje', NULL),
(3, 'Amsterdam - Nederland', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Vacation_Card`
--

CREATE TABLE `Vacation_Card` (
  `id` int(11) NOT NULL,
  `vacation_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Vacation_Card`
--

INSERT INTO `Vacation_Card` (`id`, `vacation_id`, `card_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Vacation_User`
--

CREATE TABLE `Vacation_User` (
  `id` int(11) NOT NULL,
  `vacation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `userrole_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Vacation_User`
--

INSERT INTO `Vacation_User` (`id`, `vacation_id`, `user_id`, `userrole_id`, `status`) VALUES
(1, 1, 1, 1, 0),
(2, 1, 2, 2, 0),
(3, 1, 3, 2, 0),
(4, 1, 4, 2, 0),
(5, 2, 3, 1, 0),
(6, 2, 1, 2, 0),
(7, 3, 4, 1, 0),
(8, 3, 2, 2, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Card`
--
ALTER TABLE `Card`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `CardType`
--
ALTER TABLE `CardType`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Card_Description`
--
ALTER TABLE `Card_Description`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Card_Picture`
--
ALTER TABLE `Card_Picture`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Card_Title`
--
ALTER TABLE `Card_Title`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Description`
--
ALTER TABLE `Description`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Design`
--
ALTER TABLE `Design`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Picture`
--
ALTER TABLE `Picture`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Stickers`
--
ALTER TABLE `Stickers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Title`
--
ALTER TABLE `Title`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `UserRole`
--
ALTER TABLE `UserRole`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Vacation`
--
ALTER TABLE `Vacation`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Vacation_Card`
--
ALTER TABLE `Vacation_Card`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Vacation_User`
--
ALTER TABLE `Vacation_User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Card`
--
ALTER TABLE `Card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `CardType`
--
ALTER TABLE `CardType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `Card_Description`
--
ALTER TABLE `Card_Description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `Card_Picture`
--
ALTER TABLE `Card_Picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `Card_Title`
--
ALTER TABLE `Card_Title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `Description`
--
ALTER TABLE `Description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `Design`
--
ALTER TABLE `Design`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `Picture`
--
ALTER TABLE `Picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `Stickers`
--
ALTER TABLE `Stickers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `Title`
--
ALTER TABLE `Title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `UserRole`
--
ALTER TABLE `UserRole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `Vacation`
--
ALTER TABLE `Vacation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `Vacation_Card`
--
ALTER TABLE `Vacation_Card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `Vacation_User`
--
ALTER TABLE `Vacation_User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
